<?php

use App\Models\Activity;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['global', 'private'];
        $users = User::get();
        foreach($types as $type){
            if($type==='global'){
                factory(Activity::class, 4)->create(['type'=>$type]);
                $activities = Activity::orderBy('id', 'desc')->take(4)->get();
                foreach($activities as $activity){
                    foreach($users as $user){
                        UserActivity::create(['user_id'=>$user->id, 'activity_id'=>$activity->id]);
                    }

                }
            }else{
                foreach($users as $user){
                    factory(Activity::class, 1)->create(['type'=>$type]);
                    $activities = Activity::orderBy('id', 'desc')->take(1)->get();
                    foreach($activities as $activity){
                        UserActivity::create(['user_id'=>$user->id, 'activity_id'=>$activity->id]);
                    }
                }
            }

        }



    }
}
