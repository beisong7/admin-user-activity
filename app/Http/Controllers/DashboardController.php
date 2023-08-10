<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use App\Services\DateService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard(){
        $users = User::select(['id'])->get()->count();
        $activities = Activity::select(['id'])->get()->count();
        return view('pages.dashboard.index')->with([
            'users'=> $users,
            'activities' => $activities,
        ]);
    }

    public function calendar(){
        return view('pages.activity.calendar')->with([
            'dates' => DateService::fetchDates()
        ]);
    }
}
