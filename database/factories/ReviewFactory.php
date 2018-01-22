<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reviews\Review::class, function (Faker $faker) {
    return [
        'customer'  => $faker->name,
	    'review'    => $faker->paragraph,
	    'star'      => $faker->numberBetween(0, 5),
	    'product_id' => function(){
		   return  \App\Models\Products\Product::all()->random();
	    }
    ];
});
