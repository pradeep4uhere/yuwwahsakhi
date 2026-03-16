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
            'em.event_category',
            'lc.course_name',
            DB::raw("CASE WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes' ELSE 'No' END as DIFFRENTLY_ABLED"),
            'l.USER_MARIAL_STATUS',
            'l.RELIGION',
            'l.education_level',
            'l.digital_proficiency',
            'l.english_knowledge',
            DB::raw("CASE WHEN l.interested_in_opportunities = 1 THEN 'Yes' ELSE 'No' END as interested_in_opportunities"),
            'et.event_date_submitted'
        )
        ->get();
        //dd($eventList);

        return $eventList;
    }

    public function headings(): array
    {
        return [
            'Event ID',
            'CSC ID',
            'Sakhi ID',
            'Event Category',
            'Course Name',
            'Differently Abled',
            'Marital Status',
            'Religion',
            'Education Level',
            'Digital Proficiency',
            'English Knowledge',
            'Interested in Opportunities',
            'Event Date Submitted'
        ];
    }
}
