<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuitemOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('menuitem_order', function(Blueprint $table)
		{
		Schema::table('menuitem_order', function($table){
       $table->create();
       $table->increments('id');
       $table->integer('order_id');
       $table->integer('menuitem_id');
       $table->integer('quantity');
       $table->timestamps();
    });
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('menuitem_order', function(Blueprint $table)
		{
			Schema::drop('menuitem_order');
		});
	}

}
