<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    public function run()
    {
        // Define role data
        $roles = [
            ['name' => 'admin'],
            ['name' => 'supervisor'],
            ['name' => 'trainee'],
        ];

        // Insert the role data into the 'role_as' table
        DB::table('role_as')->insert($roles);
    }
}
