<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('calendar', 'Api\CalendarController');

Route::get('calendar/{s}', 'Api\CalendarController@show');
Route::get('course/{id}', 'Api\CalendarController@take');

Route::resource('booking', 'Api\BookingController');
Route::post('booking', 'Api\BookingController@store');

Route::resource('users', 'Api\UserController');

Route::resource('class', 'Api\ClassController');

Route::resource('class_is_available', 'Api\ClassIsAvailableController');
Route::post('class_is_available', 'Api\ClassIsAvailableController@store');
Route::delete('class_is_available/delete/{id}', 'Api\ClassIsAvailableController@destroy');

//Route::post('booking/{id}/{class_is_available_id}', 'Api\BookingController@show');


