<?php

namespace App\Exports;
use App\Models\Learner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LearnersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Learner::select('id',
            'first_name',
            'last_name',
            'status',
            'date_of_birth',
            'gender',
            'primary_phone_number',
            'email',
            'institution',
            'education_level',
            'digital_proficiency',
            'english_knowledge',
            'interested_in_opportunities',
            'opportunity_types',
            'job_mobility',
            'job_kind',
            'job_qualifications',
            'job_timing',
            'experience_years',
            'work_hours_per_day',
            'work_kind',
            'earn_qualifications',
            'business_status',
            'business_description',
            'MONTHLY_FAMILY_INCOME_RANGE',
            'USER_EMAIL',
            'DISTRICT_CITY',
            'STATE',
            'PIN_CODE',
            'PROGRAM_CODE',
            'PROGRAM_STATE',
            'PROGRAM_DISTRICT',
            'UNIT_INSTITUTE',
            'SOCIAL_CATEGORY',
            'RELIGION',
            'USER_MARIAL_STATUS',
            'DIFFRENTLY_ABLED',
            'IDENTITY_DOCUMENTS',
            'REASON_FOR_LEARNING_NEW_SKILLS',
            'EARN_AT_MY_OWN_TIME',
            'RELOCATE_FOR_JOB',
            'WHEN_CAN_USER_START',
            'USER_NEED_HELP_WITH'
        )->get();
    }


    public function headings(): array
    {
        return ['id',
            'first_name',
            'last_name',
            'status',
            'date_of_birth',
            'gender',
            'primary_phone_number',
            'email',
            'institution',
            'education_level',
            'digital_proficiency',
            'english_knowledge',
            'interested_in_opportunities',
            'opportunity_types',
            'job_mobility',
            'job_kind',
            'job_qualifications',
            'job_timing',
            'experience_years',
            'work_hours_per_day',
            'work_kind',
            'earn_qualifications',
            'business_status',
            'business_description',
            'MONTHLY_FAMILY_INCOME_RANGE',
            'USER_EMAIL',
            'DISTRICT_CITY',
            'STATE',
            'PIN_CODE',
            'PROGRAM_CODE',
            'PROGRAM_STATE',
            'PROGRAM_DISTRICT',
            'UNIT_INSTITUTE',
            'SOCIAL_CATEGORY',
            'RELIGION',
            'USER_MARIAL_STATUS',
            'DIFFRENTLY_ABLED',
            'IDENTITY_DOCUMENTS',
            'REASON_FOR_LEARNING_NEW_SKILLS',
            'EARN_AT_MY_OWN_TIME',
            'RELOCATE_FOR_JOB',
            'WHEN_CAN_USER_START',
            'USER_NEED_HELP_WITH'
        ];
    }

}
