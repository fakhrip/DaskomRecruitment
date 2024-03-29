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
    return redirect("/login", 301);
})->name('main')->middleware('guest');

Route::get('/caas', function () {
    return view('caas');
})->middleware('auth');

Route::get('/logout', 'Auth\LoginController@logout')->middleware('auth');

Route::get('/updateToken', 'API\UserController@index')
    ->name('updateToken')->middleware('auth');

Route::post('/notification', 'API\NotificationController@store')
    ->name('createNotification')->middleware('auth');
    
Route::post('/updateStatus', 'API\StatusController@store')
    ->name('updateStatus')->middleware('auth');
    
Route::post('/addAvailableSchedule', 'API\AvailableScheduleController@store')
    ->name('addSchedule')->middleware('auth');

Auth::routes();
