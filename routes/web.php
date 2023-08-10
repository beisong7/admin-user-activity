<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');
Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');


    Route::get('/activity/calendar', 'DashboardController@calendar')->name('activity.calendar');

    Route::resource('activity', 'ActivityController');
    Route::get('activity/{id}/delete', 'ActivityController@delete')->name('activity.delete');

    Route::get('users', 'UserController@index')->name('user.index');
    Route::get('users/{id}/activities', 'UserController@activities')->name('user.activities');



});
