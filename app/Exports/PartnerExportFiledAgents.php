<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\YuwaahSakhi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use DB;


class PartnerExportFiledAgents implements FromQuery, WithHeadings, WithMapping
{
    public function __construct($request)
    {
        $this->request = $request;
    }


    public function query()
    {
        $query = YuwaahSakhi::where('partner_id', getUserId())
        ->withCount([
            // Total event transactions
            'eventTransactions',

            // Pending event transactions count
              'eventTransactions as job_transactions_count' => function ($q) {
                $q->whereIn('event_type', [1,5]);
            },

            // Open event transactions count
            'eventTransactions as open_transactions_count' => function ($q) {
                $q->where('review_status', 'Open');
            },

            // Pending event transactions count
            'eventTransactions as pending_transactions_count' => function ($q) {
                $q->where('review_status', 'Pending');
            },

            // Pending event transactions count
            'eventTransactions as accepted_transactions_count' => function ($q) {
                $q->where('review_status', 'Accepted');
            },

            // Pending event transactions count
            'eventTransactions as rejected_transactions_count' => function ($q) {
                $q->where('review_status', 'Rejected');
            },

             // All Job Event Transactions Count
             'eventTransactions as job_transactions_count' => function ($q) {
                $q->whereIn('event_type', [1,5]);
            },

           // Submitted Job Event Transactions Count
            'eventTransactions as open_job_event_transactions_count' => function ($q) {
                $q->where('review_status', 'Open')
                ->whereIn('event_type', [1, 5]);
            },

            // Pending Job Event Transactions Count
            'eventTransactions as pending_job_event_transactions_count' => function ($q) {
                $q->where('review_status', 'Pending')
                ->whereIn('event_type', [1, 5]);
            },

            // Accepted Job Event Transactions Count
            'eventTransactions as accepted_job_event_transactions_count' => function ($q) {
                $q->where('review_status', 'Accepted')
                ->whereIn('event_type', [1, 5]);
            },

            // Rejected Job  Event Transactions Count
            'eventTransactions as rejected_job_event_transactions_count' => function ($q) {
                $q->where('review_status', 'Rejected')
                ->whereIn('event_type', [1, 5]);
            },

          

            // All SocialProtecion Event Transactions Count
            'eventTransactions as socialprotection_transactions_count' => function ($q) {
                $q->whereIn('event_type', [3]);
            },
            // All Submitted SocialProtecion Event Transactions Count
            'eventTransactions as open_social_protection_event_transactions_count' => function ($q) {
                $q->where('review_status', 'Open')
                ->whereIn('event_type', [3]);
            },

            // Pending Job Event Transactions Count
            'eventTransactions as pending_social_protection_transactions_count' => function ($q) {
                $q->where('review_status', 'Pending')
                ->whereIn('event_type', [3]);
            },

            // Accepted Job Event Transactions Count
            'eventTransactions as accepted_social_protection_transactions_count' => function ($q) {
                $q->where('review_status', 'Accepted')
                ->whereIn('event_type', [3]);
            },

            // Rejected Job  Event Transactions Count
            'eventTransactions as rejected_social_protection_transactions_count' => function ($q) {
                $q->where('review_status', 'Rejected')
                ->whereIn('event_type', [3]);
            },

          

            // Learners count
            'learners as learner_count' => function ($q) {
                $q->whereColumn('learners.UNIT_INSTITUTE', 'yuwaah_sakhi.csc_id');
            },

            // Completed learners count
            'learners as completed_learners_count' => function ($q) {
                $q->join('yhub_learners as yl', 'learners.normalized_mobile', '=', 'yl.normalized_mobile')
                ->whereColumn('learners.UNIT_INSTITUTE', 'yuwaah_sakhi.csc_id')
                ->whereNotNull('learners.normalized_mobile');
            }
        ]);

        // Filters
        if ($this->request->filled('csc_id')) {
            $query->where('sakhi_id', 'LIKE', '%' . $this->request->csc_id . '%');
        }

        if ($this->request->filled('state')) {
            $query->where('state', $this->request->state);
        }

        if ($this->request->filled('district')) {
            $query->where('district', $this->request->district);
        }

        if ($this->request->filled('contact_number')) {
            $query->where('contact_number', 'LIKE', '%' . $this->request->contact_number . '%');
        }
        return $query;
    }


    public function headings(): array
    {
        return [
            'CSC ID',
            'Name',
            'State',
            'District',
            'Contact Number',
            'Learner Count',
            'Total Certification',
            'Total Event Submitted',
            'Total Event Pending For Verification',
            'Total Event Action Required',
            'Total Event Accepted',
            'Total Event Rejected',
            'Job Events Submitted',
            'Job Events Pending For Verification',
            'Job Events Action Required',
            'Job Event Accepted',
            'Job  Event Rejected',
            'Social Protection Events Submitted',
            'Social Protection Events Pending For Verification',
            'Social Protection Events Action Required',
            'Social Protection Events Accepted',
            'Total Social Protection rejected',
        ];
    }


    public function map($agent): array
    {
        //dd($agent);
        return [
            $agent->sakhi_id,
            $agent->name ?? '',
            $agent->state,
            $agent->district,
            $agent->contact_number,
            $agent->learner_count,
            $agent->completed_learners_count,

            $agent->event_transactions_count,
            $agent->open_transactions_count,
            $agent->pending_transactions_count,
            $agent->accepted_transactions_count,
            $agent->rejected_transactions_count,

            $agent->job_transactions_count,
            $agent->open_job_event_transactions_count,
            $agent->pending_job_event_transactions_count,
            $agent->accepted_job_event_transactions_count,
            $agent->rejected_job_event_transactions_count,

            $agent->socialprotection_transactions_count,
            $agent->open_social_protection_event_transactions_count,
            $agent->pending_social_protection_transactions_count,
            $agent->accepted_social_protection_transactions_count,
            $agent->rejected_social_protection_transactions_count
        ];
    }

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }
}
