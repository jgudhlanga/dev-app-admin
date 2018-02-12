<?php

use Illuminate\Database\Seeder;
use App\Models\General\AddressType;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class AddressTypeTableSeeder extends Seeder
{
	
	public function run()
	{
		//Empty the table
		DB::table('address_types')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE address_types AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'name' => 'Physical', 'description' => 'Physical Address', 'status_id' => Status::ACTIVE,'created_by' => 1],
			2 => ['id' => 2, 'name' => 'Postal', 'description' => 'Postal Address', 'status_id' => Status::ACTIVE,'created_by' => 1],
		];
		
		foreach ($data as $row)
		{
			AddressType::firstOrCreate($row);
		}
	}
}
