<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stockists', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('address');
            $table->string('phone');
            $table->string('website');
            $table->text('image_path')->nullable();
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
		Schema::drop('stockists');
	}

}
