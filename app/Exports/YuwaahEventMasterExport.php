<?php

namespace App\Exports;

use App\Models\YuwaahEventMaster;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class YuwaahEventMasterExport implements FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return YuwaahEventMaster::select(
            'event_type',
            'event_category',
            'description',
            'eligibility',
            'fee_per_completed_transaction',
            'date_event_created_in_master',
            'status',
            'document_1',
            'document_2',
            'document_3'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Event Type',
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
