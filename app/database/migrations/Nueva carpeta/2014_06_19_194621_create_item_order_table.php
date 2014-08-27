<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('item_order', function($table){
       $table->create();
       $table->increments('id');
       $table->integer('order_id');
       $table->integer('item_id');
       $table->integer('quantity');
       $table->decimal('price');
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
	Schema::drop('item_order');
	}

}
