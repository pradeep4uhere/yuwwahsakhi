<?php

namespace App\Exports;

use DB;
use Auth;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlacementPartnerLearnersEventExport implements FromQuery, WithHeadings, WithMapping
{

    public function query()
    {
        $partnerId  = getUserId();

        return DB::table('event_transactions as et')
            ->leftJoin('yuwaah_sakhi as ys', 'et.ys_id', '=', 'ys.id')
            ->leftJoin('yuwaah_event_masters as em', 'em.id', '=', 'et.event_category')

            ->where('ys.partner_placement_user_id', $partnerId)
            ->where('ys.csc_id','!=','Sandbox_Testing')
            ->whereNotNull('et.review_status')
            ->whereNotNull('et.learner_id')
            ->whereNotNull('et.event_date_submitted')

            ->select(
                'ys.sakhi_id',
                'ys.csc_id',
                'et.event_name',
                'em.event_category',
                'et.beneficiary_name',
                'et.beneficiary_phone_number',
                'et.review_status',
                'et.event_date_submitted',
                
                'et.updated_at'
            )
            ->orderBy('et.id','asc');
    }

    public function map($row): array
    {
        // $docs = '';

        // if(!empty($row->document)){
        //     $documents = json_decode($row->document,true);

        //     if(is_array($documents)){
        //         $docs = implode(', ', $documents);
        //     }else{
        //         $docs = $row->document;
        //     }
        // }

        return [
            $row->sakhi_id,
            $row->csc_id,
            $row->event_name,
            $row->event_category,
            $row->beneficiary_name,
            $row->beneficiary_phone_number,
            $row->review_status,
            $row->event_date_submitted,
           
            $row->updated_at
        ];
    }

    public function headings(): array
    {
        return [
            'Sakhi ID',
            'CSC ID',
            'Event Name',
            'Event Category',
            'Beneficiary Name',
            'Beneficiary Phone',
            'Review Status',
            'Event Date Submitted',
            'Documents',
            'Updated At'
        ];
    }

}