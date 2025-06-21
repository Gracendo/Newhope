<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Admin;
use DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des admins
        $admin1 = Admin::create([
            'first_name' => 'Emie',
            'last_name' => 'Nyangono',
            'username' => 'emie',
            'email' => 'gracendo96@gmail.com',
            'email_verified' => 1,
            'role' => 'admin',
            'image' => null,
            'password' => Hash::make('12345678'),
            'status' => 'active',
            'remember_token' => Str::random(10),
        ]);

        $admin2 = Admin::create([
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
        ]);

        // Récupérer toutes les permissions
        $permissions = Permission::all();

        // Donner toutes les permissions aux deux admins
        $admin1->givePermissionTo($permissions);
        $admin2->givePermissionTo($permissions);
    }
}
