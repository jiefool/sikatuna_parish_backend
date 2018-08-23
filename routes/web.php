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

Route::get('/home/getToken', 'HomeController@getToken')->name('get-token');

Route::get('/user/{username}', 'UsersController@getUserDetails')->name('get-user-details');
Route::get('/user/{id}/events/unconfirm', 'UsersController@unconfirmedEvents')->name('user.id.events.unconfirmed');

Route::get('/events', 'EventsController@index')->name('events');
Route::get('/events/{id}/confirm', 'EventsController@confirmEvent')->name('events.id.confirm');

Route::post('/events/{id}/destroy', 'EventsController@destroy')->name('events.id.destroy');
Route::post('/events/store', 'EventsController@store')->name('events-store');
