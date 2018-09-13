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

Route::get('/user/{email}/data', 'UsersController@getUserDetails')->name('user.email.data');
Route::get('/users/{type}', 'UsersController@getPriestUsers')->name('users.priest');
Route::get('/user/{id}/events/unconfirm', 'UsersController@unconfirmedEvents')->name('user.id.events.unconfirmed');

Route::get('/events', 'EventsController@index')->name('events');
Route::get('/{user_id}/events', 'EventsController@userEvents')->name('user-events');

Route::get('/events/{id}/confirm', 'EventsController@confirmEvent')->name('events.id.confirm');
Route::get('/events/{event_date}', 'EventsController@getEventsFromDate')->name('events.date');
Route::post('/events/{id}/destroy', 'EventsController@destroy')->name('events.id.destroy');
Route::post('/events/store', 'EventsController@store')->name('events.store');
Route::post('/events/{id}/update', 'EventsController@update')->name('events.id.update');

Route::get('/groups', 'GroupsController@index')->name('groups');
Route::get('/groups/{id}/show', 'GroupsController@show')->name('groups.id.show');
Route::post('/groups/{id}/destroy', 'GroupsController@destroy')->name('groups.id.destroy');
Route::post('/groups/store', 'GroupsController@store')->name('groups.store');
Route::post('/groups/{id}/update', 'GroupsController@update')->name('groups.id.update');

Route::post('/group-services/store', 'GroupServicesController@store')->name('groups-services.store');
Route::post('/group-services/{id}/destroy', 'GroupServicesController@destroy')->name('groups-services.id.destroy');





