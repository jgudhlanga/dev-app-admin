<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	
    public function run()
    {
	    $this->call(UsersSeeder::class);
	    $this->call(StatusesSeeder::class);
	    $this->call(IconsSeeder::class);
	    $this->call(ModulesSeeder::class);
	    $this->call(PagesSeeder::class);
	    $this->call(MaritalStatusSeeder::class);
	    $this->call(RacesSeeder::class);
	    $this->call(TitlesSeeder::class);
	    $this->call(GenderSeeder::class);
	    $this->call(OccupationsSeeder::class);
	    $this->call(CountriesSeeder::class);
	    $this->call(MemberTypesTableSeeder::class);
	    $this->call(AddressTypeTableSeeder::class);
	    $this->call(RolesTableSeeder::class);
	    $this->call(UserRolesSeeder::class);
	    //$this->call(LaratrustSeeder::class);
	    /*factory(App\Models\Users\User::class, 1)->create();
	    factory(App\Models\Users\User::class, 1)->create();
	    factory(App\Models\Products\Product::class, 50)->create();
	    factory(App\Models\Reviews\Review::class, 300)->create();
	    factory(App\Models\General\Status::class, 1)->create();*/
    }
}
