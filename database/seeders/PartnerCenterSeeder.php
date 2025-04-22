<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PartnerCenter;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PartnerCenterSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $bulkInsert = [];

        for ($i = 0; $i < 50000; $i++) {
            $createdAt = Carbon::now()->subMonths(rand(0, 11))->startOfMonth()->addDays(rand(0, 27));

            $bulkInsert[] = [
                'partner_id' => rand(1, 100), // adjust if you have a partners table
                'state_id' => rand(1, 36),    // adjust to match your states count
                'district_id' => rand(1, 100),
                'block_id' => rand(1, 500),
                'email' => $faker->email,
                'center_name' => $faker->company,
                'address' => $faker->address,
                'status' => $faker->randomElement(['1', '0']),
                'created_at' => $createdAt,
                'onboard_date'=> $createdAt,
                'updated_at' => $createdAt,
            ];

            // Insert in chunks to avoid memory issues
            if (count($bulkInsert) === 1000) {
                PartnerCenter::insert($bulkInsert);
                $bulkInsert = [];
            }
        }

        // Insert remaining
        if (!empty($bulkInsert)) {
            PartnerCenter::insert($bulkInsert);
        }

        echo "✅ Seeded 50,000 PartnerCenter records.\n";
    }
}

