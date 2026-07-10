<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\YuwaahSakhi;

class FieldAgentSummaryService
{

    /**
     * Generate Field Agent Summary
     */
    public function generate()
    {

        // Step 1
        $agents = $this->loadAgents();

       

        // Step 2
        $learners = $this->loadLearners();

        // Step 3
        $events = $this->loadEvents();

        // Step 4
        $completedPhones = $this->loadCompletedPhones();
        

        $eventLookup = $this->buildEventLookup($events);

       

        // Step 5
        $rows = $this->processAgents(
            $agents,
            $learners,
            $eventLookup,
            $completedPhones
        );

        // Step 6
        $this->saveSummary($rows);

        return count($rows);

    }

    /**
     * Load all Field Agents
     */
    private function loadAgents()
    {
        return YuwaahSakhi::select(
                'id',
                'partner_id',
                'csc_id'
            )
            ->where('csc_id','!=','Sandbox_Testing')
            ->get();
    }

    /**
     * Load all learners
     */
    private function loadLearners()
    {
        return DB::table('learners')
            ->select(
                'id',
                'UNIT_INSTITUTE',
                'primary_phone_number'
            )
            ->where('status','Active')
            ->get()
            ->groupBy('UNIT_INSTITUTE');
    }

    /**
     * Load all events
     */
    private function loadEvents()
    {
        // Get latest ID for each agent + learner + event type
        $latestIds = DB::table('event_transactions')
            ->selectRaw('MAX(id) as id')
            ->groupBy(
                'ys_id',
                'learner_id',
                'event_id'
            )
            ->pluck('id');
    
        return DB::table('event_transactions')
            ->select(
                'id',
                'ys_id',
                'learner_id',
                'event_id',
                'review_status',
                'event_date_submitted'
            )
            ->whereIn('id', $latestIds)
            ->get()
            ->groupBy('ys_id');
    }

    /**
     * Load completed learner phones
     */
    private function loadCompletedPhones()
    {

        return DB::table('yhub_learners')
            ->pluck('email_address')
            ->map(function ($phone){

                $phone = preg_replace('/\D/','',$phone);

                return substr($phone,-10);

            })
            ->flip();

    }

    /**
     * Process all agents
     */
    private function processAgents(
        $agents,
        $learners,
        $eventLookup,
        $completedPhones
    ) {
    
        $eventMap = [];
    
        // Debug only
        $rows = [];

        foreach ($agents as $agent) {
        
            $agentLearners = $learners[$agent->csc_id] ?? collect();
        
            $agentEvents = $eventMap[$agent->id] ?? [];
        
            $summary = [

                'learner_count' => $agentLearners->count(),
            
                'completed_learners' => 0,
            
                'total_jobs' => 0,
                'open_jobs' => 0,
                'pending_jobs' => 0,
                'accepted_jobs' => 0,
                'rejected_jobs' => 0,
            
                'total_social' => 0,
                'open_social' => 0,
                'pending_social' => 0,
                'accepted_social' => 0,
                'rejected_social' => 0,
            
            ];

            foreach ($agentLearners as $learner) {

                /*
                |--------------------------------------------------------------------------
                | Completed Course
                |--------------------------------------------------------------------------
                */
            
                $phone = preg_replace('/\D/', '', $learner->primary_phone_number);
                $phone = substr($phone, -10);
            
                if (isset($completedPhones[$phone])) {
                    $summary['completed_learners']++;
                }
            
                /*
                |--------------------------------------------------------------------------
                | Latest Events
                |--------------------------------------------------------------------------
                */
            
                $event = $eventLookup[$agent->id][$learner->id] ?? null;
            
                if (!$event) {
                    continue;
                }
            
                /*
                |--------------------------------------------------------------------------
                | Job
                |--------------------------------------------------------------------------
                */
            
                if ($event['job']) {
            
                    $summary['total_jobs']++;
            
                    switch ($event['job']['review_status']) {
            
                        case 'Accepted':
                            $summary['accepted_jobs']++;
                            break;
            
                        case 'Pending':
                            $summary['pending_jobs']++;
                            break;
            
                        case 'Rejected':
                            $summary['rejected_jobs']++;
                            break;
            
                        case 'Open':
                            $summary['open_jobs']++;
                            break;
                    }
            
                }
            
                /*
                |--------------------------------------------------------------------------
                | Social
                |--------------------------------------------------------------------------
                */
            
                if ($event['social']) {
            
                    $summary['total_social']++;
            
                    switch ($event['social']['review_status']) {
            
                        case 'Accepted':
                            $summary['accepted_social']++;
                            break;
            
                        case 'Pending':
                            $summary['pending_social']++;
                            break;
            
                        case 'Rejected':
                            $summary['rejected_social']++;
                            break;
            
                        case 'Open':
                            $summary['open_social']++;
                            break;
                    }
            
                }
            
            }


            $rows[] = [

                'sakhi_id' => $agent->id,
            
                'partner_id' => $agent->partner_id,
            
                'csc_id' => $agent->csc_id,
            
                'learner_count' => $summary['learner_count'],
            
                'completed_learners' => $summary['completed_learners'],
            
                'total_jobs' => $summary['total_jobs'],
                'open_jobs' => $summary['open_jobs'],
                'pending_jobs' => $summary['pending_jobs'],
                'accepted_jobs' => $summary['accepted_jobs'],
                'rejected_jobs' => $summary['rejected_jobs'],
            
                'total_social' => $summary['total_social'],
                'open_social' => $summary['open_social'],
                'pending_social' => $summary['pending_social'],
                'accepted_social' => $summary['accepted_social'],
                'rejected_social' => $summary['rejected_social'],
            
                'summary_generated_at' => now(),
            
                'created_at' => now(),
            
                'updated_at' => now(),
            
            ];
        
        }
        

        
        return $rows;
//        dd($rows[0], count($rows));
    }

    /**
     * Bulk Save
     */
    private function saveSummary(array $rows)
    {

        if(empty($rows)){
            return;
        }

        DB::table('field_agent_summaries')->upsert(

            $rows,

            ['sakhi_id'],

            [
                'partner_id',
                'csc_id',

                'total_jobs',
                'open_jobs',
                'pending_jobs',
                'accepted_jobs',
                'rejected_jobs',

                'total_social',
                'open_social',
                'pending_social',
                'accepted_social',
                'rejected_social',

                'learner_count',
                'completed_learners',

                'summary_generated_at',

                'updated_at'
            ]

        );

    }



    private function buildEventLookup($events)
    {
        $lookup = [];

        foreach ($events as $ysId => $agentEvents) {

            foreach ($agentEvents as $event) {

                if (!isset($lookup[$ysId][$event->learner_id])) {
                    $lookup[$ysId][$event->learner_id] = [
                        'job' => null,
                        'social' => null,
                    ];
                }

                // Job Events (event_id != 3)
                if ((int)$event->event_id != 3) {

                    if ($lookup[$ysId][$event->learner_id]['job'] === null) {

                        $lookup[$ysId][$event->learner_id]['job'] = [
                            'review_status' => $event->review_status,
                            'submitted' => !empty($event->event_date_submitted),
                        ];

                    }

                }
                // Social Protection (event_id == 3)
                else {

                    if ($lookup[$ysId][$event->learner_id]['social'] === null) {

                        $lookup[$ysId][$event->learner_id]['social'] = [
                            'review_status' => $event->review_status,
                            'submitted' => !empty($event->event_date_submitted),
                        ];

                    }

                }

            }

        }

        return $lookup;
    }

}