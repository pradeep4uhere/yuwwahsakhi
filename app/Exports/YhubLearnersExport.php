<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\YhubLearner;
use Maatwebsite\Excel\Concerns\WithHeadings;



class YhubLearnersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return YhubLearner::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'country',
            'user_id',
            'first_name',
            'last_name',
            'email_address',
            'gender',
            'role',
            'grade',
            'state',
            'district',
            'school',
            'course_name',
            'completion_status',
            'course_end_datetime',
            'completion_percent',
            'load_date',
        ];
    }
}
