<?php

namespace App\Exports;

use App\Models\Opportunity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OpportunityExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Opportunity::select(
            'opportunities_title',
            'description',
            'payout_monthly',
            'start_date',
            'end_date',
            'number_of_openings',
            'provider_name',
            'opportunitie_type',
            'incentive',
            'document',
            'sakhi_id'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Opportunity Title',
            'Description',
            'Payout Monthly',
            'Start Date',
            'End Date',
            'Number of Openings',
            'Provider Name',
            'Opportunity Type',
            'Incentive',
            'Document',
            'Sakhi ID',
        ];
    }
}
