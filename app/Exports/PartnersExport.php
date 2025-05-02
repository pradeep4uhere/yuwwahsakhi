<?php

namespace App\Exports;
use App\Models\Partner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PartnersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Partner::with('state', 'district', 'block')->get()->map(function ($partner) {
            return [
                'ID' => $partner->id,
                'Partner ID' => $partner->partner_id,
                'Name' => $partner->name,
                'Email' => $partner->email,
                'Contact Number' => $partner->contact_number,
                'State' => $partner->state->name ?? '',
                'District' => $partner->district->name ?? '',
                'Block' => $partner->block->name ?? '',
                'Address' => $partner->address,
                'Pincode' => $partner->pincode,
                'Status' => ($partner->status==1)?'Active':'Inactive',
                'Created At' => $partner->created_at,  // optional
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Partner ID',
            'Name',
            'Email',
            'Contact Number',
            'State',
            'District',
            'Block',
            'Address',
            'Pincode',
            'Status',
            'Created'
        ];
    }


    
}
