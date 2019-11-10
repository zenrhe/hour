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

        
        //Admin User
        User::create(array(
            'name' => 'zenrhe',
            'first_name' => 'Rowan',
            'last_name' => ' Evenstar',
            'email' => 'zenrhe@gmail.com',
            'password' => Hash::make('test'),
            'admin' => '1',
            'profile_id' => '1'
        ));

        //Test User (not Admin)
        User::create(array(
            'name' => 'test',
            'first_name' => 'Tester FN',
            'last_name' => ' Tester LN',
            'email' => 'test@example.com',
            'password' => Hash::make('test'),
            'admin' => '0'
        ));

        //Test User Admin
        User::create(array(
            'name' => 'test2',
            'first_name' => 'Chris ',
            'last_name' => ' Tenner',
            'email' => 'test2@example.com',
            'password' => Hash::make('test'),
            'admin' => '1'
        ));
            
    }
}
