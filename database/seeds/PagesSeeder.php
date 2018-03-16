<?php

use Illuminate\Database\Seeder;
use App\Models\Modules\Page;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
   
    public function run()
    {
	    //Empty the table
	    DB::table('pages')->delete();
	    // Reset Auto Increment
	    DB::statement('ALTER TABLE pages AUTO_INCREMENT = 0');
	    $data = [
	    	/* MEMBERS PAGES */
		    1 => [
			    'id' => 1,'title' => 'Add Member', 'module_id' => 2, 'class' => 'fa fa-angle-right',
			    'page_url' => 'members/create', 'status_id' => Status::ACTIVE, 'position' => 1, 'created_by' => 1
		    ],
		    2 => [
			    'id' => 2,'title' => 'Dashboard', 'module_id' => 2, 'class' => 'fa fa-angle-right',
			    'page_url' => 'members','status_id' => Status::ACTIVE, 'position' => 2, 'created_by' => 1
		    ],
		    3 => [
			    'id' => 3,'title' => 'List Members', 'module_id' => 2, 'class' => 'fa fa-angle-right',
			    'page_url' => 'members/list','status_id' => Status::ACTIVE, 'position' => 3, 'created_by' => 1
		    ],
		    4 => [
			    'id' => 4,'title' => 'Setup', 'module_id' => 2, 'class' => 'fa fa-angle-right',
			    'page_url' => 'members/setup','status_id' => Status::ACTIVE, 'position' => 4, 'created_by' => 1
		    ],
		    
		    /* CHMS PAGES */
		    5 => [
			    'id' => 5,'title' => 'Dashboard', 'module_id' => 3, 'class' => 'fa fa-angle-right',
			    'page_url' => 'chms', 'status_id' => Status::ACTIVE, 'position' => 1, 'created_by' => 1
		    ],
		    6 => [
			    'id' => 6,'title' => 'Cell-Groups', 'module_id' => 3, 'class' => 'fa fa-angle-right',
			    'page_url' => 'chms/cell-groups','status_id' => Status::ACTIVE, 'position' => 2, 'created_by' => 1
		    ],
		    7 => [
			    'id' => 7,'title' => 'Setup', 'module_id' => 3, 'class' => 'fa fa-angle-right',
			    'page_url' => 'chms/setup','status_id' => Status::ACTIVE, 'position' => 3, 'created_by' => 1
		    ],
		    /* PROCUREMENT PAGES */
		    8 => [
			    'id' => 8,'title' => 'Dashboard', 'module_id' => 4, 'class' => 'fa fa-angle-right',
			    'page_url' => 'procurement','status_id' => Status::ACTIVE, 'position' => 1, 'created_by' => 1
		    ],
		    /* HMS PAGES */
		    9 => [
			    'id' => 9,'title' => 'Dashboard', 'module_id' => 5, 'class' => 'fa fa-angle-right',
			    'page_url' => 'hms','status_id' => Status::ACTIVE, 'position' => 1, 'created_by' => 1
		    ],
		    /* USER PAGES */
		    10 => [
			    'id' => 10,'title' => 'Add User', 'module_id' => 6, 'class' => 'fa fa-angle-right',
			    'page_url' => 'users/create','status_id' => Status::ACTIVE, 'position' => 1, 'created_by' => 1
		    ],
		    11 => [
			    'id' => 11,'title' => 'Dashboard', 'module_id' => 6, 'class' => 'fa fa-angle-right',
			    'page_url' => 'users/dashboard','status_id' => Status::ACTIVE, 'position' => 2, 'created_by' => 1
		    ],
		    12 => [
			    'id' => 12,'title' => 'User List', 'module_id' => 6, 'class' => 'fa fa-angle-right',
			    'page_url' => 'users','status_id' => Status::ACTIVE, 'position' => 3, 'created_by' => 1
		    ],
	    ];
	
	    foreach ($data as $row)
	    {
		    Page::firstOrCreate($row);
	    }
    }
}
