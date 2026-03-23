<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PartnerEventExport implements FromCollection, WithHeadings, WithMapping
{
    protected $partnerId;
    protected $eventList;

    public function __construct($partnerId)
    {
        $this->partnerId = $partnerId;
    }

    public function collection()
    {
        $eventList = DB::table('event_transactions as et')
            ->leftJoin('yuwaah_sakhi as ys', 'et.ys_id', '=', 'ys.id')
            ->leftJoin('learners as l', 'et.learner_id', '=', 'l.id')
            ->leftJoin('learner_courses as lc', 'lc.phone_number', '=', 'et.beneficiary_phone_number')
            ->leftJoin('yuwaah_event_masters as em', 'em.id', '=', 'et.event_category')
            ->where('ys.partner_id', $this->partnerId)
            ->where('ys.csc_id', '!=', 'Sandbox_Testing')
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
                DB::raw("CASE WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes' ELSE 'No' END as differently_abled"),
                'l.USER_MARIAL_STATUS',
                'l.RELIGION',
                'l.education_level',
                'l.digital_proficiency',
                'l.english_knowledge',
                DB::raw("CASE WHEN l.interested_in_opportunities = 1 THEN 'Yes' ELSE 'No' END as interested_in_opportunities"),
                'et.event_date_submitted',
                'et.event_value',
                'l.current_job_title',
                'l.PROGRAM_STATE',
                'l.PROGRAM_DISTRICT',
                DB::raw("
                    CASE
                        WHEN l.date_of_birth IS NULL THEN ''
                        WHEN TIMESTAMPDIFF(YEAR, l.date_of_birth, CURDATE()) < 18 THEN 'Less than 18 years'
                        WHEN TIMESTAMPDIFF(YEAR, l.date_of_birth, CURDATE()) BETWEEN 18 AND 20 THEN '18-20 years'
                        WHEN TIMESTAMPDIFF(YEAR, l.date_of_birth, CURDATE()) BETWEEN 21 AND 25 THEN '21-25 years'
                        WHEN TIMESTAMPDIFF(YEAR, l.date_of_birth, CURDATE()) > 25 THEN 'Above 25 years'
                        ELSE ''
                    END as age_group
                ")
            )
            ->get();

        $eventIds = $eventList->pluck('id')->toArray();

        $comments = DB::connection('mysql2')
            ->table('event_transaction_comments as etc1')
            ->join(
                DB::raw('(
                    SELECT event_transaction_id, MAX(id) as max_id
                    FROM event_transaction_comments
                    GROUP BY event_transaction_id
                ) as etc2'),
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

        $this->eventList = $eventList->map(function ($event) use ($comments) {
            $comment = $comments[$event->id] ?? null;

            $event->latest_comment = $comment->comment ?? '';
            $event->comment_date = $comment->created_at ?? '';

            return $event;
        });

        return $this->eventList;
    }

    public function map($event): array
    {
        return [
            $event->id,
            $event->csc_id,
            $event->sakhi_id,
            $event->event_name,
            $event->event_category,
            $event->beneficiary_name,
            $event->beneficiary_phone_number,
            $event->review_status,
            $event->field_type,
            $event->industry_type,
            $event->course_name,
            $event->differently_abled,
            $event->USER_MARIAL_STATUS,
            $event->RELIGION,
            $event->education_level,
            $event->digital_proficiency,
            $event->english_knowledge,
            $event->interested_in_opportunities,
            $event->event_date_submitted,
            $event->event_value,
            $event->current_job_title,
            $event->latest_comment,
            $event->comment_date,
            $event->PROGRAM_STATE,
            $event->PROGRAM_DISTRICT,
            $event->age_group,
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
            'State',
            'District',
            'Age Group',
        ];
    }
}
