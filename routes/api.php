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

// Auth API
Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'middleware' => ['auth:api', 'admin', 'notSuspend']], function () {
    Route::get('groups', 'GroupsController@index')->name('api.groups.index');
    Route::get('network', 'NetworkController@index')->name('api.network.index');
    Route::get('users', 'UsersController@search')->name('api.users.search');

    Route::get('lights', 'LightsController@index')->name('api.lights.index');
    Route::get('lights/search', 'LightsController@search')->name('api.lights.search');
    Route::get('lights/{id}', 'LightsController@getLights')->name('api.lights.show');
    Route::delete('lights/{id}', 'LightsController@delete')->name('api.lights.delete');
    Route::get('lights/{id}/state/{mode}', 'LightsController@setLightState')->name('api.lights.state');
    Route::get('lights/{id}/state', 'LightsController@switchLightState')->name('api.lights.switch');

    Route::get('groups/{id}/state/{mode}', 'GroupsController@setGroupState')->name('api.groups.state');
    Route::get('groups/{id}/state/{mode}/{period}', 'GroupsController@setGroupStateForXMinutes')->name('api.groups.state.period');
});
