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

Route::get('/', 'HomeController@index')->name('root');
Route::get('/guest', 'GuestController@guest')->name('guest');
Route::get('/guest/group/{id}/on', 'GuestController@groupSwitch')->name('guest.group');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/network', 'NetworkController@index')->name('network.index');

    Route::resource('groups', 'GroupsController', ['except' => ['new', 'show']]);
    Route::resource('lights', 'LightsController', ['except' => ['new', 'show']]);
    Route::resource('routines', 'RoutinesController', ['except' => ['new', 'show']]);

    Route::resource('users', 'UsersController', ['except' => ['new', 'show']]);
});

Auth::routes(['register' => false]);
