<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run()   
    {
        // Generate random data for the admin user
        $name = 'Admin ' . Str::random(5); // Prefix "Admin" with a random string of 5 characters
        $email = 'admin@example.com';
        $role = 1;

        // Seed the admin user
        DB::table('users')->insert([
            [
                'name' => $name,
                'email' => $email,
                'role_as' => $role, // Set the role_as to 1 for admin
                'password' => Hash::make('password_admin'), // Set the password to "password_admin"
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
