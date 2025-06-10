<?php

namespace App\Exports;

use App\Models\YuwaahEventMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class YuwaahEventMasterExport implements FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DB::table('yuwaah_event_masters')
        ->join('yuwaah_event_type', 'yuwaah_event_masters.event_type_id', '=', 'yuwaah_event_type.id')
        ->select(
            'yuwaah_event_type.name as Event_Type',
            'yuwaah_event_type.description as Event_Description',
            'yuwaah_event_masters.event_category',
            'yuwaah_event_masters.description',
            'yuwaah_event_masters.eligibility',
            'yuwaah_event_masters.fee_per_completed_transaction',
            'yuwaah_event_masters.date_event_created_in_master',
             DB::raw("CASE WHEN yuwaah_event_masters.status = 1 THEN 'Active' ELSE 'InActive' END as Status"),
            'yuwaah_event_masters.document_1',
            'yuwaah_event_masters.document_2',
            'yuwaah_event_masters.document_3'
        )
        ->get();
    }

    public function headings(): array
    {
        return [
            'Event Type',
            'Event Description',
            'Event Category',
            'Description',
            'Eligibility',
            'Fee per Completed Transaction',
            'Date Event Created in Master',
            'Status',
            'Document 1',
            'Document 2',
            'Document 3',
        ];
    }
}
