<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
       // $this->call(VenuesTableSeeder::class);
        


        //Call mupltiple seeders
        $this->call([
            UsersTableSeeder::class,
            VenuesTableSeeder::class,
            LogsTableSeeder::class,
        ]);
    }
}
