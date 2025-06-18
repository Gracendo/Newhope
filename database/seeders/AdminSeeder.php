<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'first_name' => 'Emie',
                'last_name' => 'Nyangono',
                'username' => 'emie',
                'email' => 'graycendo96@gmail.com',
                'email_verified' => 1,
                'role' => 'admin',
                'image' => null,
                'password' => Hash::make('12345678'),
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Cyrille',
                'last_name' => 'MBIA',
                'username' => 'lefmyh',
                'email' => 'cyrille@itdreamtech.com',
                'email_verified' => 1,
                'role' => 'admin',
                'image' => null,
                'password' => Hash::make('12345678'),
                'status' => 'active',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
