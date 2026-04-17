<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlacementPartnerLearnersEventExport implements FromCollection, WithHeadings, WithMapping
{
    protected $partnerId;

    public function __construct()
    {
        $this->partnerId = getUserId();
    }

    public function collection()
    {
        // 👉 Main Data
        $eventList = DB::table('event_transactions as et')
            ->leftJoin('yuwaah_sakhi as ys', 'et.ys_id', '=', 'ys.id')
            ->leftJoin('learners as l', 'et.learner_id', '=', 'l.id')
            ->leftJoin('learner_courses as lc', 'lc.phone_number', '=', 'et.beneficiary_phone_number')
            ->leftJoin('yuwaah_event_masters as em', 'em.id', '=', 'et.event_category')
            ->where('ys.partner_placement_user_id', $this->partnerId)
            ->where('ys.csc_id', '!=', 'Sandbox_Testing')
            ->whereNotNull('et.review_status')
            ->whereNotNull('et.learner_id')
            ->whereNotNull('et.event_date_submitted')
            ->select(
                'et.id',
                'ys.csc_id',
                'ys.sakhi_id',
                'et.event_name',
                'et.event_category',
                'et.beneficiary_name',
                'et.beneficiary_phone_number',
                'et.review_status',
                'et.field_type',
                'et.industry_type',
                'lc.course_name',
                DB::raw("CASE WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes' ELSE 'No' END as differently_abled"),
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

        // 👉 Get IDs
        $eventIds = $eventList->pluck('id')->toArray();

        // 👉 Latest Comments
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
            ->keyBy('event_transaction_id');

        // 👉 Merge comments into main data
        return $eventList->map(function ($event) use ($comments) {

            $comment = $comments[$event->id] ?? null;

            $event->latest_comment = $comment->comment ?? '';
            $event->comment_date   = $comment->created_at ?? '';

            return $event;
        });
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->csc_id,
            $row->sakhi_id,
            $row->event_name,
            $row->event_category,
            $row->beneficiary_name,
            $row->beneficiary_phone_number,
            $row->review_status,
            $row->field_type,
            $row->industry_type,
            $row->course_name,
            $row->differently_abled,
            $row->USER_MARIAL_STATUS,
            $row->RELIGION,
            $row->education_level,
            $row->digital_proficiency,
            $row->english_knowledge,
            $row->interested_in_opportunities,
            $row->event_date_submitted,
            $row->event_value,
            $row->current_job_title,
            $row->latest_comment,
            $row->comment_date
        ];
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
            'Monthly Income',
            'Job Category',
            'Event Comment',
            'Event Comment Date',
        ];
    }
}