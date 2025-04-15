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
        $this->call(AdminSeeder::class);
        $this->call(LearnerSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(BlockSeeder::class);
        $this->call(YuwaahSakhiSettingsSeeder::class);
    }
}
