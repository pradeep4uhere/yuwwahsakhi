<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\PartnerPlacementUserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlacementYuwaahSakhiExport;
use App\Exports\PlacementYuwaahSakhiLearnerExport;

use DB;
use Log;
use App\Models\YuwaahSakhi;
use App\Models\Learner;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;

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
                        'learners.UNIT_INSTITUTE',
                        'learners.DIFFRENTLY_ABLED',
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
                $learnerListArr = $query->paginate(100)
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

}
