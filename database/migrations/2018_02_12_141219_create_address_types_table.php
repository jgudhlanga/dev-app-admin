<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTypesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('address_types', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique()->nullable();
			$table->text('description')->nullable();
			$table->integer('status_id')->index()->unsigned()->default(1);
			$table->integer('created_by')->index()->unsigned()->nullable();
			$table->integer('updated_by')->index()->unsigned()->nullable();
			$table->foreign('status_id')->references('id')->on('statuses');
			$table->foreign('created_by')->references('id')->on('users');
			$table->foreign('updated_by')->references('id')->on('users');
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
		Schema::dropIfExists('address_types');
	}
}
