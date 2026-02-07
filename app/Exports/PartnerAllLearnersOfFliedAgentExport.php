<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\YuwaahSakhi;


class PartnerAllLearnersOfFliedAgentExport implements FromQuery,
WithHeadings,
WithMapping,
ShouldAutoSize
{

    protected $request;
    protected $partnerId;
    protected $agent_id;


    public function __construct($request, $partnerId,$agent_id)
    {
        $this->request   = $request;
        $this->partnerId = $partnerId;
        $this->agent_id = $agent_id;
    }


     /**
     * Main query (same logic as listing)
     */
    public function query()
    {
        $ys_id = decryptString($this->agent_id);
        $agentArray = YuwaahSakhi::findOrFail($ys_id);
        $cscValue   = $agentArray->csc_id;
        $query = DB::table('learners as l')
            ->leftJoin('yhub_learners as yl', 'l.normalized_mobile', '=', 'yl.normalized_mobile')
            ->join('yuwaah_sakhi as ys', 'ys.csc_id', '=', 'l.UNIT_INSTITUTE')
            ->where('ys.partner_id', $this->partnerId)
            ->where('l.UNIT_INSTITUTE',$cscValue)
            ->whereNotNull('l.normalized_mobile')
            ->select(
                'l.first_name',
                'l.last_name',
                'l.date_of_birth',
                'l.normalized_mobile',
                'l.PROGRAM_STATE',
                'l.PROGRAM_DISTRICT',
                'l.UNIT_INSTITUTE',
                'l.education_level',
                'l.english_knowledge',
                'l.digital_proficiency',
                DB::raw("
                    CASE 
                        WHEN MAX(yl.completion_status) = 1 THEN 'Yes'
                        ELSE 'No'
                    END as course_completed
                "),
                DB::raw("
                    CASE 
                        WHEN l.DIFFRENTLY_ABLED = 1 THEN 'Yes'
                        ELSE 'No'
                    END as differently_abled
                ")
            )
            ->groupBy(
                'l.id',
                'l.first_name',
                'l.last_name',
                'l.normalized_mobile',
                'l.UNIT_INSTITUTE',
                'l.DIFFRENTLY_ABLED'
            )->orderBy('l.id');

        /* 🔹 Filters from request */
        $query->when($this->request->filled('name'), function ($q) {
            $q->where('l.first_name', 'like', '%' . $this->request->name . '%');
        });

        $query->when($this->request->filled('unit_institute'), function ($q) {
            $q->where('l.UNIT_INSTITUTE', $this->request->unit_institute);
        });

        return $query;
    }



    /**
     * Excel headings
     */
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
     * Map row data
     */
    public function map($row): array
    {
        return [
            $row->first_name.' '.$row->last_name,
            $row->date_of_birth,
            $row->normalized_mobile,
            $row->PROGRAM_STATE,
            $row->PROGRAM_DISTRICT,
            $row->UNIT_INSTITUTE,
            $row->education_level,
            $row->english_knowledge,
            $row->digital_proficiency,
            $row->course_completed,
            $row->differently_abled,
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
