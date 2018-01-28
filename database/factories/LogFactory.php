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


$factory->define(App\Log::class, function (Faker $faker) {
    return [
        'user_id' => App\User::all()->random()->id,
        'hours' => $faker->randomDigitNotNull(),
        'dateWorked' => $faker->dateTimeBetween('-1 years', 'now'),
        'description' => $faker->sentence(50),
        'venue_id' => App\Venue::all()->random()->id,
        'submitted'  => $faker->dateTimeBetween('-1 years', 'now'),
        'approvedBy' => App\User::all()->random()->id,
        'approvedAt'  => $faker->dateTimeBetween('-1 years', 'now'),
    ];
});