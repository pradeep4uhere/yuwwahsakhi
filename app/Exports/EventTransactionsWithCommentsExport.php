<?php

namespace App\Exports;
use DB;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class EventTransactionsWithCommentsExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $partnerId = auth()->guard('partner')->user()->id;

        $eventList = DB::table('event_transactions as et')
            ->join('yuwaah_sakhi as ys', 'et.ys_id', '=', 'ys.id')
            ->join('yuwaah_event_masters as em', 'em.id', '=', 'et.event_category')
            ->where('ys.partner_id', $partnerId)
            ->select(
                'et.id',
                'et.beneficiary_name',
                'et.beneficiary_phone_number',
                'et.event_name',
                'em.event_category as event_category',
                'ys.sakhi_id',
                'et.event_value', // example fields
                'et.review_status',
                'et.created_at',
                'et.event_date_submitted',
                
            )
            ->get();

        $sheets = [];

        // First sheet: all events
        $sheets[] = new EventTransactionsSheet($eventList);

        // Next sheets: comments for each event
        foreach ($eventList as $event) {
           // Fetch from the other database connection
            $comments = DB::connection('mysql2')
            ->table('event_transaction_comments')
            ->where('event_transaction_id', $event->id)
            ->select('comment', 'comment_type','user_name', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

            $sheets[] = new EventCommentsSheet($event->event_name ?? 'Event-'.$event->id, $comments);
        }

        return $sheets;
    }
}
