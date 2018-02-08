<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
//        App\Currency::pluck('id')->random()


$factory->define(App\Profile::class, function (Faker $faker) {
    return [

        'user_id' => App\User::all()->random()->id,
        
    ];
});