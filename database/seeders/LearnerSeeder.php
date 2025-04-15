<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Learner;

class LearnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 20) as $index) {
            Learner::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'status' => 'Active',
                'date_of_birth' => $faker->date('Y-m-d', '2004-01-01'),
                'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
                'email' => $faker->unique()->safeEmail(),
                'institution' => $faker->numberBetween(10000, 99999),
                'education_level' => $faker->randomElement(['General Degree', 'High School', 'Postgraduate']),
                'digital_proficiency' => 'Excel Knowledge',
                'english_knowledge' => 'Can read and write',
                'interested_in_opportunities' => true,
                'opportunity_types' => [
                    'Get a job',
                    'Earn at my own time',
                    'Run a business'
                ],

                // Get a Job section
                'job_mobility' => 'Nearby City',
                'job_kind' => 'Customer Service',
                'job_qualifications' => ['Excel', 'CRM System', 'Low-code No code'],
                'job_timing' => 'Immediately',
                'experience_years' => $faker->numberBetween(0, 10) . ' years',

                // Earn at My Own Time
                'work_hours_per_day' => $faker->numberBetween(1, 8),
                'work_kind' => 'Computer based, phone based',
                'earn_qualifications' => ['Excel', 'CRM System', 'Low-code No code'],

                // Run a Business
                'business_status' => 'Have an idea',
                'business_description' => $faker->optional()->sentence(),
            ]);
        }

        $this->command->info('✅ Dummy Leaner Data imported.');
    }
}
