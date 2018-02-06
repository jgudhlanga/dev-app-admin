<?php

use Illuminate\Database\Seeder;
use App\Models\General\Occupation;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class OccupationsSeeder extends Seeder
{
	
	public function run()
	{
		//Empty the table
		DB::table('occupations')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE occupations AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'name' => 'Software Developer', 'description' => 'Software Developer', 'status_id' => Status::ACTIVE,'created_by' => 1],
			2 => ['id' => 2, 'name' => 'Teacher', 'description' => 'Teacher', 'status_id' => Status::ACTIVE,'created_by' => 1],
			3 => ['id' => 3, 'name' => 'Administrator', 'description' => 'Administrator', 'status_id' => Status::ACTIVE,'created_by' => 1],
			4 => ['id' => 4, 'name' => 'Software Tester', 'description' => 'Software Tester', 'status_id' => Status::ACTIVE,'created_by' => 1],
			5 => ['id' => 5, 'name' => 'Project Manager', 'description' => 'Project Manager', 'status_id' => Status::ACTIVE,'created_by' => 1],
			6 => ['id' => 6, 'name' => 'Unknown', 'description' => 'Unknown', 'status_id' => Status::ACTIVE,'created_by' => 1],
		];
		
		foreach ($data as $row)
		{
			Occupation::firstOrCreate($row);
		}
	}
}