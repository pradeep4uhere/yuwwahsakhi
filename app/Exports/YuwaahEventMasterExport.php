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
             DB::raw("CASE WHEN yuwaah_event_type.status = 1 THEN 'Active' ELSE 'InActive' END as Status"),
        )
        ->get();
    }

    public function headings(): array
    {
        return [
            'Event Type',
            'Event Description',
            'Status',
        ];
    }
}
