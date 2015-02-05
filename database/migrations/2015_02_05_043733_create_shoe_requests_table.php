<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoeRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shoe_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shoe_request_number')->unique()->unsigned()->index();
			$table->integer('member_id')->unsiged()->index();
			$table->integer('status_id')->unsiged()->index();
			$table->integer('size');
			$table->string('brand');
			$table->string('model');
			$table->text('message');
			$table->decimal('price')->nullable();
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
		Schema::drop('shoe_requests');
	}

}
