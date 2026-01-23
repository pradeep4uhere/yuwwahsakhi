<?php

namespace App\Exports;

use App\Models\PlacementYuwaahSakhiLearner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;


class PlacementYuwaahSakhiLearnerExport implements FromCollection, WithHeadings, WithMapping
{


    protected $cscValue;



    // Receive CSC value from controller
    public function __construct($cscValue)
    {
        $this->cscValue = $cscValue;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('learners as l')
        ->leftJoin('yhub_learners as yh', function ($join) {
            $join->on(
                DB::raw('RIGHT(l.primary_phone_number, 10)'),
                '=',
                DB::raw('RIGHT(yh.email_address, 10)')
            );
        })
        ->where('l.UNIT_INSTITUTE', $this->cscValue)
        ->select(
            'l.*',
            DB::raw("
                CASE 
                    WHEN l.course_completed = 1 
                    THEN 'Completed'
                    ELSE 'Not Completed'
                END AS completion_status
            ")
        )
        ->get();
    }

    public function headings(): array
    {
        return [
            'Field Agent ID',
            'First Name',
            'Last Name',
            'Date Of Birth',
            'PROGRAM STATE',
            'PROGRAM DISTRICT',
            'Phone Number',
            'Education Level',
            'Digital Proficiency',
            'English Knowledge',
            'Completion Status',
            'DIFFRENTLY ABLED',
        ];
    }

    public function map($learner): array
    {
        return [
            $this->cscValue,
            $learner->first_name,
            $learner->last_name,
            $learner->date_of_birth,
            $learner->PROGRAM_STATE,
            $learner->PROGRAM_DISTRICT,
            $learner->primary_phone_number,
            $learner->education_level,
            $learner->digital_proficiency,
            $learner->english_knowledge,
            $learner->course_completed,
            $learner->DIFFRENTLY_ABLED,
        ];
    }
}
