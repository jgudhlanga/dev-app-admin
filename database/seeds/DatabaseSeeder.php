<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // $this->call(UsersTableSeeder::class);
	    factory(App\Models\Users\User::class, 1)->create();
	    //factory(App\Models\Products\Product::class, 50)->create();
	    //factory(App\Models\Reviews\Review::class, 300)->create();
	    factory(App\Models\Common\Status::class, 1)->create();
    }
}
