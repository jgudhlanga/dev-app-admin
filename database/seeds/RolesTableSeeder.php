<?php

use Illuminate\Database\Seeder;
use App\Models\Roles\Role;
use App\Models\General\Status;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        //Empty the table
        DB::table('roles')->delete();
        // Reset Auto Increment
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 0');
        $data = [
            1 => ['id' => 1, 'name' => 'senior-developer','display_name' => 'Senior Developer',
                'description' => 'Full Access to the System Modules', 'status_id' => Status::ACTIVE,'created_by' => 1],
            2 => ['id' => 2, 'name' => 'junior-developer','display_name' => 'Junior Developer',
                'description' => 'Limited Access to the System Modules', 'status_id' => Status::ACTIVE,'created_by' => 1],
        ];

        foreach ($data as $row)
        {
            Role::firstOrCreate($row);
        }

    }
}
