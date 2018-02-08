<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable($value = true);
            $table->string('email', 191)->unique();
            
            $table->boolean('active')->default(true);
            $table->boolean('admin')->default(false);
            $table->integer('profile_id')->nullable($value = true);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            
            $table->string('first_name')->nullable($value = true); //until these are utalised when registration updated
            $table->string('last_name')->nullable($value = true); //until these are utalised when registration updated

            //These will move to Profile
            $table->string('nickname')->nullable($value = true)	;
            $table->string('avatar')->default('default.jpg')->nullable($value = true);
            $table->text('description')->nullable($value = true)	;
            $table->text('address')->nullable($value = true)	;
            $table->integer('user_level')->default('1');
            $table->string('position')->nullable($value = true)	;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
