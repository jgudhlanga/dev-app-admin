<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\General\Status;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('email')->unique();
            $table->string('password');
	        $table->string('mobile')->nullable();
	        $table->integer('gender_id')->nullable();
	        $table->integer('status_id')->default(Status::ACTIVE)->nullable();
	        $table->integer('title_id')->nullable();
	        $table->string('facebook')->nullable();
	        $table->string('twitter')->nullable();
	        $table->string('google_plus')->nullable();
	        $table->string('linkedin')->nullable();
	        $table->string('skype')->nullable();
	        $table->string('youtube')->nullable();
	        $table->string('whatsapp')->nullable();
	        $table->string('github')->nullable();
	        $table->string('bitbucket')->nullable();
	        $table->string('gitlab')->nullable();
	        $table->integer('created_by')->nullable();
	        $table->integer('updated_by')->nullable();
	        $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
