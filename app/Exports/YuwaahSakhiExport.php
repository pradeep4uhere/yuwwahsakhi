<?php

namespace App\Exports;

use App\Models\YuwaahSakhi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class YuwaahSakhiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    return DB::table('yuwaah_sakhi as ys')
        ->leftJoin('partners as p', 'ys.partner_id', '=', 'p.id')
        ->leftJoin('partner_centers as pc', 'ys.partner_center_id', '=', 'pc.id')
        ->select(
            'ys.id',
            'ys.sakhi_id',
            'ys.name',
            'ys.contact_number',
            'ys.email',
            'p.partner_id as partnerID',
            'p.name as partner_name',
            'pc.partner_centers_id as partner_division_id',
            'pc.center_name as partner_center_name',
            'ys.profile_picture',
            'ys.created_at'
        )
        ->get();
}

    public function headings(): array
    {
        return [
            'ID',
            'Sakhi ID',
            'Name',
            'Contact Number',
            'Email',
            'Partner ID',
            'Partner Name',
            'Partner Division ID',
            'Partner Division',
            'Profile Picture',
            'Created At'
        ];
    }
}
