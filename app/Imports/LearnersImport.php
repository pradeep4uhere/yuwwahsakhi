<?php
namespace App\Imports;
use App\Events\FileImportProgress;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Illuminate\Console\OutputStyle;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class LearnersImport implements ToModel, WithChunkReading
{
    public $totalRows = 0;
    public $processedRows = 0;

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        // If no email, skip this row
        if (empty($row['email'])) {
            return null;
        }
        $gender = $row['gender'] ?? null;

        // Check gender value and set default if necessary
        if (!in_array(strtolower($gender), ['male', 'female'])) {
            $gender = 'Other';
        } else {
            // Capitalize first letter (in case CSV has lowercase like 'male')
            $gender = ucfirst(strtolower($gender));
        }
        //dd($row);
        Learner::create([
            'account_login_id' => $row['account_login_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['first_name'],
            'date_of_birth' => $this->parseDate($row['date_of_birth']), // ✅ parse it
            'gender' => $gender,
            'experiance' => $row['experiance'],
            'current_job_title' => $row['current_job_title'],
            'current_company_name' => $row['current_company_name'],
            'email' => $row['primary_email'],
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
            'create_date' => $this->parseDate($row['create_date']),
            'update_date' => $this->parseDate($row['update_date']),
            'yuwaah_resume_create_date'=>$this->parseDate($row['create_date']),
            'yuwaah_resume_update_date'=>$this->parseDate($row['create_date']),
            'last_month_salary' => $row['last_month_salary'],
            'created_at' => $this->parseDate(date('Y-m-d h:i:s')),
            'updated_at' => $this->parseDate(date('Y-m-d h:i:s')),
            
        ]);

        // Increment processed rows
        $this->processedRows++;

        // Calculate progress percentage
        $progress = ($this->processedRows / $this->totalRows) * 100;
        // Broadcast progress
        broadcast(new FileImportProgress($progress));

       
        
        return new Learner([
            'account_login_id' => $row['account_login_id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['first_name'],
            'date_of_birth' => $this->parseDate($row['date_of_birth']), // ✅ parse it
            'gender' => $gender,
            'experiance' => $row['experiance'],
            'current_job_title' => $row['current_job_title'],
            'current_company_name' => $row['current_company_name'],
            'email' => $row['primary_email'],
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
            'create_date' => $this->parseDate($row['create_date']),
            'update_date' => $this->parseDate($row['update_date']),
            'yuwaah_resume_create_date'=>$this->parseDate($row['create_date']),
            'yuwaah_resume_update_date'=>$this->parseDate($row['create_date']),
            'last_month_salary' => $row['last_month_salary'],
            'created_at' => $this->parseDate(date('Y-m-d h:i:s')),
            'updated_at' => $this->parseDate(date('Y-m-d h:i:s')),
            
        ]);
    }


    public function chunkSize(): int
    {
        return 1000; // Only load 1000 rows at a time
    }

    private function parseDate($date)
    {
        if (empty($date) || strtolower($date) === 'null') {
            return null;
        }
        try {
            return \Carbon\Carbon::parse($date)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return null;
        }
    }


    public function onRow(Row $row)
    {
        // Track total rows
        $this->totalRows++;
    }

    // Implement getConsoleOutput method for WithProgressBar interface
    public function getConsoleOutput(): OutputStyle
    {
        // You can create a new OutputStyle instance or pass the current console output if needed.
        return app()->make(OutputStyle::class);
    }

}
