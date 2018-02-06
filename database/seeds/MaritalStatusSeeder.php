<?php

use Illuminate\Database\Seeder;
use App\Models\General\MaritalStatus;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class MaritalStatusSeeder extends Seeder
{
	
	public function run()
	{
		//Empty the table
		DB::table('marital_statuses')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE marital_statuses AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'name' => 'Unknown', 'description' => 'Unknown', 'status_id' => Status::ACTIVE,'created_by' => 1],
			2 => ['id' => 2, 'name' => 'Single', 'description' => 'Single', 'status_id' => Status::ACTIVE,'created_by' => 1],
			3 => ['id' => 3, 'name' => 'Married', 'description' => 'Female', 'status_id' => Status::ACTIVE,'created_by' => 1],
			4 => ['id' => 4, 'name' => 'Divorced', 'description' => 'Divorced', 'status_id' => Status::ACTIVE,'created_by' => 1],
			5 => ['id' => 5, 'name' => 'Separated', 'description' => 'Separated', 'status_id' => Status::ACTIVE,'created_by' => 1],
			6 => ['id' => 6, 'name' => 'Widowed', 'description' => 'Widowed', 'status_id' => Status::ACTIVE,'created_by' => 1],
		];
		
		foreach ($data as $row)
		{
			MaritalStatus::firstOrCreate($row);
		}
	}
}