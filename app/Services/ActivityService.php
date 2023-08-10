<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\User;
use App\Models\UserActivity;
use App\Traits\Image\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActivityService {
    use ImageTrait;

    /**
     * Returns a paginated list of activities from most recent created
     */
    public function all(){
        return Activity::orderBy('id', 'desc')->paginate(30);
    }

    /**
     * store activity created by an admin (global)
     * @param array $payload data to be added
     * @param object $image nullable image
     */
    public function store($payload, $image){
        $admin = Auth::user();
        //allow only 4 entries for a day by the admin
        $day = date('Y-m-d', strtotime($payload['date']));
        $day_activities = Activity::where('date', $day)->where('type', 'global')->select(['id'])->get()->count();
        if($day_activities === 4){
            return back()->withErrors(['Admin has already entered maximum of 4 activities for selected day']);
        }
        if(!empty($image)){
            $imgRes = $this->uploadImage($image);
            if($imgRes[0]){
                $payload['image'] = $imgRes[1];
            }
        }

        $payload['uid'] = (string) Str::uuid();
        $payload['created_by'] = $admin->uid;
        $payload['type'] = 'global';

        DB::beginTransaction();
        $activity = Activity::create(
            $payload
        );

        $this->setGlobal($activity->id);

        DB::commit();

        return redirect()->route('activity.index')->withMessage('One new activity generated');

    }

    /**
     * Make an activity global
     * @param integer $activity_id the id of the activity
     */
    private function setGlobal($activity_id){
        $users = User::get();
        foreach($users as $user){
            UserActivity::create(['user_id'=>$user->id, 'activity_id'=>$activity_id]);
        }
    }

    public function update($payload, $image, $uid){
        $admin = Auth::user();

        $activity = Activity::where('uid', $uid)->where('type', 'global')->first();
        if(empty($activity)){
            // dd(@$payload['type']);
            if(@$payload['type'] !== 'private'){
                return back()->withErrors(['Resource not found.']);
            }

        }
        if(!empty($image)){
            $imgRes = $this->uploadImage($image);
            if($imgRes[0]){
                $payload['image'] = $imgRes[1];
            }
        }

        DB::beginTransaction();
        //conditions to edit for single user
        if(@$payload['type'] === 'private'){
            //REMOVE EXISTING GLOBAL PIVOT TO ACTIVITY SAFELY
            try{
                $old_pivot = UserActivity::where('user_id', $payload['user_id'])->where('activity_id', @$activity->id)->first();
                if(!empty($old_pivot)){
                    $old_pivot->delete();
                }
            }catch(\Exception $e){

            }


            $uActivity = Activity::where('uid', $uid)->where('type','private')->first();
            if(empty($uActivity)){
                //CREATE NEW PRIVATE ACTIVITY
                $privateActivity = Activity::create([
                    'uid' => (string) Str::uuid(),
                    'created_by' => $admin->uid,
                    'title' => $payload['title'],
                    'description' => $payload['description'],
                    'image' => @$payload['image'],
                    'type' => 'private',
                    'date' => $payload['date'],
                ]);

                // CRETE NEW PIVOT
                UserActivity::create(['user_id' => $payload['user_id'], 'activity_id'=>$privateActivity->id]);

            }else{
                $uActivity->update($payload);
            }


        }else{
            $payload['type'] = 'global';
            $activity->update($payload);
        }

        DB::commit();

        return back()->withMessage('One Activity Updated');

    }

    public function delete($id, $type, $user_id){
        // dd($id, $type, $user_id);
        $activity = Activity::where('uid', $id)->first();
        if(!empty($activity)){
            DB::beginTransaction();
            if($type==='private'){
                $pivot = UserActivity::where('user_id', $user_id)->where('activity_id', $activity->id)->first();
                if(!empty($pivot)){
                    $pivot->delete();
                }
            }else{
                //get all related pivot
                $pivots = UserActivity::where('activity_id', $activity->id)->get();
                foreach($pivots as $pivot){
                    $pivot->delete();
                }
                $activity->delete();
            }
            DB::commit();

        }

    }
}
