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
use Illuminate\Support\Facades\Storage;


//Welcome Pages
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Users
Route::get('users', 'UsersController@index')->name('users.index');
Route::get('users/{user}', 'UsersController@show')->name('users.show');

//Profiles
Route::get('profile', 'profileController@index')->name('profile.index');
Route::get('profile/{user}', 'profileController@show')->name('profile.show');
Route::post('profile/{user}', 'profileController@update')->name('profile.update');

//Venues
Route::get('venues', 'VenueController@index')->name('venues.index');

Route::get('venues/{venue}', 'VenueController@show');
Route::get('venues/create', 'VenueController@create');
Route::post('venues', 'VenueController@store');

//Logs
Route::get('logs/', 'LogController@index')->name('logs.index');
Route::get('logs/create', 'LogController@create')->name('logs.create');
Route::get('logs/create2', 'LogController@create2')->name('logs.create2');
Route::POST('logs', 'LogController@store');

Route::get('userlogs/', 'LogController@getUserLogs');
Route::get('venuelogs/', 'LogController@getVenueLogs');

//Avatar
Route::get('avatar', function () {
    return view('profile.avatar');
});

Route::POST('avatars',function(){

    //request()->file('avatar')->store('avatars'); //just stores with random filename. Returns path

    //Setting File Name and Store
    $file = request()->file('avatar');

    $ext = $file->guessClientExtension();

    //Store to storage/app/avatars/user_id/avatar.{extension}
    $file->storeAs('public/avatars/'.auth()->id(),"testAvatar.{$ext}");

    //echo asset('storage/public/avatars/11/avatar.jpg');

    //$visibility = Storage::getVisibility('$url');


    // $url = Storage::url('avatars/11/avatar.jpg');
     dd(asset('storage/public/avatars/11/avatar.jpg'));
     //dd($visibility);


return back();
});

// Route::get('avatars/{id}/{filename}', function($filename) {

//     //When a avatar file request is made

//     //if the files cant be found, return a placeholder image
//     // return response( file_get_contents('./avatars/placeholder.jpeg') )
//     return response( file_get_contents('./avatars/11/avatar.jpeg') )
//         ->header('Content-Type','image/jpeg');

// });


