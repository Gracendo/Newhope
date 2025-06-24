<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DonationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('donation_categories')->insert([
            [
                'title' => 'Éducation',
                'description' => 'Soutien à la scolarité, fournitures et infrastructures éducatives.',
                'image' => 'images/categories/education.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Santé',
                'description' => 'Accès aux soins, équipements médicaux et campagnes de santé.',
                'image' => 'images/categories/health.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Nutrition',
                'description' => 'Programmes alimentaires pour enfants et orphelinats.',
                'image' => 'images/categories/food.jpg',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Abri',
                'description' => 'Construction et réhabilitation de logements pour enfants vulnérables.',
                'image' => 'images/categories/shelter.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
