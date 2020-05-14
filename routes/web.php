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

Route::group(['middleware' => ['auth', 'admin', 'notSuspend']], function () {
    Route::get('/', 'HomeController@index')->name('root');
    Route::get('/network', 'NetworkController@index')->name('network.index');
    Route::post('/network', 'NetworkController@import')->name('network.import');

    Route::resource('groups', 'GroupsController', ['except' => ['new', 'show']]);
    Route::resource('lights', 'LightsController', ['except' => ['new', 'show']]);
    Route::resource('routines', 'RoutinesController', ['except' => ['new', 'show']]);

    Route::delete('timer/{id}', 'TimersController@destroy')->name('timers.destroy');

    Route::resource('users', 'UsersController', ['except' => ['new', 'show']]);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/guest', 'GuestController@guest')->name('guest');
    Route::get('/guest/group/{id}/on', 'GuestController@groupSwitch')->name('guest.group');
});

Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {
    Route::get('/oauth2/azure/redirect', 'OAuthController@azureRedirect')->name('auth.azure.redirect');
    Route::get('/oauth2/azure/callback', 'OAuthController@azureCallback')->name('auth.azure.callback');
});

Auth::routes(['register' => false, 'reset' => false]);
