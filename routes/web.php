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

//Users
Route::get('users', 'UsersController@index');
Route::get('users/{user}', 'UsersController@show');


//Venues
Route::get('venues', 'VenueController@index');
Route::get('venues/{venue}', 'VenueController@show');

//Logs
Route::get('logs/create', 'LogController@create');
Route::POST('logs', 'LogController@store');


//Route::get('users/{user}', 'LogController@getUserLogs');
//Route::get('userlogs/{user}', 'LogController@getUserLogs');
//Route::get('venuelogs/{venue}', 'LogController@getVenueLogs');
//Route::get('logs', 'LogController@index');
//Route::get('logs/{log}', 'LogController@show'); //breaks logs/create??!!













