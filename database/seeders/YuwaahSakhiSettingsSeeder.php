<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YuwaahSakhiSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('yuwaah_sakhi_settings')->insert([
            'home_page_title' => 'About YuWaah! Initiative',
            'description' => 'As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!',
            'home_page_banner_type' => '2',
            'youtube_url' => 'https://www.youtube.com/watch?v=_Z4eFWhoRpQ',
            'banners' => null, // Set to JSON or path if required
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->command->info('✅ Yuwaah Sakhi Setting added.');
    }
}
