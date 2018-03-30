<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;
use App\Models\Roles\Role;

class UserRolesSeeder extends Seeder
{

    public function run()
    {
        //get roles
        $roles = Role::all();
        $users = User::all();
        foreach ($roles as $role) {
            foreach ($users as $user) {
                if($user->id == $role->id) {
                    $user->attachRole($role);
                }
            }
        }
    }
}
