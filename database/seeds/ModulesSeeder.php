<?php

use Illuminate\Database\Seeder;
use App\Models\Modules\Module;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
	
    public function run()
    {
	    //Empty the table
	    DB::table('modules')->delete();
	    // Reset Auto Increment
	    DB::statement('ALTER TABLE modules AUTO_INCREMENT = 0');
	    $data = [
	    	1 => [
	    		'id' => 1,'title' => 'Home', 'description' => 'System Dashboard','class' => 'fa fa-home',
			    'module_url' => 'home', 'status_id' => Status::ACTIVE, 'position' => 1, 'created_by' => 1
		    ],
	    	2 => [
	    		'id' => 2, 'title' => 'Members', 'description' => 'Membership Module','class' => 'fa fa-group',
			    'module_url' => 'members', 'status_id' => Status::ACTIVE, 'position' => 2, 'created_by' => 1
		    ],
	    	3 => [
			    'id' => 3, 'title' => 'CHMS', 'description' => 'Church Management','class' => 'fa fa-university',
			    'module_url' => 'chms', 'status_id' => Status::ACTIVE, 'position' => 3, 'created_by' => 1
		    ],
	    	4 => [
			    'id' => 4, 'title' => 'Procurement', 'description' => 'Procurement Management','class' => 'fa fa-cart-plus',
			    'module_url' => 'procurement', 'status_id' => Status::ACTIVE, 'position' => 4, 'created_by' => 1
		    ],
	    	5 => [
			    'id' => 5, 'title' => 'HMS', 'description' => 'Hostel Management','class' => 'fa fa-bed',
			    'module_url' => 'hms', 'status_id' => Status::ACTIVE, 'position' => 5, 'created_by' => 1
		    ],
	    	6 => [
			    'id' => 6, 'title' => 'Users', 'description' => 'User Management','class' => 'fa fa-group',
			    'module_url' => 'users', 'status_id' => Status::ACTIVE, 'position' => 6, 'created_by' => 1
		    ],
	    ];
	
	    foreach ($data as $row)
	    {
		    Module::firstOrCreate($row);
	    }
    }
}
