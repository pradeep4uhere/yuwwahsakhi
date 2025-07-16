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
            'status',
            'onboard_date'
        )->get();
    }


    public function headings(): array
    {
        return [
            'Partner ID',
            'Partner Division ID',
            'Division Name',
            'Login Email',
            'Contact Number',
            'Status',
            'Onboard Date',
        ];
    }
}
