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

// Public API
Route::group(['prefix' => 'v1', "namespace" => "Api"], function () {
    Route::get('groups', "GroupsController@index")->name('api.groups.index');
    Route::get('v1/group/{id}/on', 'GroupsController@guestOn')->name('api.guest.group');
});

// Auth API
Route::group(['prefix' => 'v1', "namespace" => "Api", "middleware" => 'auth:api'], function () {
   Route::get('light/{id}', 'LightsController@getLights')->name('api.lights.show');
   Route::get('light/{id}/state/{mode}', 'LightsController@setLightState')->name('api.lights.state');
   Route::get('light/{id}/state', 'LightsController@switchLightState')->name('api.lights.switch');

   Route::get('group/{id}/state/{mode}', 'GroupsController@setGroupState')->name('api.groups.state');
   Route::get('group/{id}/state/{mode}/{period}', 'GroupsController@setGroupStateForXMinutes')->name('api.groups.state.period');
});
