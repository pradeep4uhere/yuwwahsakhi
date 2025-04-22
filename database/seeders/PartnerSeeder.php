<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Partner;
use Carbon\Carbon;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $bulkInsert = [];

        for ($i = 0; $i < 500; $i++) {
            $createdAt = Carbon::now()->subMonths(rand(0, 11))->startOfMonth()->addDays(rand(0, 27));

            $bulkInsert[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'contact_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'district_id' => rand(1, 1),    // Random district ID between 1 and 5
                'block_id' => rand(1, 1),       // Random block ID between 1 and 5
                'state_id' => rand(1, 1),  
                'pincode' => $faker->postcode,
                'created_at' => $createdAt,
                'onboard_date'=> $createdAt,
                'updated_at' => $createdAt,
                'password'=>'$2y$12$f8fYPxSJ8Zkg2yhMyjSd3e.7e.gXVpOvZvQoJj7OFfFQdr3uqtzwi'
            ];

            if (count($bulkInsert) === 1000) {
                Partner::insert($bulkInsert);
                $bulkInsert = [];
            }
        }

        if (!empty($bulkInsert)) {
            Partner::insert($bulkInsert);
        }

        echo "✅ Seeded 50,000 Partner records.\n";
    }
}
