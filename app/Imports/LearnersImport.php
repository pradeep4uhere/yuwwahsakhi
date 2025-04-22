<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Learner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LearnersImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        dd($row);
        return new Learner([
            'account_login_id' => $row['account_login_id'],
            'first_name' => $row['first_name'],
            'date_of_birth' => $row['date_of_birth'],
            'gender' => $row['gender'],
            'experiance' => $row['experiance'],
            'current_job_title' => $row['current_job_title'],
            'current_company_name' => $row['current_company_name'],
            'primary_email' => $row['primary_email'],
            'primary_phone_number' => $row['primary_phone_number'],
            'secondary_phone_number' => $row['secondary_phone_number'],
            'preferred_job_domain1' => $row['preferred_job_domain1'],
            'preferred_job_domain2' => $row['preferred_job_domain2'],
            'preferred_job_domain3' => $row['preferred_job_domain3'],
            'preferred_job_domain4' => $row['preferred_job_domain4'],
            'preferred_mode_of_work' => $row['preferred_mode_of_work'],
            'highest_education_qualification' => $row['highest_education_qualification'],
            'preferred_work_location1' => $row['preferred_work_location1'],
            'preferred_work_location2' => $row['preferred_work_location2'],
            'preferred_work_location3' => $row['preferred_work_location3'],
            'create_date' => $row['create_date'],
            'update_date' => $row['update_date'],
            'last_month_salary' => $row['last_month_salary'],
        ]);
    }
}
