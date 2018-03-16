<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;
use App\Models\General\Status;
use App\Models\General\Gender;
use App\Models\General\Title;

class UsersSeeder extends Seeder
{
    
    public function run()
    {
	    //Empty the table
		DB::table('users')->delete();
		// Reset Auto Increment
		DB::statement('ALTER TABLE users AUTO_INCREMENT = 0');
		$data = [
			1 => ['id' => 1, 'first_name' => 'Chief','last_name' => 'Developer','display_name' => 'Chief Developer', 'mobile' => '0614367071',
				'email' => 'jimmyneds@gmail.com', 'profile_picture' => 'jgudhlanga.jpg',
				'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
				'remember_token' => str_random(10),'title_id' => Title::MR, 'gender_id' => Gender::MALE,
				'status_id' => Status::ACTIVE
			],
			2 => ['id' => 2, 'first_name' => 'James','last_name' => 'Gudhlanga', 'display_name' => 'Jimmy', 'mobile' => '0788104809',
				'email' => 'jamesgudhlanga@gmail.com', 'profile_picture' => 'jamesgudhlanga.jpg',
				'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
				'remember_token' => str_random(10),'title_id' => Title::MR, 'gender_id' => Gender::MALE,
				'status_id' => Status::ACTIVE
			],
		];
		
		foreach ($data as $row)
		{
			User::firstOrCreate($row);
		}
    }
}
