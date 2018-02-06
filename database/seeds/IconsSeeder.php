<?php

use Illuminate\Database\Seeder;
use App\Models\General\Icon;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class IconsSeeder extends Seeder
{
	
	public function run()
	{
		//Empty the table
		DB::table('icons')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE icons AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'class' => 'fa fa-home',  'status_id' => Status::ACTIVE,'created_by' => 1],
			2 => ['id' => 2, 'class' => 'fa fa-university', 'status_id' => Status::ACTIVE,'created_by' => 1],
			3 => ['id' => 3, 'class' => 'fa fa-group', 'status_id' => Status::ACTIVE,'created_by' => 1],
			4 => ['id' => 4, 'class' => 'fa fa-angle-right', 'status_id' => Status::ACTIVE,'created_by' => 1],
			5 => ['id' => 5, 'class' => 'fa fa-bed', 'status_id' => Status::ACTIVE,'created_by' => 1],
			6 => ['id' => 6, 'class' => 'fa fa-wrench', 'status_id' => Status::ACTIVE,'created_by' => 1],
			7 => ['id' => 7, 'class' => 'fa fa-cart-plus', 'status_id' => Status::ACTIVE,'created_by' => 1],
		];
		
		foreach ($data as $row)
		{
			Icon::firstOrCreate($row);
		}
	}
}