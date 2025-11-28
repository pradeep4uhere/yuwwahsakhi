<?php

namespace App\Exports;

use App\Models\PartnerPlacementUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PartnerPlacementUserExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PartnerPlacementUser::select(
            'id',
            'name',
            'email',
            'phone',
            'pp_code',
            'status',
            'created_at'
        )->get();
    }



     // 🔥 This maps each row before export
     public function map($user): array
     {
         return [
             $user->id,
             $user->name,
             $user->email,
             $user->phone,
             $user->pp_code,
             // Convert status to Active / Inactive
             $user->status == 1 ? 'Active' : 'Inactive',
             $user->created_at,
         ];
     }


    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Code',
            'Status',
            'Created At',
        ];
    }
}
