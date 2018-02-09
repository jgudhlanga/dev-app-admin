<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\General\Status;

class SetupCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create(\Config::get('countries.table_name'), function($table)
		{
			$table->increments('id');
		    $table->string('capital')->nullable();
		    $table->string('citizenship')->nullable();
		    $table->string('country_code', 3)->nullable();
		    $table->string('currency')->nullable();
		    $table->string('currency_code')->nullable();
		    $table->string('currency_sub_unit')->nullable();
            $table->string('currency_symbol', 3)->nullable();
            $table->integer('currency_decimals')->nullable();
		    $table->string('full_name')->nullable();
		    $table->string('iso_3166_2', 2)->nullable();
		    $table->string('iso_3166_3', 3)->nullable();
		    $table->string('name')->nullable();
		    $table->string('region_code', 3)->nullable();
		    $table->string('sub_region_code', 3)->nullable();
		    $table->boolean('eea')->nullable();
		    $table->string('calling_code', 3)->nullable();
		    $table->string('flag')->nullable();
			$table->integer('created_by')->index()->unsigned()->nullable();
			$table->integer('updated_by')->index()->unsigned()->nullable();
			$table->integer('status_id')->index()->unsigned()->nullable()->default(Status::ACTIVE);
			$table->foreign('status_id')->references('id')->on('statuses');
			$table->foreign('created_by')->references('id')->on('users');
			$table->foreign('updated_by')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down()
	{
		Schema::drop(\Config::get('countries.table_name'));
	}

}
