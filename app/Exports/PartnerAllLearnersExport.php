<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use App\Models\Partner;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PartnerAllLearnersExport implements FromQuery, WithHeadings
{
    protected $request;
    protected $partnerId;

    public function __construct($request, $partnerId)
    {
        $this->request   = $request;
        $this->partnerId = $partnerId;
    }


    public function query()
    {
        $partner = Partner::find(getUserId());
        $partneerID = $partner['partner_id'];
        //dd($partneerID);
        $query = DB::table('learners as l')
            ->leftJoin('yhub_learners as yl', 'l.normalized_mobile', '=', 'yl.normalized_mobile')
            ->where('l.PROGRAM_CODE', $partneerID)
            ->whereNotNull('l.normalized_mobile')
            ->select(
                'l.first_name',
                'l.date_of_birth',
                'l.primary_phone_number',
                'l.PROGRAM_STATE',
                'l.PROGRAM_DISTRICT',
                'l.UNIT_INSTITUTE',
                'l.education_level',
                'l.english_knowledge',
                'l.digital_proficiency',
                // ✅ Completion status: 100 → Yes, else No
                DB::raw("
                    CASE 
                        WHEN MAX(yl.completion_percent) = 100 THEN '1'
                        ELSE '0'
                    END AS completion_status
                "),
                // ✅ Differently abled: 1 → Yes, else No
                    DB::raw("
                    CASE 
                        WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes'
                        ELSE 'No'
                    END AS differently_abled
                ")
                
            )
            ->groupBy('l.id')
            ->orderBy('l.id', 'asc'); // ✅ REQUIRED;
            // 🔥 Filters (do NOT return inside conditions)
            $query->when($this->request->filled('name'), function ($q) {
                $q->where('l.first_name', 'like', '%' . $this->request->name . '%');
            });

            $query->when($this->request->filled('phone'), function ($q) {
                $q->where('l.primary_phone_number', 'like', '%' . $this->request->phone . '%');
            });

            $query->when($this->request->filled('PROGRAM_STATE'), function ($q) {
                $q->where('l.PROGRAM_STATE', $this->request->PROGRAM_STATE);
            });

            $query->when($this->request->filled('unit_institute'), function ($q) {
                $q->where('l.UNIT_INSTITUTE', 'like', '%' . $this->request->unit_institute . '%');
            });

            return $query; // ✅ MUST return Query Builder

    }


        public function headings(): array
        {
            return [
                'Name',
                'Date Of Birth',
                'Phone Number',
                'State',
                'District',
                'Unit Institute',
                'Education Level',
                'Digital Proficiency',
                'English Knowledge',
                'Certification',
                'Diffrently Abled'
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
