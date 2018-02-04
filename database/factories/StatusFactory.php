<?php

use Faker\Generator as Faker;

$factory->define(App\Models\General\Status::class, function (Faker $faker) {
    return [
	    'title' => 'Active',
	    'description' => 'Model is Active',
    ];
});
