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
//Route::get('/', 'HomeController@index')->name('home');


//Users
Route::get('users', 'UsersController@index');
Route::get('users/{user}', 'UsersController@show');

//Venues
Route::get('venues', 'VenueController@index')
    ->name('venues.index');
    // to make the VenueController@store redirect work
    // since route() uses the route name and converts it to a url.
    //
    // you can similarly add names to your other routes, or checkout
    // Route::resource('venues', 'VenuesController');
    // which will do a full set of crud routes for you in one line! :)
    // https://laravel.com/docs/5.5/controllers#resource-controllers
    //
    // Also, try running "php artisan route:list" in a terminal
    // This will show you all of your routes and allow you to troubleshoot
    // names, HTTP verbs, Controller methods, etc. etc.

//Route::get('venues/{venue}', 'VenueController@show');
Route::get('venues/create', 'VenueController@create');
Route::post('venues', 'VenueController@store');


//Logs
Route::get('logs/create', 'LogController@create');
Route::POST('logs', 'LogController@store');

Route::get('userlogs/', 'LogController@getUserLogs');
Route::get('venuelogs/', 'LogController@getVenueLogs');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

