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
        //Create Single Venue
        //factory(App\Venue::class)->create();

        //Create Multiple Venues
        $count = 3;
        factory(App\Venue::class,$count)->create();

    }
}
