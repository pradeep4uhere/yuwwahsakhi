<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use App\Models\Partner;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use Auth;

class PartnerAllLearnersExport implements FromQuery, WithHeadings
{
    protected $request;
    protected $partnerId;

    public function __construct($request, $partnerId)
    {
        //dd($this->request);
        $this->request   = $request;
        $this->partnerId = $partnerId;
    }


    public function query()
    {
        $partneerID = config('constants.partners.'.Auth::user()->partner_id);   
      
        //dd($partneerID);
        $query = DB::table('learners as l')
            ->leftJoin('learner_courses as yl', 'l.normalized_mobile', '=', 'yl.phone_number')
            ->where('l.PROGRAM_CODE', $partneerID)
            ->whereNotNull('l.normalized_mobile')
            ->whereNotNull('l.UNIT_INSTITUTE')
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
                DB::raw("GROUP_CONCAT(yl.course_name SEPARATOR ', ') as course_names"),
                DB::raw("MAX(yl.completed_course) as completed_course"),
                // ✅ Differently abled: 1 → Yes, else No
                    DB::raw("
                    CASE 
                        WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes'
                        ELSE 'No'
                    END AS differently_abled
                "),
                'l.create_date',
                
            )
            ->groupBy('l.id')
            ->orderBy('l.id', 'asc'); // ✅ REQUIRED;
            // 🔥 Filters (do NOT return inside conditions)
            $query->when($this->request->filled('name'), function ($q) {
                $q->where('l.first_name', 'like', '%' . $this->request->name . '%');
            });

            $query->when($this->request->filled('primary_phone_number'), function ($q) {
                $q->where('l.primary_phone_number', $this->request->primary_phone_number );
            });

            $query->when($this->request->filled('PROGRAM_STATE'), function ($q) {
                $q->where('l.PROGRAM_STATE', $this->request->PROGRAM_STATE);
            });

            //dd($this->request->filled('unit_institute'));
            $query->when($this->request->filled('unit_institute'), function ($q) {
                $q->where('l.UNIT_INSTITUTE',  $this->request->unit_institute );
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
                'Course Name',
                'Certification',
                'Differently Abled',
                'Registration Date'
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
