<?php

namespace App\Exports;

use App\Models\Promotion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PromotionExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Promotion::select(
            'promotional_descriptions',
            'material_file',
            'thumbnail',
            'banner',
            'status'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Promotional Description',
            'Material File',
            'Thumbnail',
            'Banner',
            'Status',
        ];
    }
}
