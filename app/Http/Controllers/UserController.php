<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'desc')->paginate(30);
        return view('pages.user.index')->with([
            'users'=>$users
        ]);
    }

    public function activities($id){
        $user = User::whereUid($id)->first();
        if(empty($user)){
            return back()->withErrors(['User not found']);
        }

        return view('pages.user.activity')->with([
            'user' => $user
        ]);
    }
}
