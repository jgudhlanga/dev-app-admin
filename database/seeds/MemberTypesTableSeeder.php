<?php

use Illuminate\Database\Seeder;
use App\Models\General\MemberType;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class MemberTypesTableSeeder extends Seeder
{
	
	public function run()
	{
		//Empty the table
		DB::table('member_types')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE member_types AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'name' => 'Individual', 'description' => 'Individual', 'status_id' => Status::ACTIVE,'created_by' => 1],
			2 => ['id' => 2, 'name' => 'Ministry', 'description' => 'Ministry', 'status_id' => Status::ACTIVE,'created_by' => 1],
			3 => ['id' => 3, 'name' => 'Company', 'description' => 'Company', 'status_id' => Status::ACTIVE,'created_by' => 1],
			4 => ['id' => 4, 'name' => 'Unknown', 'description' => 'Unknown', 'status_id' => Status::ACTIVE,'created_by' => 1],
		];
		
		foreach ($data as $row)
		{
			MemberType::firstOrCreate($row);
		}
	}
}
