<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservasfaceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	   Schema::table('facereservas', function($table){
       $table->create();
       $table->increments('id');
       $table->string('name');
       $table->date('date');
       $table->string('user_id');
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
	Schema::drop('facereservas');
	}

}
