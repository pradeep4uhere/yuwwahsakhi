<?php

namespace App\Exports;
use App\Models\YhubLearner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class YhubLearnersMatchedExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('yhub_learners')
            ->join('learners', DB::raw('RIGHT(learners.primary_phone_number, 10)'), '=', DB::raw('RIGHT(yhub_learners.email_address, 10)'))
            ->select(
                'yhub_learners.id as yhub_id',
                'learners.first_name',
                'learners.last_name',
                'learners.email as learner_email',
                'learners.primary_phone_number',
                DB::raw("CASE WHEN yhub_learners.completion_status = 1 THEN 'Yes' ELSE 'No' END as completion_status"),
                'yhub_learners.created_at'
            )
            ->get();
    }


    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Completion Status',
            'Created At',
            // Add more fields if needed
        ];
    }
}
