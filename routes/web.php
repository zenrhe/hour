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
// php artisan route:list 
// https://laravel.com/docs/5.5/controllers#resource-controllers

*/


Route::get('/', function () {
    return view('welcome');
});

//Users
Route::get('users', 'UsersController@index')->name('users.index');
Route::get('users/{user}', 'UsersController@show')->name('users.show');

//Venues
Route::get('venues', 'VenueController@index')->name('venues.index');

//Route::get('venues/{venue}', 'VenueController@show');
Route::get('venues/create', 'VenueController@create');
Route::post('venues', 'VenueController@store');

//Logs
Route::get('logs/', 'LogController@index')->name('logs.index');
Route::get('logs/create', 'LogController@create')->name('logs.create');
Route::get('logs/create2', 'LogController@create2')->name('logs.create2');
Route::POST('logs', 'LogController@store');

Route::get('userlogs/', 'LogController@getUserLogs');
Route::get('venuelogs/', 'LogController@getVenueLogs');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



