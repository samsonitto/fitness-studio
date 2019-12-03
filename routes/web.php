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
Route::delete('settings/delete-account/{id}', 'UserController@deleteAccount')->name('delete.account');
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

Route::get('change-password', 'Auth\ChangePasswordController@index')->name('password.change');
Route::post('change-password', 'Auth\ChangePasswordController@changePassword')->name('password.update');

Route::get('change-email', 'Auth\ChangePasswordController@email')->name('email.change');
Route::post('change-email', 'Auth\ChangePasswordController@changeEmail')->name('email.update');

Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::get('courses', 'CalendarController@my_courses')->name('admin.courses');
});

Route::delete('courses/{id}', 'ClassIsAvailableController@destroy')->name('delete.course');
