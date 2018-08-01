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
        Schema::create('users_profiles', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('user_id')->unsigned()->references('id')->on('users');
	        $table->string('name')->nullable();
	        $table->integer('gender')->unsigned()->default('0');
	        $table->string('birthday')->nullable();
	        $table->string('location')->nullable();
	        $table->text('about')->nullable();
	        $table->string('avatar')->default('/default_avatar.png');
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
