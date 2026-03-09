<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PlacementPartnerLearnersExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;
    protected $partnerPlacementId;

    public function __construct(Request $request, $partnerPlacementId)
    {
        $this->request = $request;
        $this->partnerPlacementId = $partnerPlacementId;
    }

    public function query()
    {

        
        

        $query = DB::table('learners as l')
            ->leftJoin('learner_courses as yl', 'l.normalized_mobile', '=', 'yl.phone_number')

            ->whereNotNull('l.normalized_mobile')

            ->whereIn('l.UNIT_INSTITUTE', function ($q) {
                $q->select('csc_id')
                  ->from('yuwaah_sakhi')
                  ->where('partner_placement_user_id', $this->partnerPlacementId);
            })

            ->select(
                'l.id',
                'l.first_name',
                'l.last_name',
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
                DB::raw("
                    CASE 
                        WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes'
                        ELSE 'No'
                    END AS differently_abled
                "),

                'l.create_date'
            )

            ->groupBy(
                'l.id',
                'l.first_name',
                'l.last_name',
                'l.date_of_birth',
                'l.primary_phone_number',
                'l.PROGRAM_STATE',
                'l.PROGRAM_DISTRICT',
                'l.UNIT_INSTITUTE',
                'l.education_level',
                'l.english_knowledge',
                'l.digital_proficiency',
                'l.create_date'
            )
            ->orderBy('l.first_name', 'asc');

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */

        $query->when($this->request->filled('name'), function ($q) {
            $q->where('l.first_name', 'like', '%' . $this->request->name . '%');
        });

        $query->when($this->request->filled('primary_phone_number'), function ($q) {
            $q->where('l.primary_phone_number', $this->request->primary_phone_number);
        });

        $query->when($this->request->filled('PROGRAM_STATE'), function ($q) {
            $q->where('l.PROGRAM_STATE', $this->request->PROGRAM_STATE);
        });

        $query->when($this->request->filled('district'), function ($q) {
            $q->where('l.PROGRAM_DISTRICT', $this->request->district);
        });

        $query->when($this->request->filled('unit_institute'), function ($q) {
            $q->where('l.UNIT_INSTITUTE', $this->request->unit_institute);
        });

        return $query;
    }

    public function headings(): array
    {
        return [
            'Learner Name',
            'Date Of Birth',
            'Phone Number',
            'State',
            'District',
            'Center ID',
            'Education Level',
            'English Knowledge',
            'Digital Proficiency',
            'Course Names',
            'Certification',
            'Differently Abled',
            'Registration Date'
        ];
    }

    public function map($row): array
    {
        return [
            $row->first_name . ' ' . $row->last_name,
            $row->date_of_birth,
            $row->primary_phone_number,
            $row->PROGRAM_STATE,
            $row->PROGRAM_DISTRICT,
            $row->UNIT_INSTITUTE,
            $row->education_level,
            $row->english_knowledge,
            $row->digital_proficiency,
            $row->course_names,
            $row->completed_course,
            $row->differently_abled,
            $row->create_date
        ];
    }
}
