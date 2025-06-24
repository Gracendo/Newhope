<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LangSeeder::class,
            StaticOptionsSeeder::class,
            MediaUploadsSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            OrphanageSeeder::class,
            DonationCategorySeeder::class,
        ]);
    }
}
