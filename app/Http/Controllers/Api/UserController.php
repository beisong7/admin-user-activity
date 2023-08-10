<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function activities(Request $request){
        $range = $request->date_range;
        if(!empty($range)){
            $hasDash = strpos($range, "-");
            if($hasDash){
                $dates = explode("-", $range);
                $user = Auth::guard('api')->user();
                $start = date("Y-m-d", strtotime(trim($dates[0])));
                $stop = date("Y-m-d", strtotime(trim($dates[1])));

                $query = $user->activities->whereBetween("date", [$start, $stop]);
                return $this->successResponse("Loaded successfully", $query);
            }
        }
        return $this->errorResponse("Failed to handled request, invalid range", 500);
    }
}
