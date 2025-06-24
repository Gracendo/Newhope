<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'User',
            'last_name' => 'Principal',
            'username' => 'user',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // ou bcrypt('12345678')
            'status' => 'active',
        ]);
    }
}
