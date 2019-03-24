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
Route::middleware('auth:api')->get('/notifications', 'API\NotificationController@index');
Route::middleware('auth:api')->get('/seeAllNotifications', 'API\NotificationController@seeAllNotification');
Route::middleware('auth:api')->get('/getAllAvailableSchedules', 'API\AvailableScheduleController@index');
Route::middleware('auth:api')->get('/cekStatus', 'API\StatusController@index');
Route::middleware('auth:api')->post('/changeUserData', 'API\UserController@update');
