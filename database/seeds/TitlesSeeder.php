<?php

use Illuminate\Database\Seeder;
use App\Models\General\Title;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class TitlesSeeder extends Seeder
{
   
    public function run()
    {
	    //Empty the table
	    DB::table('titles')->delete();
	    // Reset Auto Increment
	    DB::statement('ALTER TABLE titles AUTO_INCREMENT = 0');
	    $data = [
		    1 => ['id' => 1, 'name' => 'Mr', 'description' => 'Mr', 'status_id' => Status::ACTIVE,'created_by' => 1],
		    2 => ['id' => 2, 'name' => 'Mrs', 'description' => 'Mrs', 'status_id' => Status::ACTIVE,'created_by' => 1],
		    3 => ['id' => 3, 'name' => 'Dr', 'description' => 'Dr', 'status_id' => Status::ACTIVE,'created_by' => 1],
	    ];
	
	    foreach ($data as $row)
	    {
		    Title::firstOrCreate($row);
	    }
    }
}
