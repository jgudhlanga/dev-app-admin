<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('module_id')->unsigned()->index()->nullable();
	        $table->string('title')->nullable()->unique();
	        $table->string('description')->nullable();
	        $table->integer('icon_id')->unisigned()->index()->nullable();
	        $table->string('page_url')->unique()->nullable();
	        $table->integer('status_id')->unsigned()->default(1)->nullable();
	        $table->integer('position')->nullable();
	        $table->integer('created_by')->unsigned()->nullable();
	        $table->integer('updated_by')->unsigned()->nullable();
	        $table->foreign('module_id')->references('id')->on('modules');
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
        Schema::dropIfExists('pages');
    }
}
