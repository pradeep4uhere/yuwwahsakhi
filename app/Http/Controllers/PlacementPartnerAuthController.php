<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\PartnerPlacementUserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlacementYuwaahSakhiExport;
use App\Exports\PlacementYuwaahSakhiLearnerExport;
use App\Exports\PlacementPartnerExportFiledAgents;
use App\Exports\PlacementPartnerAllLearnersOfFliedAgentExport;
use DB;
use Log;
use App\Models\YuwaahSakhi;
use App\Models\Learner;
use App\Models\Partner;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;
use Crypt;
use App\Exports\PlacementPartnerLearnersExport;
use App\Exports\PlacementPartnerLearnersEventExport;

class PlacementPartnerAuthController extends Controller
{
    

   

    public function loginForm()
    {
        return view('placementpartner.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('pp_partner')->attempt($credentials)) {
            return redirect()->route('placementpartner.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('pp_partner')->logout();
        return redirect()->route('placementpartner.login');
    }


     /**
     * Display the user's profile form.
     */
    public function dashboard(Request $request)
    {
       

        return view('placementpartner.dashboard', [
            'title' => 'Dashboard',
            'chartsData'=>"",
            'totalCount'=>0,
            'labels'=>"",
            'states'=>'',
            'learnerAgeGroup'=>'',
            'learnerGenderGroup'=>''
        ]);
    }



    public function viewAllFieldCenter(Request $request)
    {
       //All field Center
        $id = Auth::user()->id;
        //$data = YuwaahSakhi::where('partner_placement_user_id',$id)->paginate(50);
        $query = DB::table('yuwaah_sakhi as ys')
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
            'ys.status',
            'ys.state',
            'ys.district',
            'ys.created_at',
            DB::raw('(SELECT COUNT(*) FROM learners WHERE learners.UNIT_INSTITUTE = ys.csc_id) AS learner_count')
        )
        ->where('partner_placement_user_id', $id);


        // 🔍 Apply Filters (Only if present)
        if ($request->filled('csc_id')) {
            $query->where('ys.sakhi_id', 'LIKE', '%' . $request->csc_id . '%');
        }

        if ($request->filled('state')) {
            $query->where('ys.state', $request->state);
        }

        if ($request->filled('district')) {
            $query->where('ys.district', $request->district);
        }

        if ($request->filled('contact_number')) {
            $query->where('ys.contact_number', $request->contact_number);
        }


        
        // Pagination with query string preserved
        $data = $query->paginate(50)->withQueryString();
        //dd($data );
  


        //Get All State List and District
        $statetdata = DB::table('yuwaah_sakhi as ys')
        ->select('ys.state')        
        ->distinct()
        ->orderBy('ys.state')
        ->get();
       // dd($statetdata);
        return view('placementpartner.fieldCenterList', [
            'title' => 'All Field Center',
            'data'=>$data,
            'statetdata'=>$statetdata
        ]);
    }


    public function exportPlacementYuwaahSakhi(Request $request)
    {
        $partnerPlacementUserId = $request->partner_placement_user_id;

        return Excel::download(
            new PlacementYuwaahSakhiExport($partnerPlacementUserId),
            'placement_yuwaah_sakhi_'.date('y_M_d_h_i_s_a').'.xlsx'
        );
    }
    



        private function checkIsJobEvent($eventTransactionList, $learner_id)
        {
            foreach ($eventTransactionList as $item) {
                if ($item->learner_id == $learner_id && (int)$item->event_id != 3) {
                    return array('is_job_event'=>true, 'is_submitted'=> $item->event_date_submitted,'review_status'=> $item->review_status);
                }
            }
            return array('is_job_event'=>false, 'is_submitted'=> "",'review_status'=> "");
        }



        private function checkEventTypeJobSocialProtection($eventTransactionList, $learner_id)
        {
            foreach ($eventTransactionList as $item) {
                if ($item->learner_id == $learner_id && (int)$item->event_id === 3) {
                    return array('is_social_event'=>true, 'is_submitted'=> $item->event_date_submitted,'review_status'=> $item->review_status);
                }
            }
            return array('is_social_event'=>false, 'is_submitted'=> "",'review_status'=> "");
        }



    /**
     * Learner View Page
     */
     public function viewLearner(Request $request,$id){
        try {
            $cscValue = decryptString($id); 

            $ys_id = YuwaahSakhi::where('csc_id', $cscValue)->value('id');
            //Get all Learner List
            //$LearnerList = Learner::where('UNIT_INSTITUTE',$cscValue)->paginate(50);
            // $LearnerList = DB::table('learners as l')
            // ->leftJoin('yhub_learners as yh', function ($join) {
            //     $join->on(DB::raw('RIGHT(l.primary_phone_number, 10)'), '=', DB::raw('RIGHT(yh.email_address, 10)'));
            // })
            // ->where('l.UNIT_INSTITUTE', $cscValue)
            // ->select(
            //     'l.*',
            //     DB::raw("
            //         CASE 
            //             WHEN yh.id IS NOT NULL 
            //             THEN 'Completed' 
            //             ELSE 'Not Completed' 
            //         END AS completion_status
            //     ")
            // )
            // ->paginate(50);
            // //dd($LearnerList);


            //dd($latestEvents);


                        // Base query
            $query = Learner::where('learners.status', 'Active')
                ->where('learners.UNIT_INSTITUTE', $cscValue);

            // Filters
            if ($request->filled('name')) {
                $query->where(function ($q) use ($request) {
                    $q->where('learners.first_name', 'like', '%' . $request->name . '%')
                    ->orWhere('learners.last_name', 'like', '%' . $request->name . '%');
                });
            }
            if ($request->filled('email')) {
                $query->where('learners.email', 'like', '%' . $request->email . '%');
            }
            if ($request->filled('phone')) {
                $query->where('primary_phone_number', 'like', '%' . $request->phone . '%');
            }
            if ($request->filled('gender')) {
                $query->where('learners.gender', $request->gender);
            }
            // Add latest events join
            $latestEvents = DB::table('event_transactions')
            ->select('*', 'updated_at as last_event_update')
            ->where('ys_id', $ys_id)
            ->orderBy('id', 'DESC');



                // $sql = $latestEvents->toSql();
                // $bindings = $latestEvents->getBindings();
                // dd(vsprintf(str_replace('?', '%s', $sql), collect($bindings)->map(function ($binding) {
                //        return is_numeric($binding) ? $binding : "'{$binding}'";
                //     })->toArray()));

                $query->leftJoin('yhub_learners', function ($join) {
                        $join->on('learners.primary_phone_number', '=', DB::raw("REPLACE(yhub_learners.email_address, '+91 ', '')"));
                    })
                    ->leftJoinSub($latestEvents, 'et', function ($join) {
                        $join->on('learners.id', '=', 'et.learner_id');
                    })
                    ->select([
                        'learners.id',
                        'learners.date_of_birth',
                        'learners.education_level',
                        'learners.UNIT_INSTITUTE',
                        'learners.digital_proficiency',
                        'learners.DIFFRENTLY_ABLED',
                        'learners.english_knowledge',
                        'learners.PROGRAM_STATE',
                        'learners.PROGRAM_DISTRICT',
                        'learners.course_completed',
                        'learners.first_name',
                        'learners.last_name',
                        'learners.primary_phone_number',
                        'yhub_learners.email_address as yhub_email_address',
                        'yhub_learners.completion_status as completion_status',
                        DB::raw('COALESCE(et.last_event_update, learners.updated_at) as sort_updated_at')
                    ])
                    ->groupBy(
                        'learners.id',
                        'learners.UNIT_INSTITUTE',
                        'learners.first_name',
                        'learners.last_name',
                        'learners.primary_phone_number',
                        'yhub_learners.email_address',
                        'yhub_learners.completion_status',
                        'et.last_event_update',
                        'learners.updated_at'
                    )
                    ->orderBy('sort_updated_at', 'desc')
                    ->distinct();   // 👈 Ensures unique rows;


                //dd($result);
                // Debug SQL if needed
                //dd($query->toSql(), $query->getBindings());

                // Now paginate once, at the very end
                $learnerListArr = $query->paginate(500)
                    ->appends($request->query());
                        //dd($learnerListArr);
                // Get job event type id
                $eventTypeId = DB::table('yuwaah_event_type')
                    ->whereRaw('LOWER(name) = ?', ['job'])
                    ->value('id');

                    // After building the $query but before paginate()
                    //$sql = $query->toSql();
                    //$bindings = $query->getBindings();

                    // dd(vsprintf(str_replace('?', '%s', $sql), collect($bindings)->map(function ($binding) {
                    //    return is_numeric($binding) ? $binding : "'{$binding}'";
                    // })->toArray()));

                //dd($learnerListArr);
                $learnerList =[];
                $eventTransactionList = $latestEvents->get();
                //dd($eventTransactionList);
                foreach($learnerListArr as $item){
                    $learnerList[$item['id']]=array(
                        'item'=>$item,
                        'job_event'=> $this->checkIsJobEvent($eventTransactionList,$item['id']),
                        'social_protection' => $this->checkEventTypeJobSocialProtection($eventTransactionList,$item['id'])
                    );
                }

               //dd($learnerList);

            
            return view('placementpartner.learnerList', [
                'title' => 'All Learners',
                'data'=>$learnerList,
                'ppid'=>$id
            ]);
        }catch(DecryptException $e){
            // Invalid encrypted string
            Log::warning("Decrypt failed for learner link: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Invalid or expired link.');
        }
    }



    /**
     *  Export All Learner Of the VLE
     */
    public function exportPlacementYuwaahSakhiLearner(Request $request,$id)
    {
        $cscValue = decryptString($id); 
       // $partnerPlacementUserId = $request->partner_placement_user_id;
      
        return Excel::download(
            new PlacementYuwaahSakhiLearnerExport($cscValue),
                'placement_learners_'.$cscValue.'.xlsx'
        );
    }
    



    
    
    public function getDistricts(Request $request)
    {
        $districts = DB::table('yuwaah_sakhi')
            ->select('district')
            ->where('state', $request->state)
            ->distinct()
            ->orderBy('district')
            ->get();

        return response()->json($districts);
    }




    public function fieldAgentWithEventTransactions(Request $request){
        $totalYuwwahSakhi = YuwaahSakhi::where('partner_placement_user_id',getUserId()) ->where('csc_id','!=' ,'Sandbox_Testing')->count();
        
        // Start query builder
        $query = YuwaahSakhi::with(['Partner', 'PartnerCenter'])
        ->where('partner_placement_user_id', getUserId())
        ->where('csc_id','!=' ,'Sandbox_Testing')
        ->withCount([
            // Total event transactions
            'eventTransactions',

            // All Job Event Transactions Count
            'eventTransactions as job_transactions_count' => function ($q) {
                $q->whereIn('event_type', [1,5]);
            },

           // Submitted Job Event Transactions Count
            'eventTransactions as open_job_event__transactions_count' => function ($q) {
                $q->where('review_status', 'Open')
                ->whereIn('event_type', [1, 5]);
            },

            // Pending Job Event Transactions Count
            'eventTransactions as pending_job_event__transactions_count' => function ($q) {
                $q->where('review_status', 'Pending')
                ->whereIn('event_type', [1, 5]);
            },

            // Accepted Job Event Transactions Count
            'eventTransactions as accepted_job_event__transactions_count' => function ($q) {
                $q->where('review_status', 'Accepted')
                ->whereIn('event_type', [1, 5]);
            },

            // Rejected Job  Event Transactions Count
            'eventTransactions as rejected_job_event_transactions_count' => function ($q) {
                $q->where('review_status', 'Rejected')
                ->whereIn('event_type', [1, 5]);
            },

            

            // All SocialProtecion Event Transactions Count
            'eventTransactions as socialprotection_transactions_count' => function ($q) {
                $q->whereIn('event_type', [3]);
            },

          
            // All SocialProtecion Event Transactions Count
            'eventTransactions as open_social_protection_event_transactions_count' => function ($q) {
                $q->where('review_status', 'Open')
                ->whereIn('event_type', [3]);
            },

            // Pending Job Event Transactions Count
            'eventTransactions as pending_social_protection_transactions_count' => function ($q) {
                $q->where('review_status', 'Pending')
                ->whereIn('event_type', [3]);
            },

            // Accepted Job Event Transactions Count
            'eventTransactions as accepted_social_protection_transactions_count' => function ($q) {
                $q->where('review_status', 'Accepted')
                ->whereIn('event_type', [3]);
            },

            // Rejected Job  Event Transactions Count
            'eventTransactions as rejected_social_protection_transactions_count' => function ($q) {
                $q->where('review_status', 'Rejected')
                ->whereIn('event_type', [3]);
            },
            'learners as learner_count' => function ($q) {
                $q->whereColumn('learners.UNIT_INSTITUTE', 'yuwaah_sakhi.csc_id');
            },
             // Completed learners count
            'learners as completed_learners_count' => function ($q) {
                $q->join('yhub_learners as yl', 'learners.normalized_mobile', '=', 'yl.normalized_mobile')
                ->whereColumn('learners.UNIT_INSTITUTE', 'yuwaah_sakhi.csc_id')
                ->whereNotNull('learners.normalized_mobile');
            },
        ]);

        // 🔍 Apply Filters (only if present)
        if ($request->filled('csc_id')) {
        $query->where('sakhi_id', 'LIKE', '%' . $request->csc_id . '%');
        }

        if ($request->filled('state')) {
        $query->where('state', $request->state);
        }

        if ($request->filled('district')) {
        $query->where('district', $request->district);
        }

        if ($request->filled('contact_number')) {
        $query->where('contact_number', $request->contact_number);
        }

        // Finally paginate
       // $filedAgentList = $query->paginate(10)->withQueryString();
        $filedAgentList = $query
        ->paginate(30)
        ->withQueryString()
        ->through(function ($item) use ($request) {
            $item->Learner = $this->getAllLearnerList($request, $item->id);
            return $item;
        });

       //dd($filedAgentList);


        
       
        
        //learner_count
        // Step 2: Count Opportunities where sakhi_id is in the above IDs
        //Get All State List and District
        $statetdata = DB::table('yuwaah_sakhi as ys')
        ->select('ys.state')        
        ->distinct()
        ->orderBy('ys.state')
        ->get();
        return view('placementpartner.fieldagent.list', [
            'data' => $filedAgentList, // Fetch authenticated partner,
            'totalYuwwahSakhi'=>$totalYuwwahSakhi,
            'statetdata'=>$statetdata
        ]);
    }





    /**
     * Get Details of Filed Agent
     */
    public function getAllLearnerList($request, $agent_id){
        try {
           
             $ys_id = $agent_id; 
             $agentArray= YuwaahSakhi::where('id', $ys_id)->first();
             $cscValue = $agentArray['csc_id'];
             // Base query
             $query = Learner::where('learners.status', 'Active')
                 ->where('learners.UNIT_INSTITUTE', $cscValue);
 
             // Filters
             if ($request->filled('name')) {
                 $query->where(function ($q) use ($request) {
                     $q->where('learners.first_name', 'like', '%' . $request->name . '%')
                     ->orWhere('learners.last_name', 'like', '%' . $request->name . '%');
                 });
             }
             if ($request->filled('email')) {
                 $query->where('learners.email', 'like', '%' . $request->email . '%');
             }
             if ($request->filled('phone')) {
                 $query->where('primary_phone_number', 'like', '%' . $request->phone . '%');
             }
             if ($request->filled('gender')) {
                 $query->where('learners.gender', $request->gender);
             }
             // Add latest events join
             $latestEvents = DB::table('event_transactions')
             ->select('*', 'updated_at as last_event_update')
             ->where('ys_id', $ys_id)
             ->orderBy('id', 'DESC');

            // $sql = $latestEvents->toSql();
            // $bindings = $latestEvents->getBindings();
            // dd(vsprintf(str_replace('?', '%s', $sql), collect($bindings)->map(function ($binding) {
            //        return is_numeric($binding) ? $binding : "'{$binding}'";
            //     })->toArray()));
 
                 $query->leftJoin('yhub_learners', function ($join) {
                         $join->on('learners.primary_phone_number', '=', DB::raw("REPLACE(yhub_learners.email_address, '+91 ', '')"));
                     })
                     ->leftJoinSub($latestEvents, 'et', function ($join) {
                         $join->on('learners.id', '=', 'et.learner_id');
                     })
                     ->select([
                         'learners.id',
                         'learners.date_of_birth',
                         'learners.education_level',
                         'learners.UNIT_INSTITUTE',
                         'learners.digital_proficiency',
                         'learners.DIFFRENTLY_ABLED',
                         'learners.english_knowledge',
                         'learners.PROGRAM_STATE',
                         'learners.PROGRAM_DISTRICT',
                         'learners.course_completed',
                         'learners.first_name','learners.last_name','learners.primary_phone_number',
                         'yhub_learners.email_address as yhub_email_address',
                         'yhub_learners.completion_status as completion_status',
                         DB::raw('COALESCE(et.last_event_update, learners.updated_at) as sort_updated_at')
                     ])
                     ->groupBy(
                         'learners.id',
                         'learners.UNIT_INSTITUTE',
                         'learners.first_name',
                         'learners.last_name',
                         'learners.primary_phone_number',
                         'yhub_learners.email_address',
                         'yhub_learners.completion_status',
                         'et.last_event_update',
                         'learners.updated_at'
                     )
                     ->orderBy('sort_updated_at', 'desc')
                     ->distinct();   // 👈 Ensures unique rows;
 
                 // Debug SQL if needed
                 // dd($query->toSql(), $query->getBindings());
 
                 // Now paginate once, at the very end
                 $learnerListArr = $query->paginate(500)
                     ->appends($request->query());
 
                 // Get job event type id
                 $eventTypeId = DB::table('yuwaah_event_type')
                     ->whereRaw('LOWER(name) = ?', ['job'])
                     ->value('id');
 
                     // After building the $query but before paginate()
                     //$sql = $query->toSql();
                     //$bindings = $query->getBindings();
 
                     // dd(vsprintf(str_replace('?', '%s', $sql), collect($bindings)->map(function ($binding) {
                     //    return is_numeric($binding) ? $binding : "'{$binding}'";
                     // })->toArray()));
 
                 //dd($learnerListArr);
                 $learnerList =[];
                 $eventTransactionList = $latestEvents->get();
                 //dd($eventTransactionList);
                 foreach($learnerListArr as $item){
                    //dd( $item);
                     $learnerList[$item['id']]=array(
                         'item'=>$item,
                         'course_completed'=>$item['course_completed'],
                         'job_event'=> $this->checkIsJobEvent($eventTransactionList,$item['id']),
                         'social_protection' => $this->checkEventTypeJobSocialProtection($eventTransactionList,$item['id'])
                     );
                 }

                //dd($learnerList);
                $jobEventCount = 0;
                $jobEventAcceptedCount = 0;
                $jobEventSubmittedCount = 0;
                $jobEventOpenCount = 0;
                $jobEventPendingCount = 0;
                $jobEventRejectedCount = 0;

                $socialEventCount = 0;
                $socialEventAcceptedCount = 0;
                $socialSubmittedCount = 0;
                $socialEventOpenCount = 0;
                $socialEventPendingCount = 0;
                $socialEventRejectedCount = 0;

                $courseCompletedCount = 0;
       
               //dd($learnerList);
               foreach ($learnerList as $agentLearners) {
                //dd($agentLearners);
               // echo $agentLearners['item']['primary_phone_number'];
                if(checkYhubPhoneExists($agentLearners['item']['primary_phone_number'])){
                   $courseCompletedCount++;
                }
    
                if (empty($agentLearners)) {
                    continue;
                }
                    $learner = $agentLearners;
                    // ✅ Job Event Count
                    if (
                        isset($learner['job_event']['is_job_event']) && $learner['job_event']['is_job_event'] === true && $learner['job_event']['is_submitted']!= "" 
                    ) {
                        $jobEventCount++;
                        // ✅ Accepted Job Event Count
                        if (isset($learner['job_event']['review_status']) && $learner['job_event']['review_status'] === 'Accepted') {
                             $jobEventAcceptedCount++; 
                        }
                        if (
                            isset($learner['job_event']['review_status']) &&
                            $learner['job_event']['review_status'] == 'Open' &&
                             $learner['job_event']['is_submitted']!= ''
                        ) {
                            $jobEventSubmittedCount++; 
                        }
                        if (
                            isset($learner['job_event']['review_status']) &&
                            $learner['job_event']['review_status'] === 'Pending' &&
                            $learner['job_event']['is_submitted']!= ''
                        ) {
                            $jobEventPendingCount++;
                        }

                        if (
                            isset($learner['job_event']['review_status']) &&
                            $learner['job_event']['review_status'] === '' &&
                            $learner['job_event']['is_submitted']!= ''
                        ) {
                            $jobEventOpenCount++;
                        }

                        if (
                            isset($learner['job_event']['review_status']) &&
                            $learner['job_event']['review_status'] === 'Rejected' &&
                            $learner['job_event']['is_submitted']!= ''
                        ) {
                            $jobEventRejectedCount++;
                        }
                    }
            
                    // ✅ Social Protection Event Count
                    if (
                        isset($learner['social_protection']['is_social_event']) &&
                        $learner['social_protection']['is_social_event'] === true
                    ) {
                        $socialEventCount++;
                        if (
                            isset($learner['social_protection']['review_status']) &&
                            $learner['social_protection']['review_status'] === 'Accepted'
                        ) {
                            $socialEventAcceptedCount++;
                        }
                        if (
                            isset($learner['social_protection']['review_status']) &&
                            $learner['social_protection']['review_status'] === 'Open' &&
                            $learner['social_protection']['is_submitted']!= ''
                        ) {
                            $socialEventOpenCount++;
                        }
                        if (
                            isset($learner['social_protection']['review_status']) &&
                            $learner['social_protection']['review_status'] === 'Pending' &&
                            $learner['social_protection']['is_submitted']!= ''
                        ) {
                            $socialEventPendingCount++;
                        }

                        if (
                            isset($learner['social_protection']['review_status']) &&
                            $learner['social_protection']['review_status'] === 'Rejected' &&
                            $learner['social_protection']['is_submitted']!= ''
                        ) {
                            $socialEventRejectedCount++;
                        }

                        
                        
                    }
            }

            return [
                'job_total' => $jobEventCount,
                'job_accepted' => $jobEventAcceptedCount,
                'job_open'=>$jobEventOpenCount,
                'job_submitted'=>$jobEventSubmittedCount,
                'job_pending'=>$jobEventPendingCount,
                'job_rejected'=>$jobEventRejectedCount,

                'social_total' => $socialEventCount,
                'social_accepted' => $socialEventAcceptedCount,
                'social_open'=>$socialEventOpenCount,
                'social_submitted'=>$socialSubmittedCount,
                'social_pending'=>$socialEventPendingCount,
                'social_rejected'=>$socialEventRejectedCount,
                'course_completed'=>$courseCompletedCount
            ];
        }catch(DecryptException $e){
            // Invalid encrypted string
            Log::warning("Decrypt failed for learner link: " . $e->getMessage());
            return "Invalid Agent Id";
        }
        
    }









    /**
     * Get Details of Filed Agent
     */
    public function viewFieldAgent(Request $request,$id){
        try {
            $ys_id = decryptString($id); 
        
            $agentArray = YuwaahSakhi::findOrFail($ys_id);
            $cscValue   = $agentArray->csc_id;
        
            /*
            |--------------------------------------------------------------------------
            | Base Learner Query (Reusable)
            |--------------------------------------------------------------------------
            */
           
            $baseLearnerQuery = Learner::with('courses')
                ->where('learners.status', 'Active')
                ->where('learners.UNIT_INSTITUTE', $cscValue);
        
            /* ---------------- Filters ---------------- */
            $baseLearnerQuery
                ->when($request->filled('name'), function ($q) use ($request) {
                    $q->where(function ($sub) use ($request) {
                        $sub->where('learners.first_name', 'like', "%{$request->name}%")
                            ->orWhere('learners.last_name', 'like', "%{$request->name}%");
                    });
                })
                ->when($request->filled('email'), fn ($q) =>
                    $q->where('learners.email', 'like', "%{$request->email}%")
                )
                ->when($request->filled('phone'), fn ($q) =>
                    $q->where('learners.primary_phone_number', 'like', "%{$request->phone}%")
                )
                ->when($request->filled('gender'), fn ($q) =>
                    $q->where('learners.gender', $request->gender)
                );
        
            /*
            |--------------------------------------------------------------------------
            | ✅ Completed / Verified Learners Count
            |--------------------------------------------------------------------------
            */
            $completedLearnersCount = (clone $baseLearnerQuery)
                ->join('yhub_learners as yl', function ($join) {
                    $join->on('learners.normalized_mobile', '=', 'yl.normalized_mobile')
                         ->whereNotNull('learners.normalized_mobile');
                })
                ->distinct('learners.id')
                ->count('learners.id');

            //dd($completedLearnersCount);
        
            /*
            |--------------------------------------------------------------------------
            | Latest Event Subquery
            |--------------------------------------------------------------------------
            */
            $latestEvents = DB::table('event_transactions')
                ->select('learner_id', 'updated_at as last_event_update')
                ->where('ys_id', $ys_id)
                ->orderByDesc('id');
        
            /*
            |--------------------------------------------------------------------------
            | Learner Listing Query
            |--------------------------------------------------------------------------
            */
            $learnerListArr = (clone $baseLearnerQuery)
            ->leftJoin('yhub_learners as yl', function ($join) {
                $join->on('learners.normalized_mobile', '=', 'yl.normalized_mobile');
            })
            ->leftJoinSub($latestEvents, 'et', function ($join) {
                $join->on('learners.id', '=', 'et.learner_id');
            })
            ->select([
                'learners.id',
                'learners.first_name',
                'learners.last_name',
                'learners.primary_phone_number',
                'learners.date_of_birth',
                'learners.education_level',
                'learners.UNIT_INSTITUTE',
                'learners.digital_proficiency',
                'learners.DIFFRENTLY_ABLED',
                'learners.english_knowledge',
                'learners.PROGRAM_STATE',
                'learners.PROGRAM_DISTRICT',
                // 👇 YHub (optional)
                'yl.email_address as yhub_email_address',
                'yl.completion_status',
                'learners.normalized_mobile', // ✅ add this

                // 👇 Course completed label
                DB::raw("
                    CASE 
                        WHEN yl.completion_status = 1 THEN 'Yes'
                        ELSE 'No'
                    END AS course_completed_status
                "),

                // 👇 Sort key
                DB::raw('COALESCE(et.last_event_update, learners.updated_at) as sort_updated_at')
            ])
            ->groupBy(
                'learners.id',
                'learners.normalized_mobile', // ✅ add
                'yl.email_address',
                'yl.completion_status',
                'et.last_event_update'
            )
            ->orderByDesc('sort_updated_at')
            ->paginate(2000)
            ->appends($request->query());

                //dd($learnerListArr);
        
            /*
            |--------------------------------------------------------------------------
            | Post Processing (Events Mapping)
            |--------------------------------------------------------------------------
            */
            $eventTransactionList = DB::table('event_transactions')
                ->where('ys_id', $ys_id)
                ->get();
        
            $learnerList = [];
            foreach ($learnerListArr as $item) {
                $learnerList[$item->id] = [
                    'item'              => $item,
                    'job_event'         => $this->checkIsJobEvent($eventTransactionList, $item->id),
                    'social_protection' => $this->checkEventTypeJobSocialProtection($eventTransactionList, $item->id),
                ];
            }
        
            //dd($learnerList);
            return view('placementpartner.fieldagent.learnerList', [
                'title'                    => 'All Learners',
                'data'                     => $learnerList,
                'completedLearnersCount'   => $completedLearnersCount,
                'ppid'                     => encryptString($cscValue),
                'agentArray'               => $agentArray
            ]);
        
        } catch (DecryptException $e) {
            Log::warning("Decrypt failed for learner link: " . $e->getMessage());
            return redirect()->back()->with('error', 'Invalid or expired link.');
        }
        
    }




    public function exportFiledAgents(Request $request)
    {
        ini_set('max_execution_time', 300); 
        return Excel::download(
            new PlacementPartnerExportFiledAgents($request),
            'filed_agents_' . date('Ymd_His') . '.xlsx'
        );
    }




    public function exportPartnerFliendAgentLearners(Request $request,$agent_id)
    {
        $partner = Partner::find(getUserId());
        $partnerId = $partner->partner_id;
        $ys_id = decryptString($agent_id);
        $agentArray = YuwaahSakhi::findOrFail($ys_id);
        $cscValue   = $agentArray->sakhi_id;
        return Excel::download(
            new PlacementPartnerAllLearnersOfFliedAgentExport($request, getUserId(),$agent_id),
            $partnerId.'_'.$cscValue.'_partner_all_learners_'.now()->format('Y-m-d-H-i-s-a').'.xlsx'
        );
    }





    public function allLearner(Request $request){

    $partnerPlacementId = getUserId();

    $learners = Learner::with(['courses','completedCourses','eventTransactions'])
        ->whereNotNull('normalized_mobile')

        /*
        |--------------------------------------------------------------------------
        | Partner Placement Filter
        |--------------------------------------------------------------------------
        */
        ->whereIn('UNIT_INSTITUTE', function ($query) use ($partnerPlacementId) {
            $query->select('csc_id')
                ->from('yuwaah_sakhi')
                ->where('partner_placement_user_id', $partnerPlacementId);
        })

        /*
        |--------------------------------------------------------------------------
        | Filters
        |--------------------------------------------------------------------------
        */
        ->when($request->filled('name'), function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->name . '%');
        })

        ->when($request->filled('primary_phone_number'), function ($q) use ($request) {
            $q->where('primary_phone_number', $request->primary_phone_number);
        })

        ->when($request->filled('PROGRAM_STATE'), function ($q) use ($request) {
            $q->where('PROGRAM_STATE', $request->PROGRAM_STATE);
        })

        ->when($request->filled('district'), function ($q) use ($request) {
            $q->where('PROGRAM_DISTRICT', $request->district);
        })

        ->when($request->filled('unit_institute'), function ($q) use ($request) {
            $q->where('UNIT_INSTITUTE', 'like', '%' . $request->unit_institute . '%');
        })

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        ->orderBy('first_name','asc')
        ->paginate(20)
        ->withQueryString();

        $completedLearners = DB::table('learners as l')
        ->join('yhub_learners as yl', 'l.normalized_mobile', '=', 'yl.normalized_mobile')
        ->whereIn('UNIT_INSTITUTE', function ($query) use ($partnerPlacementId) {
            $query->select('csc_id')
                ->from('yuwaah_sakhi')
                ->where('partner_placement_user_id', $partnerPlacementId);
        })
        ->whereNotNull('l.normalized_mobile')
        ->distinct('l.id')
        ->count('l.id');

        $statetdata = DB::table('yuwaah_sakhi as ys')
        ->select('ys.state')
        ->distinct()
        ->orderBy('ys.state')
        ->get();


        return view('placementpartner.learnerAllList', [
            'data' => $learners,
            'totalCompletionLearner' => $completedLearners,
            'statetdata' => $statetdata,
            'ppid'=>Crypt::encryptString($partnerPlacementId),
            'request' => $request
        ]);
       
    }



    public function exportPlacementPartnerLearners(Request $request)
    {
        $partnerPlacementId = getUserId();

        return Excel::download(
            new PlacementPartnerLearnersExport($request, $partnerPlacementId),
            'placement_partner_learners.xlsx'
        );
    }




    public function allEvents(Request $request){
        $partnerPlacementId = getUserId();
        $eventList = DB::table('event_transactions as et')
        ->leftJoin('yuwaah_sakhi as ys', 'et.ys_id', '=', 'ys.id')
        ->leftJoin('yuwaah_event_masters as em', 'em.id', '=', 'et.event_category')
        ->where('ys.partner_placement_user_id', $partnerPlacementId)
        ->where('ys.csc_id','!=','Sandbox_Testing')
        ->whereNotNull('et.review_status')
        ->whereNotNull('et.learner_id')
        ->whereNotNull('et.event_date_submitted')
        ->select('et.*', 'em.event_category','ys.csc_id','ys.sakhi_id')
        ->paginate(50);

            
        //$eventList = YuwaahEventMaster::where('status','1')->paginate(env('PAGINATION'));
        //dd($eventList);
        return view('placementpartner.event.list', [
            'data' => $eventList, // Fetch authenticated partner
        ]);
    }




    public function exportPlacementPlacementPartnerEvents(Request $request)
    {
        $partnerPlacementId = getUserId();

        return Excel::download(
            new PlacementPartnerLearnersEventExport($request, $partnerPlacementId),
            'placement_partner_learners_events.xlsx'
        );
    }
    /***********End of Controller******************** */
}
