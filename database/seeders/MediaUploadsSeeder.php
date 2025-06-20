<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MediaUploadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('media_uploads')->insert([
            [
                'id' => '125',
                'title' => 'favicon.ico',
                'path' => 'favicon1610606498.png',
                'alt' => NULL,
                'size' => NULL,
                'dimensions' => '84 x 80 pixels',
                'user_id' => NULL, // ou NULL si pas de lien avec un utilisateur
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
