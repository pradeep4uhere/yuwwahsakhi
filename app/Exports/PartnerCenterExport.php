<?php

namespace App\Exports;

use App\Models\PartnerCenter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PartnerCenterExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PartnerCenter::select(
            'partner_id',
            'partner_centers_id',
            'center_name',
            'email',
            'contact_number',
            'district_id',
            'block_id',
            'state_id',
            'status',
            'address',
            'pincode',
            'password',
            'onboard_date'
        )->get();
    }


    public function headings(): array
    {
        return [
            'Partner ID',
            'Partner Center ID',
            'Center Name',
            'Email',
            'Contact Number',
            'District ID',
            'Block ID',
            'State ID',
            'Status',
            'Address',
            'Pincode',
            'Password',
            'Onboard Date',
        ];
    }
}
