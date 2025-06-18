<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('langs')->insert([
            [
                'name' => 'Français',
                'slug' => Str::slug('Français'),
                'direction' => 'ltr',
                'status' => 'publish',
                'default' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Anglais',
                'slug' => Str::slug('Anglais'),
                'direction' => 'ltr',
                'status' => 'active',
                'default' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arabe',
                'slug' => Str::slug('Arabe'),
                'direction' => 'rtl',
                'status' => 'inactive',
                'default' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
