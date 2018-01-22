<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Common\Status::class, function (Faker $faker) {
    return [
	    'title' => 'Active',
	    'description' => 'Model is Active',
    ];
});
