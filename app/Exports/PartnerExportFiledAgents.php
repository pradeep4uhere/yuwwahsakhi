<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\YuwaahSakhi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


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
                'learners as learner_count' => function ($q) {
                    $q->whereColumn('learners.UNIT_INSTITUTE', 'yuwaah_sakhi.csc_id');
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
            'Job Events Submitted',
            'Job Events Pending For Verification',
            'Job Events Action Required',
            'Job Event Accepted',
            'Job  Event Rejected',
            'Social Protection Events Submitted',
            'Social Protection Events Pending For Verification',
            'Social Protection Events Action Required',
            'Social Protection Events Accepted',
            'Social Protection Events Rejected'
        ];
    }


    public function map($agent): array
    {
        return [
            $agent->sakhi_id,
            $agent->name ?? '',
            $agent->state,
            $agent->district,
            $agent->contact_number,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count,
            $agent->learner_count
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
