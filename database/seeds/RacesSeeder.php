<?php

use Illuminate\Database\Seeder;
use App\Models\General\Race;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class RacesSeeder extends Seeder
{
	
	public function run()
	{
		//Empty the table
		DB::table('races')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE races AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'name' => 'Black', 'description' => 'Black', 'status_id' => Status::ACTIVE,'created_by' => 1],
			2 => ['id' => 2, 'name' => 'White', 'description' => 'White', 'status_id' => Status::ACTIVE,'created_by' => 1],
			3 => ['id' => 3, 'name' => 'Coloured', 'description' => 'Coloured', 'status_id' => Status::ACTIVE,'created_by' => 1],
			4 => ['id' => 4, 'name' => 'Unknown', 'description' => 'Unknown', 'status_id' => Status::ACTIVE,'created_by' => 1],
		];
		
		foreach ($data as $row)
		{
			Race::firstOrCreate($row);
		}
	}
}