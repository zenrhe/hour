<?php

use Illuminate\Database\Seeder;

class VenuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create Single User
        //factory(App\User::class)->create();

        //Create Multiple Users
        $count = 10;
        factory(App\Venue::class,$count)->create();

    }
}
