<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuitemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	Schema::table('menuitems', function($table){
       $table->create();
       $table->increments('id');
       $table->string('name');
       $table->string('description');
       $table->float('price');
       $table->integer('itemcategory_id');
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
	Schema::drop('menuitems');
	}

}
