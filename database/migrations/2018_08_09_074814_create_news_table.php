<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('title');
	        $table->longText('content');
	        $table->string('slug');
	        $table->integer('user_id')->unsigned()->references('id')->on('users');
	        $table->integer('category_id')->unsigned();
	        $table->integer('published')->default(1);
	        $table->integer('spam')->default(0);
	        $table->string('image')->nullable();
	        $table->integer('count_view')->unsigned()->default(0);
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
        Schema::dropIfExists('news');
    }
}
