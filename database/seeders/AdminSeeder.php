<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()   
    {
        $users = [
            [
                'name' => 'Admin IronHulk',
                'email' => 'test@example.com',
                'role_as' => 1,
                'password' => Hash::make('password_admin'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),

            ],

        ];

        DB::table('users')->insert($users);
    }
}
