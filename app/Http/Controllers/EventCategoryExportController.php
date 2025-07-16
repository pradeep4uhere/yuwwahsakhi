<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Response;

class EventCategoryExportController extends Controller
{
    public function export()
    {
        // Fetch all rows from the table
        $events = DB::table('yuwaahsakhi.yuwaah_event_masters as em')
        ->leftJoin('yuwaahsakhi.yuwaah_event_type as et', 'em.event_type_id', '=', 'et.id')
        ->select(
            'em.id',
            'em.event_type_id',
            'et.name as event_type', // <-- joined column
            'em.event_category',
            'em.description',
            'em.eligibility',
            'em.fee_per_completed_transaction',
            'em.date_event_created_in_master',
            'em.document_1',
            'em.document_2',
            'em.document_3',
            'em.status',
            'em.created_at',
            'em.updated_at'
        )
        ->get();

        // Define desired column headers for CSV
        $csvHeaders = [
            'id',
            'event_type_id',
            'event_type', // <-- now included
            'event_category',
            'description',
            'eligibility',
            'fee_per_completed_transaction',
            'date_event_created_in_master',
            'document_1',
            'document_2',
            'document_3',
            'status',
            'created_at',
            'updated_at',
        ];

        // Stream the CSV response
        $callback = function () use ($events, $csvHeaders) {
            $file = fopen('php://output', 'w');

            // Output CSV headers
            fputcsv($file, $csvHeaders);

            // Output each row
            foreach ($events as $event) {
                fputcsv($file, [
                    $event->id,
                    $event->event_type_id,
                    $event->event_type,
                    $event->event_category,
                    $event->description,
                    $event->eligibility,
                    $event->fee_per_completed_transaction,
                    $event->date_event_created_in_master,
                    $event->document_1,
                    $event->document_2,
                    $event->document_3,
                    $event->status,
                    $event->created_at,
                    $event->updated_at,
                ]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=event_category_export.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ]);
    }
}
