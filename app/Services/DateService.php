<?php

namespace App\Services;

use App\Models\Activity;

class DateService {

    public static function fetchDates(){
        $activities = Activity::orderBy('created_at', 'desc')->select('date', 'title', 'type', 'created_at')->get();
        return $activities;
    }
}
