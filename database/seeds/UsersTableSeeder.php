<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Faker ERROR---------
        //Create Single User
        //factory(App\User::class)->create();

        //Create Multiple Users
        //$count = 10;
        //factory(App\User::class,$count)->create();

        
        User::create(array(
            'username' => 'zenrhe@gmail.com',
            'password' => Hash::make('test')
        ));
            
    }
}
