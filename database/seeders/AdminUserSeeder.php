<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure users table exists
        if (DB::getSchemaBuilder()->hasTable('users')) {

            // Check if admin already exists
            $adminExists = DB::table('users')
                ->where('email', 'admin@gmail.com')
                ->exists();

            if (!$adminExists) {
                DB::table('users')->insert([
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'phone' => '9999999999', // ✅ REQUIRED FIELD
                    'password' => Hash::make('admin123'),
                    'role' => 'admin',
                    'email_verified_at' => now(), // optional but recommended
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
