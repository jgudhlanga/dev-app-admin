<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('title')->nullable()->unique();
	        $table->string('description')->nullable();
	        $table->string('class')->nullable();
	        $table->string('module_url')->unique()->nullable();
	        $table->integer('status_id')->unsigned()->index()->default(1)->nullable();
	        $table->integer('position')->nullable();
	        $table->integer('created_by')->unsigned()->nullable();
	        $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('modules');
    }
}
