<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use App\Models\District;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            // Andhra Pradesh
            ['state_id' => 1, 'name' => 'Visakhapatnam'],
            ['state_id' => 1, 'name' => 'Vijayawada'],
            ['state_id' => 1, 'name' => 'Guntur'],
            ['state_id' => 1, 'name' => 'Kurnool'],

            // Arunachal Pradesh
            ['state_id' => 2, 'name' => 'Itanagar'],
            ['state_id' => 2, 'name' => 'Tawang'],
            ['state_id' => 2, 'name' => 'Ziro'],
            ['state_id' => 2, 'name' => 'Bomdila'],

            // Assam
            ['state_id' => 3, 'name' => 'Guwahati'],
            ['state_id' => 3, 'name' => 'Silchar'],
            ['state_id' => 3, 'name' => 'Dibrugarh'],
            ['state_id' => 3, 'name' => 'Jorhat'],

            // Bihar
            ['state_id' => 4, 'name' => 'Patna'],
            ['state_id' => 4, 'name' => 'Gaya'],
            ['state_id' => 4, 'name' => 'Muzaffarpur'],
            ['state_id' => 4, 'name' => 'Bhagalpur'],

            // Chhattisgarh
            ['state_id' => 5, 'name' => 'Raipur'],
            ['state_id' => 5, 'name' => 'Bilaspur'],
            ['state_id' => 5, 'name' => 'Durg'],
            ['state_id' => 5, 'name' => 'Korba'],

            // Goa
            ['state_id' => 6, 'name' => 'North Goa'],
            ['state_id' => 6, 'name' => 'South Goa'],

            // Gujarat
            ['state_id' => 7, 'name' => 'Ahmedabad'],
            ['state_id' => 7, 'name' => 'Surat'],
            ['state_id' => 7, 'name' => 'Rajkot'],
            ['state_id' => 7, 'name' => 'Vadodara'],

            // Haryana
            ['state_id' => 8, 'name' => 'Gurgaon'],
            ['state_id' => 8, 'name' => 'Faridabad'],
            ['state_id' => 8, 'name' => 'Panipat'],
            ['state_id' => 8, 'name' => 'Hisar'],

            // Himachal Pradesh
            ['state_id' => 9, 'name' => 'Shimla'],
            ['state_id' => 9, 'name' => 'Solan'],
            ['state_id' => 9, 'name' => 'Mandi'],
            ['state_id' => 9, 'name' => 'Kullu'],

            // Jharkhand
            ['state_id' => 10, 'name' => 'Ranchi'],
            ['state_id' => 10, 'name' => 'Jamshedpur'],
            ['state_id' => 10, 'name' => 'Dhanbad'],
            ['state_id' => 10, 'name' => 'Bokaro'],

            // Karnataka
            ['state_id' => 11, 'name' => 'Bangalore'],
            ['state_id' => 11, 'name' => 'Mysore'],
            ['state_id' => 11, 'name' => 'Mangalore'],
            ['state_id' => 11, 'name' => 'Hubli'],

            // Kerala
            ['state_id' => 12, 'name' => 'Thiruvananthapuram'],
            ['state_id' => 12, 'name' => 'Kochi'],
            ['state_id' => 12, 'name' => 'Kozhikode'],
            ['state_id' => 12, 'name' => 'Kannur'],

            // Madhya Pradesh
            ['state_id' => 13, 'name' => 'Bhopal'],
            ['state_id' => 13, 'name' => 'Indore'],
            ['state_id' => 13, 'name' => 'Gwalior'],
            ['state_id' => 13, 'name' => 'Jabalpur'],

            // Maharashtra
            ['state_id' => 14, 'name' => 'Mumbai'],
            ['state_id' => 14, 'name' => 'Pune'],
            ['state_id' => 14, 'name' => 'Nagpur'],
            ['state_id' => 14, 'name' => 'Nashik'],

            // Manipur
            ['state_id' => 15, 'name' => 'Imphal East'],
            ['state_id' => 15, 'name' => 'Imphal West'],
            ['state_id' => 15, 'name' => 'Bishnupur'],
            ['state_id' => 15, 'name' => 'Thoubal'],

            // Meghalaya
            ['state_id' => 16, 'name' => 'East Khasi Hills'],
            ['state_id' => 16, 'name' => 'West Garo Hills'],
            ['state_id' => 16, 'name' => 'Ri Bhoi'],
            ['state_id' => 16, 'name' => 'South West Khasi Hills'],

            // Mizoram
            ['state_id' => 17, 'name' => 'Aizawl'],
            ['state_id' => 17, 'name' => 'Lunglei'],
            ['state_id' => 17, 'name' => 'Champhai'],
            ['state_id' => 17, 'name' => 'Serchhip'],

            // Nagaland
            ['state_id' => 18, 'name' => 'Kohima'],
            ['state_id' => 18, 'name' => 'Dimapur'],
            ['state_id' => 18, 'name' => 'Mokokchung'],
            ['state_id' => 18, 'name' => 'Tuensang'],

            // Odisha
            ['state_id' => 19, 'name' => 'Bhubaneswar'],
            ['state_id' => 19, 'name' => 'Cuttack'],
            ['state_id' => 19, 'name' => 'Rourkela'],
            ['state_id' => 19, 'name' => 'Sambalpur'],

            // Punjab
            ['state_id' => 20, 'name' => 'Ludhiana'],
            ['state_id' => 20, 'name' => 'Amritsar'],
            ['state_id' => 20, 'name' => 'Jalandhar'],
            ['state_id' => 20, 'name' => 'Patiala'],

            // Rajasthan
            ['state_id' => 21, 'name' => 'Jaipur'],
            ['state_id' => 21, 'name' => 'Jodhpur'],
            ['state_id' => 21, 'name' => 'Udaipur'],
            ['state_id' => 21, 'name' => 'Kota'],

            // Sikkim
            ['state_id' => 22, 'name' => 'Gangtok'],
            ['state_id' => 22, 'name' => 'Gyalshing'],
            ['state_id' => 22, 'name' => 'Namchi'],
            ['state_id' => 22, 'name' => 'Mangan'],

            // Tamil Nadu
            ['state_id' => 23, 'name' => 'Chennai'],
            ['state_id' => 23, 'name' => 'Coimbatore'],
            ['state_id' => 23, 'name' => 'Madurai'],
            ['state_id' => 23, 'name' => 'Tiruchirappalli'],

            // Telangana
            ['state_id' => 24, 'name' => 'Hyderabad'],
            ['state_id' => 24, 'name' => 'Warangal'],
            ['state_id' => 24, 'name' => 'Nizamabad'],
            ['state_id' => 24, 'name' => 'Karimnagar'],

            // Tripura
            ['state_id' => 25, 'name' => 'Agartala'],
            ['state_id' => 25, 'name' => 'Udaipur'],
            ['state_id' => 25, 'name' => 'Kailashahar'],
            ['state_id' => 25, 'name' => 'Dharmanagar'],

            // Uttar Pradesh
            ['state_id' => 26, 'name' => 'Lucknow'],
            ['state_id' => 26, 'name' => 'Kanpur'],
            ['state_id' => 26, 'name' => 'Varanasi'],
            ['state_id' => 26, 'name' => 'Agra'],

            // Uttarakhand
            ['state_id' => 27, 'name' => 'Dehradun'],
            ['state_id' => 27, 'name' => 'Haridwar'],
            ['state_id' => 27, 'name' => 'Nainital'],
            ['state_id' => 27, 'name' => 'Almora'],

            // West Bengal
            ['state_id' => 28, 'name' => 'Kolkata'],
            ['state_id' => 28, 'name' => 'Darjeeling'],
            ['state_id' => 28, 'name' => 'Asansol'],
            ['state_id' => 28, 'name' => 'Siliguri'],
        ];

        DB::table('districts')->insert($districts);
        $this->command->info('✅ One district added for each State.');
    }
}
