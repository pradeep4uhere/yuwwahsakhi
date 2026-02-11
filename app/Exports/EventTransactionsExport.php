<?php

namespace App\Exports;

use App\Models\EventTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;


class EventTransactionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $partnerId = auth()->guard('partner')->user()->id;

        $eventList = DB::table('event_transactions as et')
            ->join('yuwaah_sakhi as ys', 'et.ys_id', '=', 'ys.id')
            ->join('yuwaah_event_masters as em', 'em.id', '=', 'et.event_category')
            ->where('ys.partner_id', $partnerId)
            ->select(
                'et.id',
                'ys.name',
                'ys.sakhi_id',
                'ys.csc_id',
                'et.beneficiary_name',
                'et.beneficiary_phone_number',
                'et.event_name',
                'em.event_category as event_category',
                'et.event_value', // example fields
                'et.review_status',
                'et.created_at',
                'et.event_date_submitted',
                
            )
            ->get();

     
        return $eventList;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Beneficiary Name',
            'Beneficiary Phone Number',
            'Event Name',
            'Event Category',
            'Field Agent ID',
            'Event Status',
            'Created At',
            'Event Submitted',
           
        ];
    }
}
