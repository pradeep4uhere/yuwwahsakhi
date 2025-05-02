<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\PartnerProfileUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\PartnerCenter;
use App\Models\Opportunity;
use App\Models\Pathway;
use App\Models\Promotion;
use App\Models\YuwaahSakhi;
use App\Models\YuwaahEventMaster;
use App\Models\State;
use App\Models\Learner;

use Illuminate\Support\Facades\Validator;
use App\Exports\PartnersExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Carbon\Carbon;





class PartnerController extends Controller
{

    public $dir = 'partner';

    // Method to get monthly counts for YuwwahSakhi based on a date range
    public function yuwwahSakhiMonthly($start, $end)
    {
        // Example query using these dates for YuwwahSakhi
        $yuwwahSakhiMonthly = YuwaahSakhi::whereBetween('created_at', [$start, $end])
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        // Check if no records were found
        if ($yuwwahSakhiMonthly->isEmpty()) {
            // No records found, return default monthly counts (12 months, all 0)
            return collect(range(1, 12))->mapWithKeys(function ($month) {
                return [
                    $month => array_fill(0, 12, 0)  // Default to 0 for all months
                ];
            });
        } else {
            // Fill missing months with 0
            return collect(range(1, 12))->mapWithKeys(function ($month) use ($yuwwahSakhiMonthly) {
                return [
                    $month => $yuwwahSakhiMonthly->get($month, 0) // Default 0 if month not present
                ];
            });
        }
    }

    // Method to get monthly counts based on a date range
    public function partnerCenterMonthly($start, $end)
    {
        // Example query using these dates
        $partnerCenterMonthly = PartnerCenter::where('partner_id',getUserId())
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');

        // Check if no records were found
        if ($partnerCenterMonthly->isEmpty()) {
            // No records found, return default monthly counts (12 months, all 0)
            return collect(range(1, 12))->mapWithKeys(function ($month) {
                return [
                    $month => array_fill(0, 12, 0)  // Default to 0 for all months
                ];
            });
        } else {
            // Fill missing months with 0
            return collect(range(1, 12))->mapWithKeys(function ($month) use ($partnerCenterMonthly) {
                return [
                    $month => $partnerCenterMonthly->get($month, 0) // Default 0 if month not present
                ];
            });
        }
    }


     // Method to get monthly counts for opportunitiesMonthly based on a date range
     public function opportunitiesMonthly($start, $end, $sakhiIds)
     {
         $yuwaahSakhiMonthly = Opportunity::whereBetween('created_at', [$start, $end])
             ->whereIn('sakhi_id', $sakhiIds)
             ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
             ->groupBy('month')
             ->pluck('count', 'month');
     
         // Always return 12 months data (even if no records)
         return collect(range(1, 12))->mapWithKeys(function ($month) use ($yuwaahSakhiMonthly) {
             return [
                 $month => $yuwaahSakhiMonthly->get($month, 0) // Default to 0 if no data
             ];
         });
     }

    /**
     * Display the user's profile form.
     */
    public function dashboard(Request $request)
    {
        $labels = [];
        if ($request->query('start_date') != '') {
            // Use provided start and end dates from the query
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');
        } else {
            // Set default to the last 12 months
            $endDate = Carbon::now(); // Current date
            $startDate = Carbon::now()->subMonths(12); // 12 months ago
            $today = Carbon::now();
            for ($i = 11; $i >= 0; $i--) {
                $date = $today->copy()->subMonths($i);
                $labels[] = $date->format("M[Y]"); // This gives you strings like Apr['24']
            }
        }

        // Optional: Convert to Carbon for date manipulation
        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate)->endOfDay();
        $partnerCenterMonthly = $this->partnerCenterMonthly($start,$end);
        //dd($partnerCenterMonthly);
        $totalPartnerCenter = PartnerCenter::where('partner_id',getUserId())->count();

        //Yuwwash Sakhi
        $monthlyYuwwahSakhiCounts = $this->yuwwahSakhiMonthly($start, $end);
        $totalYuwwahSakhi = YuwaahSakhi::where('partner_id',getUserId())->count();
        
        // Step 1: Get all YuwaahSakhi IDs for the current partner
        $totalYuwaahSakhiIds = YuwaahSakhi::where('partner_id', getUserId())->pluck('id');
        // Step 2: Count Opportunities where sakhi_id is in the above IDs
        $opportunitiesVerified = Opportunity::whereIn('sakhi_id', $totalYuwaahSakhiIds)->count();
       
        $monthlyopportunitiesCounts = $this->opportunitiesMonthly($start, $end, $totalYuwaahSakhiIds);
        $chartsData = [
            'partnerCenter' => array_values($partnerCenterMonthly->toArray()),
            'yuwaahChart' => array_values($monthlyYuwwahSakhiCounts->toArray()),
            'youthRegistered' => array_values($monthlyopportunitiesCounts->toArray()),
            'coursesCompleted' => array_values($monthlyopportunitiesCounts->toArray()),
            'opportunitiesVerified' => array_values($monthlyopportunitiesCounts->toArray()),
        ];
        //dd($chartsData);
      
        // Compute maxY values dynamically and attach to the array
        foreach ($chartsData as $key => $values) {
            //dd(max($values));
              // Ensure $values is a flat array
            if (!is_array($values) || !count($values)) {
                $chartsData[$key . 'MaxY'] = 15;
                continue;
            }

             // Flatten if it's a multidimensional array (just in case)
            $flatValues = array_map('intval', $values);
            $max = max($flatValues);

            if ($max > 0) {
                $chartsData[$key . 'MaxY'] = ceil($max / 5) * 5 + 15;
            } else {
                $chartsData[$key . 'MaxY'] = 15;
            }

        }

        $totalCount = array();
        $totalCount['totalPartnerCenter'] = $totalPartnerCenter;
        $totalCount['totalYuwaahSakhi'] = $totalYuwwahSakhi;
        $totalCount['totalOpportunities'] = $opportunitiesVerified;
        $states = State::all(); // Fetch state data (


        $learnerAgeGroup = Learner::getLearnerAgeGroup();
        $learnerGenderGroup = Learner::getGenderCount();
        

        return view('partner.dashboard', [
            'title' => 'Dashboard',
            'chartsData'=>$chartsData,
            'totalCount'=>$totalCount,
            'labels'=>$labels,
            'states'=>$states,
            'learnerAgeGroup'=>$learnerAgeGroup,
            'learnerGenderGroup'=>$learnerGenderGroup
        ]);
    }


     /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view($this->dir.'.profile.edit', [
            'user' => Auth::guard('partner')->user(), // Fetch authenticated partner
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(PartnerProfileUpdateRequest $request): RedirectResponse
    {
        $partner = Auth::guard('partner')->user(); // Fetch the logged-in partner
        $partner->fill($request->validated());
    
        if ($partner->isDirty('email')) {
            $partner->email_verified_at = null;
        }
    
        $partner->save();
    
        return Redirect::route($this->dir.'.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $partner = Auth::guard('partner')->user(); // Fetch authenticated partner

        Auth::guard('partner')->logout();

        $partner->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    /**
     * Update the user's password.
     */
    public function updatePassowrd(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);
        $partner = Auth::guard('partner')->user();
        $partner->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }




    /**
     * Get All Promotional List
     */
    public function getAllPromotionalList(Request $request){
        $promotionalList = Promotion::paginate();
        $fotmatedPromotionalList = Promotion::getFormatedPaginationData($promotionalList);
        //dd($fotmatedPromotionalList);
        return view($this->dir.'.promotion.list', [
            'data' => $fotmatedPromotionalList, // Fetch authenticated partner
        ]);
    }




    /**
     * Get All Partner Center
     */
    public function getAllPartnerCenterList(Request $request){
        $partnerCenters = PartnerCenter::withCount('YuwwahSakhi')->paginate();
        $fotmatedPartnerCenterlList = PartnerCenter::getFormatedPaginationData($partnerCenters);
        //dd($fotmatedPartnerCenterlList);
        return view($this->dir.'.partnercenter.list', [
            'data' => $fotmatedPartnerCenterlList, // Fetch authenticated partner
        ]);
    }
   


    /**
     * Get All lOpportunites List
     */
    public function getAllOpportunitesList(Request $request){
        $opportunity = Opportunity::paginate();
        $fotmatedopportunityList = Opportunity::getFormatedPaginationData($opportunity);
        //dd($fotmatedPartnerCenterlList);
        return view($this->dir.'.opportunity.list', [
            'data' => $fotmatedopportunityList, // Fetch authenticated partner
        ]);
    }



    /**
     * Opportunites Details
     */
    public function getOpportunitesDetails(Request $request, $id){
        $id = decryptString($id);
        $opportunity = Opportunity::find($id);
        return view($this->dir.'.opportunity.dertails', [
            'data' => Opportunity::getFormatedSingleData($opportunity), // Fetch authenticated partner
        ]);
    }




    /**
     * Update the Partner Center
     */
    public function udatePartnerCenterDetails(Request $request, $id){
        $partnerCenter = PartnerCenter::find($id);

        //dd($partnerCenter);
        return view($this->dir.'.partnercenter.editdetails', [
            'data' => PartnerCenter::getFormatedSingleData($partnerCenter), // Fetch authenticated partner
        ]);
    }


     /**
     * Update the Partner Center
     */
    public function udatePartnerCenterAction(Request $request)
    {
        try {
            // Decrypt ID from request
            $id = decryptString($request->get('id'));
    
            // Validate request data
            $validator = Validator::make($request->all(), [
                'center_name' => 'required|string|max:255',
                'email' => 'required|email|unique:partner_centers,email,' . $id,
                'contact_number' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:255',
                'status' => 'required|boolean',
            ]);
    
            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect()->route('partner.partnercenter.edit', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Find the partner center
            $partner = PartnerCenter::find($id);
    
            if (!$partner) {
                return redirect()->route('partner.partnercenter.edit', ['id' => $id])
                    ->with('error', __('messages.partner_center_not_found'))
                    ->withInput();
            }
    
            // Update partner center details
            $partner->update([
                'center_name' => $request->center_name,
                'partner_id' => Auth::guard('partner')->user()->id,                
                'email' => $request->email,
                'contact_number' => $request->contact_number,
                'address' => $request->address,
                'status' => $request->status,
            ]); 
    
            // Return success response
            return redirect()->route('partner.partnercenter.edit', ['id' => $id])
                ->with('success', __('messages.profile_updated'));
    
        } catch (\Exception $e) {
            return redirect()->route('partner.partnercenter.edit', ['id' => $id])
                ->with('error', __('messages.profile_not_updated'))
                ->withInput();
        }
    }







    /**
     * All Event List
     */
    public function eventList(Request $request){
        $eventList = YuwaahEventMaster::where('status','1')->paginate(env('PAGINATION'));
        //dd($eventList);
        return view($this->dir.'.event.list', [
            'data' => $eventList, // Fetch authenticated partner
        ]);

    }




    /**
     * All Associated Yuwaah Sakhi With Partner Center
     */
    public function viewAssociatedYuwaahSakhi(Request $request, $id){
        $id = decryptString($id);
        $partnerCenterDetails = PartnerCenter::with('YuwwahSakhi')->find($id);
        $yuwaahSakhiList = YuwaahSakhi::where('partner_center_id',$id)->paginate();
       // dd($yuwaahSakhiList);
        return view($this->dir.'.partnercenter.associated_yuwaahsakhi', [
            'partnerCenterDetails' => $partnerCenterDetails, // Fetch authenticated partner
            'data'=>$yuwaahSakhiList
        ]);
    }




    public function exportPartners()
    {
        return Excel::download(new PartnersExport, 'partners.csv');
    }


    public function logout(Request $request)
    {
        auth('partner')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('partner.login')->with('success', 'Logged out successfully.');
    }


    public function settingProfile(Request $request){
        $partner = Auth::user();
       
        return view($this->dir.'.setting', [
            'partner' => $partner, // Fetch authenticated partner
        ]);
    }




    public function promotionalDetails(Request $request,$id){
        $idVal = decryptString($id);
        $promotionDetails = Promotion::find($idVal);
        return view($this->dir.'.promotion.details', [
            'promotionDetails' => $promotionDetails, // Fetch authenticated partner
        ]);
    }
    



}
