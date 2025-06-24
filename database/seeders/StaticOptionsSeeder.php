<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StaticOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('static_options')->insert([
            [
                'option_name' => 'site_title',
                'option_value' => 'New Hope Platform',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_tag_line',
                'option_value' => 'Orphanage Support Platform',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_favicon',
                'option_value' => '125',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'disable_user_email_verify',
                'option_value' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'option_name' => 'site_maintenance_mode',
                'option_value' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
