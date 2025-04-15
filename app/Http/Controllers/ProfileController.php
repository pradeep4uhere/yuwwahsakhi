<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\YuwaahSakhiSetting;
use App\Models\YuwaahSakhi;
use App\Models\YuwaahSakhiLoginLog;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;
use App\Models\Opportunity;
use App\Models\Promotion;
use App\Models\Learner;
use App\Models\EventAssigned;
use App\Models\District;
use App\Models\Block;

use App\Models\OpportunitiesAssigned;
use Exception;
use Log;
use App\Models\EventTransaction;
use App\Models\YuwaahEventMaster;
use Illuminate\Support\Facades\Validator;
    



class ProfileController extends Controller
{

    public $dir = 'user';

     /**
     * Handle admin login requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
       
        // Validate the incoming login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);


        $YuwaahSakhi = YuwaahSakhi::where('email', $request->email)->first();
        //dd($YuwaahSakhi);

         // Check password
        if (!$YuwaahSakhi || !Hash::check($request->password, $YuwaahSakhi->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

         // Generate API token
         $token = $YuwaahSakhi->createToken('YuwaahSakhi API Token')->plainTextToken;
         $YuwaahSakhi->update(['remember_token' => $token]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            // Generate API token
            $YuwaahSakhi->update(['remember_token' => $token]);

            $ip = $request->ip();
            $agent = new Agent();
            $location = []; // Fetch location using GeoIP or other services
    
            YuwaahSakhiLoginLog::create([
                'user_id' => $YuwaahSakhi->id,
                'user_type' => $YuwaahSakhi->type, // Assuming users have a type (Admin, Partner, etc.)
                'ip_address' => $ip,
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'location' => json_encode($location),
                'login_time' => now(),
            ]);
    
    
            // Authentication passed, redirect to the admin dashboard
            return redirect()->intended('/dashboard');
        }

        // Authentication failed, return back with error message
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }


    
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = YuwaahSakhi::with(['State','District','Block'])->find(getUserId());
        $userDetails = YuwaahSakhi::getFormatedData( $user);
        //dd($userDetails);
        return view('user.profile', [
            'user' => $request->user(),
            'userDetails'=>$userDetails
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }



    public function welcome(Request $request){
        $YuwaahSakhiSetting = YuwaahSakhiSetting::where('id',1)->first()->toArray();
        return view('welcome',[
            'YuwaahSakhiSetting'=>$YuwaahSakhiSetting
        ]);

    }




    public function dashboard(Request $request){
        $YuwaahSakhi= YuwaahSakhi::with(['Partner','PartnerCenter'])->find(Auth::user()->id);
        $opportunitesWithPagination = Opportunity::where('status','1')->paginate();
        $opportunites = (array) Opportunity::getFormatedData($opportunitesWithPagination);
        $totalOpportunites = $opportunitesWithPagination->total();
        $allEventCount = EventTransaction::where('ys_id',getUserId())->count();
        $learnerCount = Learner::where('status','Active')->count();
        return view($this->dir.'.dashboard',[
            'opportunites'=> $opportunites,
            'learnerCount'=>$learnerCount,
            'allEventCount'=>$allEventCount,
            'totalOpportunites'=> $totalOpportunites
        ]);
    }



    public function opportunitiesDetails(Request $request, $id){
        $idString = decryptString($id);
        $opportunitesObject = Opportunity::find($idString);
        $opportunites = (array) Opportunity::getFormatedSingleData($opportunitesObject );
        //dd($opportunites);
        //Other Oppotunites List
        $opportunitesWithPagination = Opportunity::where('status','1')->paginate();
        $opportunitesList = (array) Opportunity::getFormatedData($opportunitesWithPagination);
        return view($this->dir.'.opportunites_details',[
            'opportunites'=> $opportunites,
            'opportunitesList'=>$opportunitesList
        ]);
    }

    public function  opportunitiesList(Request $request){
        $filter = $request->query('filter', 'desc'); // default to 'desc'
        $orderBy = $request->query('order_by', 'id'); // default to 'id'
        $opportunitesWithPagination = Opportunity::where('status','1')
        ->where('sakhi_id',getUserId())
        ->orderBy($orderBy, $filter)
        ->paginate();
        $opportunitesList = (array) Opportunity::getFormatedData($opportunitesWithPagination);
        return view($this->dir.'.opportunites_page',[
            'opportunitesList'=>$opportunitesList
        ]);
    }


    public function addNewOpportunities(Request $request){
        return view($this->dir.'.add_new_opportunities');
    }






    public function PromotionList(Request $request){
        $promotionList = Promotion::where('status','1')->paginate();
        //dd($promotionList);
        return view($this->dir.'.promotion_page',[
            'promotionList'=>$promotionList
        ]);
    }



    public function LearnerList(Request $request){
        $learnerList = [];
        $learnerList = Learner::where('status','Active')->paginate();
        //dd( $learnerList);
        return view($this->dir.'.learner_page',[
            'leanerList'=>$learnerList
        ]);
    }




    public function learnerDetails(Request $request, $id){
        $idStirng = decryptString($id);
        $learnerDetails = Learner::find($idStirng);
        $opportunitesWithPagination = Opportunity::where('status','1')->where('sakhi_id',getUserId())->paginate();
        $opportunitesList = (array) Opportunity::getFormatedData($opportunitesWithPagination);
        //dd($learnerDetails);
        //Find all open opportunites
        $openOpportuniescount = Opportunity::where('sakhi_id',getUserId())->where('end_date','>',now())->count();
        return view($this->dir.'.learner_details_page',[
            'openOpportunites'=>$openOpportuniescount,
            'learnerDetails'=>$learnerDetails,
            'opportunitesList'=>$opportunitesList
        ]);
    }



    public function saveOpportunities(Request $request){
        $opportunities = [];
        $error =  $request->validate([
            'opportunity_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'opportunity_type' => 'required|string|max:255',
            'payout_monthly'=>'required|integer',
            'document.*' => 'file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ]);

        
        $uploadedPaths = [];

        // Handle multiple file uploads
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $file) {
                $path = $file->store('uploads/opportunities', 'public'); // store in storage/app/public/uploads/opportunities
                $uploadedPaths[] = $path;
            }
        }

        try {
            // Create Opportunity record
            Opportunity::create([
                'opportunities_title' => $request->input('opportunity_name'),
                'description' => $request->input('description'),
                'payout_monthly'=>$request->input('payout_monthly'),
                'start_date'=>$request->input('start_date'),
                'end_date'=>$request->input('end_date'),
                'number_of_openings'=>$request->input('number_of_openings'),
                'provider_name'=>'NA',
                'document' => json_encode($uploadedPaths),
                'sakhi_id'=>Auth::user()->id
                // Add other fields if needed
            ]);
            return redirect()->back()->with('success', 'Opportunity created successfully.');

        
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error('Failed to create opportunity: ' . $e->getMessage());
            return back()->with('error', 'Opportunity not created!'.$e->getMessage());
        }

    
    }




    public function AssignLearnerOpportunities(Request $request,$id){
        $idStirng = decryptString($id);
        $opportunities = Opportunity::find($idStirng);
        $learnerList = [];
        $learnerList = Learner::with(['OpportunitiesAssigned'])->where('status','Active')->paginate();
        $learnerIdArr = OpportunitiesAssigned::where('opportunites_id', $idStirng)
        ->where('yuwah_sakhi_id', getUserId())
        ->pluck('learner_id');
        return view($this->dir.'.learner_to_opportunites',[
            'item'=>$opportunities,
            'leanerList'=>$learnerList,
            'ysid'=>encryptString(getUserId()),
            'opid'=>$id,
            'learnerIdArr'=>$learnerIdArr
        ]);
    }




    public function assignLearners(Request $request)
    {
        $learnerIds = $request->input('learner');
        $opportunity_id = decryptString($request->input('opid'));
        $yuwah_sakhi_id = decryptString($request->input('ysid'));

        // First, decrypt all selected learner IDs
        $selectedLearnerIds = array_map('decryptString', $learnerIds);
        // Step 1: Remove unchecked learners
        OpportunitiesAssigned::where('opportunites_id', $opportunity_id)
        ->where('yuwah_sakhi_id', $yuwah_sakhi_id)
        ->whereNotIn('learner_id', $selectedLearnerIds)
        ->delete();

        foreach($learnerIds as $idString){
            $id = decryptString($idString);
            OpportunitiesAssigned::updateOrCreate(
                [
                    'opportunites_id' => $opportunity_id,
                    'yuwah_sakhi_id' => $yuwah_sakhi_id,
                    'learner_id' => $id
                ],
                [
                    'assigned_date' => now()
                ]
            );
        }
        return response()->json(['data'=> count($learnerIds) ,'success' => true,'message'=>'Learner assigned successfully.']);
    }










    /**
     * Handle the "Forgot Password" request.
     *
     * This method receives mobile number from the user, verifies its existence,
     * and initiates the password reset process by sending a reset link or token.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request){
        $email = $request->input('email');
    }



    /**
     * Display the view for adding new opportunities.
     *
     * This method returns the view associated with creating or adding
     * new opportunity records, typically used to show the form UI.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function eventTransactionList(Request $request){
        $eventList = YuwaahEventMaster::where('status',1)->get();
        
        //All Event Transction Count
        $allEventCount = EventTransaction::where('ys_id',getUserId())->count();
       
        return view($this->dir.'.add_event',[
            'eventList' => $eventList,
            'allEventCount'=>$allEventCount 
        ]);
    }






    public function storeEventTransaction(Request $request)
    {
        // Validate request input
        $validator = Validator::make($request->all(), [
            'beneficiary_phone_number' => 'required|string|max:15',
            'beneficiary_name'         => 'required|string|max:255',
            'event_type'               => 'required|string|max:255',
            'event_category'           => 'required|string|max:255',
            'event_value'              => 'required|numeric|min:0',
            'sakhi_id'                 => 'required|string|max:50',
            'comment'                  => 'nullable|string|max:1000',
            'uploaded_doc_links'       => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the highlighted errors.');
        }
    
        try {
            $uploadedPath = null;
    
            // Handle file upload
            if ($request->hasFile('uploaded_doc_links')) {
                $uploadedPath = $request->file('uploaded_doc_links')->store('uploads/eventtransaction', 'public');
            }
            //dd($uploadedPath);
            EventTransaction::create([
                'beneficiary_phone_number' => $request->input('beneficiary_phone_number'),
                'beneficiary_name'         => $request->input('beneficiary_name'),
                'event_id'                 => $request->input('event_type'),
                'event_type'               => $request->input('event_type'),
                'event_category'           => $request->input('event_category'),
                'event_value'              => $request->input('event_value'),
                'ys_id'                    => getUserId(),
                'comment'                  => $request->input('comment'),
                'uploaded_doc_links'       => $uploadedPath,
                'event_date_created'       => now(),
                'event_date_submitted'     => now(), // Assuming submission is same as creation
            ]);
    
            return redirect()->back()
                ->with('success', 'Event transaction saved successfully!');
        } catch (\Exception $e) {
            \Log::error('Event transaction save error: '.$e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to save event transaction. Please try again.');
        }
    }
    




    /**
     * Fetch event categories based on selected event type.
     *
     * This method handles an AJAX POST request to dynamically retrieve
     * event categories related to the selected event type.
     * It's typically triggered when a user changes the event type in a dropdown,
     * allowing the form to update the category options without a full page reload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchEventCategories(Request $request)
    {
        $eventTypeId = $request->input('event_type');
        // Fetch categories related to this event type
        $categories = YuwaahEventMaster::find($eventTypeId);
        $responseData = array(
            'status'=>true,
            'category_name'=>$categories['event_category']
        );
        return response()->json($responseData);
    }





    /**
     * All event transactions for a user.
     */
    public function allEventTransactionList(Request $request){
        $eventList = [];
        $allEventCount= "";
        $filter = $request->query('filter', 'desc'); // default to 'desc'
        $orderBy = $request->query('order_by', 'id'); // default to 'id'
        $eventList = EventTransaction::With('Event')
        ->where('ys_id',getUserId())
        ->orderBy($orderBy, $filter)
        ->paginate();
        //dd($eventList);
        return view($this->dir.'.all_event_transaction_list',[
            'eventList' => $eventList,
            'allEventCount'=>$allEventCount 
        ]);
    }

   




    public function assignLearnersIntoEvent(Request $request,$id){
        $idStirng = decryptString($id);
        $opportunities = EventTransaction::find($idStirng);
        $learnerList = [];
        $learnerList = Learner::with(['EventAssigned'])->where('status','Active')->paginate();
        $learnerIdArr = EventAssigned::where('event_id', $idStirng)
        ->where('yuwah_sakhi_id', getUserId())
        ->pluck('learner_id');
        //dd($learnerList);
        return view($this->dir.'.learner_to_event',[
            'item'=>$opportunities,
            'leanerList'=>$learnerList,
            'ysid'=>encryptString(getUserId()),
            'opid'=>$id,
            'type'=>'event',
            'learnerIdArr'=>$learnerIdArr
        ]);
    }




    public function saveAssignLearnersIntoEvent(Request $request)
    {
        $learnerIds = $request->input('learner');
        $event_id = decryptString($request->input('opid'));
        $yuwah_sakhi_id = decryptString($request->input('ysid'));

        // First, decrypt all selected learner IDs
        $selectedLearnerIds = array_map('decryptString', $learnerIds);
        // Step 1: Remove unchecked learners
        EventAssigned::where('event_id', $event_id)
        ->where('yuwah_sakhi_id', $yuwah_sakhi_id)
        ->whereNotIn('learner_id', $selectedLearnerIds)
        ->delete();

        foreach($learnerIds as $idString){
            $id = decryptString($idString);
            EventAssigned::updateOrCreate(
                [
                    'event_id' => $event_id,
                    'yuwah_sakhi_id' => $yuwah_sakhi_id,
                    'learner_id' => $id
                ],
                [
                    'assigned_date' => now()
                ]
            );
        }
        return response()->json(['data'=> count($learnerIds) ,'success' => true,'message'=>'Learner assigned successfully.']);
    }






    /**
     * Page Terms and Conditons
     */
    public function PageTermsAndConditions(Request $request){
        //$page = Page::where('page','termsconditions')->first();
        $page = 'As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
';
        $pageTitle = 'Terms and Conditions';
        return view('terms-and-conditions',[
            'page'=>$page,
            'pageTitle'=>$pageTitle
        ]);
    }


    public function PageUnicefYuthHub(Request $request){
        //$page = Page::where('page','termsconditions')->first();
        $page = 'As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                ';
        $pageTitle = 'Unicef Yuth Hub';
        return view('unicefyuthhub',[
            'page'=>$page,
            'pageTitle'=>$pageTitle
        ]);
    }




    public function AboutYuwaah(Request $request){
        //$page = Page::where('page','termsconditions')->first();
        $page = 'As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                As a catalytic multi-stakeholder partnership, YuWaah is dedicated to transforming the lives of 350 million+ young people in India. With 40% of India’s population being youth, the largest in the world, the time for change is now!
                ';
        $pageTitle = 'About Yuwaah';
        return view('aboutyuwaah',[
            'page'=>$page,
            'pageTitle'=>$pageTitle
        ]);
    }




    public function profileEdit(Request $request){
        $pageTitle = 'Edit Profile';
        $user = YuwaahSakhi::getFormatedData(Auth::user());
        return view('user.editProfile',[
            'userDetails'=>$user,
            'pageTitle'=>$pageTitle
        ]);
    }


    public function getDistrictDropdown(Request $request)
    {
        $stateId = $request->state_id;
    
        // Call your helper function
        $class = "mt-2 text-xs w-full border px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 placeholder:font-[400] placeholder:text-[10px] placeholder:leading-[12.19px] placeholder:text-[#A7A7A7]";
        $dropdownHtml = getDistrict($stateId,'district_id','',$class);
    
        // Return it as JSON or plain text depending on usage
        return response()->json([
            'html' => $dropdownHtml
        ]);
    }


    public function getBlocksByDistrict(Request $request)
    {
        $districtId = $request->district_id;
        // Call your helper function
        $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500";
        if (!$districtId) {
            return response()->json(['html' => "<select name='block_id' class='form-control' id='block_id'><option value=''>Select District First</option></select>"]);
        }

        $html = getBlock($districtId,'block_id','',$class);

        return response()->json(['html' => $html]);
    }
    


    public function  saveEditProfile(Request $request){
        // Validate request (basic example; customize as needed)
        $request->validate([
            'name' => 'required|string',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'district_id' => 'required|exists:districts,id',
            'pincode' => 'required|string|max:10',
            'education_level' => 'nullable|string',
            'digita_proficiency' => 'nullable|string',
            'englis_proficiency' => 'nullable|string',
            'year_of_exp' => 'nullable|numeric',
            'WorkHourInDay' => 'nullable|numeric',
            'InfrastructureAvailable' => 'nullable|string',
            'ServiceOffered' => 'nullable|string',
            'CoursesCompleted' => 'nullable|in:Yes,No',
            'LoanTaken' => 'nullable|in:Yes,No',
            'loantype' => 'nullable|string',
            'LoanAmount' => 'nullable|numeric',
            'LoanBalance' => 'nullable|numeric',
            'profile_picture' => 'nullable|image|max:2048',
            'specific_qualification'=>'nullable|string',
        ]);

         // Optional custom messages
        $messages = [
            'date_of_birth.required' => 'Date of birth is required.',
            'email.email' => 'Please enter a valid email address.',
            'state_id.required' => 'Please select a state.',
            'district_id.required' => 'Please select a district.',
            'profile_picture.image' => 'Only image files are allowed for profile picture.',
        ];
        // Fetch the profile
        $id = Auth::user()->id;
        $profile = YuwaahSakhi::findOrFail($id);
        // Update basic fields
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->dob = $request->date_of_birth;
        $profile->year_of_exp = $request->year_of_exp;
        $profile->gender = $request->gender;
        $profile->work_hour_in_day = $request->WorkHourInDay;
        $profile->education_level = $request->education_level;
        $profile->infrastructure_available = $request->InfrastructureAvailable;
        $profile->specific_qualification = $request->specific_qualification;
        $profile->service_offered = $request->ServiceOffered;
        $profile->loan_taken = $request->LoanTaken;
        $profile->courses_completed = $request->CoursesCompleted;
        $profile->type_of_loan = $request->loantype;
        $profile->digital_proficiency = $request->digita_proficiency;
        $profile->english_proficiency = $request->english_proficiency;
        $profile->loan_amount = $request->LoanAmount;
        $profile->loan_balance = $request->LoanBalance;
        $profile->address = $request->address;
        $profile->state = $request->state_id;
        $profile->district = $request->district_id;
        $profile->block_id = $request->block_id;
        $profile->pincode = $request->pincode;
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            // Optional: delete old profile picture
            if ($profile->profile_picture && Storage::exists($profile->profile_picture)) {
                Storage::delete($profile->profile_picture);
            }
            // Save new image
            $path = $file->store('uploads/profile_pictures', 'public');
            $profile->profile_picture =  $path;
        }
        // Save profile
        $profile->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');

    }



}
