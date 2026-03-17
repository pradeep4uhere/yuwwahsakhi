<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class PartnerEventExport implements FromCollection, WithHeadings
{
    protected $partnerId;

    public function __construct($partnerId)
    {
        $this->partnerId = $partnerId;
    }

    public function collection()
    {
        //dd($this->partnerId);
        //Partner::where
        $eventList = DB::table('event_transactions as et')
        ->leftJoin('yuwaah_sakhi as ys', 'et.ys_id', '=', 'ys.id')
        ->leftJoin('learners as l', 'et.learner_id', '=', 'l.id')
        ->leftJoin('learner_courses as lc', 'lc.phone_number', '=', 'et.beneficiary_phone_number')
        ->leftJoin('yuwaah_event_masters as em', 'em.id', '=', 'et.event_category')
        ->where('ys.partner_id', $this->partnerId)
        ->where('ys.csc_id','!=','Sandbox_Testing')
        ->whereNotNull('et.review_status')
        ->whereNotNull('et.learner_id')
        ->whereNotNull('et.event_date_submitted')
        ->select(
            'et.id',
            'ys.csc_id',
            'ys.sakhi_id',
            'et.event_name',
            'em.event_category',
            'et.beneficiary_name',
            'et.beneficiary_phone_number',
            'et.review_status',
            'et.field_type',
            'et.industry_type',
            'lc.course_name',
            DB::raw("CASE WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes' ELSE 'No' END as DIFFRENTLY_ABLED"),
            'l.USER_MARIAL_STATUS',
            'l.RELIGION',
            'l.education_level',
            'l.digital_proficiency',
            'l.english_knowledge',
            DB::raw("CASE WHEN l.interested_in_opportunities = 1 THEN 'Yes' ELSE 'No' END as interested_in_opportunities"),
            'et.event_date_submitted',
            'et.event_value',
            'l.current_job_title'
            
        )
        ->get();

        $eventIds = $eventList->pluck('id')->toArray();

        $comments = DB::connection('mysql2')
        ->table('event_transaction_comments as etc1')
        ->join(
            DB::raw('(SELECT event_transaction_id, MAX(id) as max_id 
                    FROM event_transaction_comments 
                    GROUP BY event_transaction_id) as etc2'),
            'etc1.id',
            '=',
            'etc2.max_id'
        )
        ->whereIn('etc1.event_transaction_id', $eventIds)
        ->select(
            'etc1.event_transaction_id',
            'etc1.comment',
            'etc1.created_at'
        )
        ->get()
        ->keyBy('event_transaction_id'); // 🔥 important
        //dd($eventList);

        $eventList = $eventList->map(function ($event) use ($comments) {

            $comment = $comments[$event->id] ?? null;
        
            $event->latest_comment = $comment->comment ?? '';
            $event->comment_date = $comment->created_at ?? '';
        
            return $event;
        });

        //dd($eventList);
        return $eventList;
    }

    public function headings(): array
    {
        return [
            'Event ID',
            'CSC ID',
            'Sakhi ID',
            'Event Name',
            'Event Category',
            'Beneficiary Name',
            'Beneficiary Phone Number',
            'Event Status',
            'Field Type',
            'Industry Type',
            'Course Name',
            'Differently Abled',
            'Marital Status',
            'Religion',
            'Education Level',
            'Digital Proficiency',
            'English Knowledge',
            'Interested in Opportunities',
            'Event Date Submitted',
            'Montly Income',
            'Job Category',
            'Event comment',
            'Event comment Date',
            
        ];
    }
}
