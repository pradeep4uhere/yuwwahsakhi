<?php

namespace App\Exports;

use App\Models\YuwaahSakhi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class YuwaahSakhiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return YuwaahSakhi::select(
            'id',
            'sakhi_id',
            'name',
            'contact_number',
            'email',
            'password',
            'dob',
            'gender',
            'education_level',
            'specific_qualification',
            'loan_taken',
            'type_of_loan',
            'loan_amount',
            'loan_balance',
            'english_proficiency',
            'year_of_exp',
            'kof',
            'work_hour_in_day',
            'infrastructure_available',
            'service_offered',
            'courses_completed',
            'digital_proficiency',
            'state',
            'city',
            'address',
            'district',
            'status',
            'block_id',
            'pincode',
            'partner_id',
            'partner_center_id',
            'center_picture',
            'profile_picture',
            'remember_token',
            'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Sakhi ID',
            'Name',
            'Contact Number',
            'Email',
            'Password',
            'Date Of Birth',
            'Gender',
            'Education Level',
            'Specific Qualification',
            'Loan Taken',
            'Type of loan',
            'Loan Amount',
            'Loan Balance',
            'English Proficiency',
            'Year of exp',
            'kof',
            'Work hour in day',
            'Infrastructure Available',
            'Service Offered',
            'Courses Completed',
            'Digital Proficiency',
            'State',
            'Sity',
            'Address',
            'District',
            'Status',
            'Block',
            'Pincode',
            'Partner ID',
            'Partner Center',
            'Center Picture',
            'Profile Picture',
            'Remember Token',
            'Created At'
        ];
    }
}
