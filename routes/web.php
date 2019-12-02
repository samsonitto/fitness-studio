<?php

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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('settings', 'UserController@show_settings');
Route::get('calendar', 'CalendarController@index')->name('calendar');
Route::group(['middleware' => ['auth','admin']], function() {
    Route::get('users', 'UserController@list_all');
});
Route::get('json-users','UserController@list_json');
Route::get('coursejson', 'UserController@coursejson');
Route::delete('users/delete/{id}', 'UserController@destroy');
Route::post('users/ban/{id}', 'UserController@ban');
Route::post('users/unban/{id}', 'UserController@unban');
Route::post('users/make_admin/{id}', 'UserController@make_master');
Route::post('users/make_master/{id}', 'UserController@make_admin');
Route::post('users/unmaster/{id}', 'UserController@unmaster');
Route::post('users/unadmin/{id}', 'UserController@unadmin');

Route::group(['middleware' => ['auth']], function() {
    Route::get('bookings', 'BookingController@my_bookings');
});
Route::delete('bookings/delete/{id}', 'BookingController@destroy');

