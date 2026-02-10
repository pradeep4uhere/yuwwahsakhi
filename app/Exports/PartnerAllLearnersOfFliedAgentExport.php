<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\YuwaahSakhi;
use App\Models\Learner;


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
        $this->ys_id = decryptString($this->agent_id); 

         // preload events once
         $this->eventTransactionList = DB::table('event_transactions')
         ->where('ys_id', $this->ys_id)
         ->get();
    }


     /**
     * Main query (same logic as listing)
     */
    public function query()
    {


        $agentArray = YuwaahSakhi::findOrFail($this->ys_id);
        $cscValue   = $agentArray->csc_id;

        /*
        |--------------------------------------------------------------------------
        | Base Query
        |--------------------------------------------------------------------------
        */
        $query = Learner::query()
            ->where('learners.status', 'Active')
            ->where('learners.UNIT_INSTITUTE', $cscValue);

        /* ---------------- Filters ---------------- */
        $query
            ->when($this->request->filled('name'), function ($q) {
                $q->where(function ($sub) {
                    $sub->where('learners.first_name', 'like', "%{$this->request->name}%")
                        ->orWhere('learners.last_name', 'like', "%{$this->request->name}%");
                });
            })
            ->when($this->request->filled('email'), fn ($q) =>
                $q->where('learners.email', 'like', "%{$this->request->email}%")
            )
            ->when($this->request->filled('phone'), fn ($q) =>
                $q->where('learners.primary_phone_number', 'like', "%{$this->request->phone}%")
            )
            ->when($this->request->filled('gender'), fn ($q) =>
                $q->where('learners.gender', $this->request->gender)
            );

        /*
        |--------------------------------------------------------------------------
        | Latest Event Subquery
        |--------------------------------------------------------------------------
        */
        $latestEvents = DB::table('event_transactions')
            ->select('learner_id', 'updated_at as last_event_update')
            ->where('ys_id', $this->ys_id)
            ->orderByDesc('id');

        return $query
                ->leftJoin('yhub_learners as yl', function ($join) {
                    $join->on('learners.normalized_mobile', '=', 'yl.normalized_mobile');
                })
                ->leftJoinSub($latestEvents, 'et', function ($join) {
                    $join->on('learners.id', '=', 'et.learner_id');
                })
                ->select([
                    'learners.*',
                    'yl.email_address as yhub_email_address',
                    'yl.completion_status',
                    DB::raw("CASE WHEN yl.completion_status = 1 THEN 'Yes' ELSE 'No' END as course_completed_status"),
                    DB::raw('COALESCE(et.last_event_update, learners.updated_at) as sort_updated_at'),
                ])
                ->groupBy(
                    'learners.id',
                    'yl.email_address',
                    'yl.completion_status',
                    'et.last_event_update'
                )
                ->orderByDesc('sort_updated_at');
    
    }



   /*
    |--------------------------------------------------------------------------
    | Headings
    |--------------------------------------------------------------------------
    */
    public function headings(): array
    {
        return [
            'Learner ID',
            'Name',
            'Phone',
            'DOB',
            'Education',
            'Digital Proficiency',
            'Differently Abled',
            'English Knowledge',
            'State',
            'District',
            'YHub Email',
            'Course Completed',
            'Job Event',
            'Social Protection',
        ];

    }

    /*
    |--------------------------------------------------------------------------
    | Row Mapping
    |--------------------------------------------------------------------------
    */
    public function map($row): array
    {
        //dd($row);
        return [
            $row->id,
            $row->first_name . ' ' . $row->last_name,
            $row->primary_phone_number,
            $row->date_of_birth,
            $row->education_level,
            $row->digital_proficiency,
            $row->DIFFRENTLY_ABLED,
            $row->english_knowledge,
            $row->PROGRAM_STATE,
            $row->PROGRAM_DISTRICT,
            $row->yhub_email_address,
            $row->course_completed_status,
            $this->checkIsJobEvent($row->id),
            $this->checkIsSocialProtection($row->id),
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }


    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    protected function checkIsJobEvent($learnerId)
    {
          $event = $this->eventTransactionList
            ->where('learner_id', $learnerId)
            ->whereIn('event_type', [1, 5])
            ->sortByDesc('updated_at')
            ->first();
            if (!$event || empty($event->review_status)) {
                return '';
            }
        
            return match ($event->review_status) {
                'Open'     => 'Submitted',
                'Pending'  => 'Action Required',
                'Accepted' => 'Accepted',
                'Rejected' => 'Rejected',
                default    => $event->review_status, // fallback safety
            };
    }

    protected function checkIsSocialProtection($learnerId)
    {
        $event = $this->eventTransactionList
        ->where('learner_id', $learnerId)
        ->whereIn('event_type', [3])
        ->sortByDesc('updated_at')
        ->first();
        if (!$event || empty($event->review_status)) {
            return '';
        }
    
        return match ($event->review_status) {
            'Open'     => 'Submitted',
            'Pending'  => 'Action Required',
            'Accepted' => 'Accepted',
            'Rejected' => 'Rejected',
            default    => $event->review_status, // fallback safety
        };
    }
}
