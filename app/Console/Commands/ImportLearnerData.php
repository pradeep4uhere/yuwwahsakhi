<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Learner;
use Carbon\Carbon;

class ImportLearnerData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-learner-data';
   

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import learner data from API';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiUrl = 'https://abc.server.com/api/get-user-data?limit=1000'; // Replace with actual
        try {
            $response = Http::get($apiUrl);

            if ($response->successful()) {
                $learners = $response->json();

                foreach ($learners as $row) {
                    Learner::updateOrCreate(
                        ['primary_phone_number' => $row['user_phone_number']],
                        [
                            'account_login_id' => null,
                            'first_name' => $row['first_name'],
                            'last_name' => $row['last_name'] ?? $row['first_name'],
                            'date_of_birth' => $this->parseDate($row['dob']),
                            'gender' => $row['gender'],
                            'experiance' => $row['user_job_experience'],
                            'current_job_title' => $row['specific_skill'],
                            'current_company_name' => null,
                            'email' => $row['user_email'],
                            'primary_email' => $row['user_email'],
                            'primary_phone_number' => $row['user_phone_number'],
                            'secondary_phone_number' => null,
                            'preferred_job_domain1' => $row['preferred_job_domain1'] ?? null,
                            'preferred_job_domain2' => $row['preferred_job_domain2'] ?? null,
                            'preferred_job_domain3' => $row['preferred_job_domain3'] ?? null,
                            'preferred_job_domain4' => $row['preferred_job_domain4'] ?? null,
                            'preferred_mode_of_work' => $row['preferred_mode_of_work'] ?? null,
                            'highest_education_qualification' => $row['education_level'],
                            'preferred_work_location1' => $row['program_district'] ?? null,
                            'preferred_work_location2' => $row['program_state'] ?? null,
                            'preferred_work_location3' => $row['district_city'] ?? null,
                            'create_date' => $this->parseDate($row['user_profile_created_date']),
                            'update_date' => Carbon::now(),
                            'yuwaah_resume_create_date' => $this->parseDate($row['user_profile_created_date']),
                            'yuwaah_resume_update_date' => Carbon::now(),
                            'last_month_salary' => $row['monthly_family_income_range'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]
                    );
                }

                $this->info('Learner data imported successfully.');
            } else {
                $this->error('API request failed: ' . $response->status());
            }
        } catch (\Exception $e) {
            $this->error('Exception: ' . $e->getMessage());
        }

    }



    private function parseDate($date)
    {
        if (!$date) return null;
        try {
            return Carbon::parse($date)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }


    
}
