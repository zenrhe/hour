<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');

            $table->string('position')->nullable($value = true)	;            
            $table->integer('default_venue_1')->nullable($value = true);
            $table->integer('default_venue_2')->nullable($value = true);
            $table->integer('default_venue_3')->nullable($value = true);
            $table->text('theme')->nullable(); //This should become a lookup when implemented
            $table->string('nickname')->nullable($value = true)	;
            $table->string('avatar')->nullable($value = true);
            $table->text('address')->nullable($value = true)	;
            $table->text('bio')->nullable($value = true)	;
            $table->text('phone')->nullable($value = true)	;
            $table->date('dob')->nullable($value = true)	;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
