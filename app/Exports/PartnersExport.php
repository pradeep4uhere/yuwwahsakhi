<?php

namespace App\Exports;
use App\Models\Partner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PartnersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Partner::select('id', 'partner_id', 'name', 'email', 'contact_number', 'address', 'pincode', 'status')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Partner ID',
            'Name',
            'Email',
            'Contact Number',
            'Address',
            'Pincode',
            'Status'
        ];
    }
}
