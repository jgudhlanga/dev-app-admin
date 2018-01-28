<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Users\User::class, function (Faker $faker) {
    return [
        'first_name' => 'James',
	    'last_name'  => 'Gudhlanga',
	    'mobile'     => '0614367071',
	    'profile_picture'   => 'jgudhlanga.jpg',
        'email' => 'jimmyneds@gmail.com',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});
