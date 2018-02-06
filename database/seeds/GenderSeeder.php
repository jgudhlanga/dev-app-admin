<?php

use Illuminate\Database\Seeder;
use App\Models\General\Gender;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;


class GenderSeeder extends Seeder
{
    public function run()
    {
    	//Empty the table
	    DB::table('genders')->delete();
	    // Reset Auto Increment
	    DB::statement('ALTER TABLE genders AUTO_INCREMENT = 0');
	    $data = [
	    	1 => ['id' => 1, 'name' => 'Male', 'description' => 'Male', 'status_id' => Status::ACTIVE,'created_by' => 1],
	    	2 => ['id' => 2, 'name' => 'Female', 'description' => 'Female', 'status_id' => Status::ACTIVE,'created_by' => 1],
	    	3 => ['id' => 3, 'name' => 'Unknown', 'description' => 'Unknown', 'status_id' => Status::ACTIVE,'created_by' => 1],
	    ];
	
	    foreach ($data as $gender)
	    {
		    Gender::firstOrCreate($gender);
	    }
    }
}
