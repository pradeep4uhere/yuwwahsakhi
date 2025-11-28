<?php

namespace App\Exports;

use App\Models\YuwaahSakhi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Auth;
use DB;

class PlacementYuwaahSakhiExport implements FromCollection, WithHeadings
{
    protected $partnerPlacementUserId;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        $partnerPlacementUserId = Auth::id();  
        return DB::table('yuwaah_sakhi as ys')
        ->leftJoin('partners as p', 'ys.partner_id', '=', 'p.id')
        ->leftJoin('partner_centers as pc', 'ys.partner_center_id', '=', 'pc.id')
        ->select(
            'ys.id',
            'ys.csc_id',
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
        ->where('partner_placement_user_id', $partnerPlacementUserId)
        ->get();
    }


    public function headings(): array
    {
        return [
            'ID',
            'Program Name',
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
