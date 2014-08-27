<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersfaceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	  Schema::create('usersface', function($table)
  {
   $table->increments('id');
   $table->string('email')->unique();
   $table->string('password');
   $table->bigInteger('facebook_id')->unsigned()->nullable()->unique();
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
	Schema::dropIfExists('usersface');
	}

}
