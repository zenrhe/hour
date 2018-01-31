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


Route::get('/', function () {return view('welcome');});
//Route::get('/', 'HomeController@index')->name('home');


//Users
Route::get('users', 'UsersController@index');
Route::get('users/{user}', 'UsersController@show');

//Venues
Route::get('venues', 'VenueController@index');
Route::get('venues/{venue}', 'VenueController@show');

//Logs
Route::get('logs/create', 'LogController@create');
Route::POST('logs', 'LogController@store');

Route::get('userlogs/', 'LogController@getUserLogs');
Route::get('venuelogs/', 'LogController@getVenueLogs');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

