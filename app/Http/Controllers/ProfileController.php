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
use App\Models\MobileOtp;
use App\Models\OpportunitiesAssigned;
use Exception;
use Log;
use App\Models\EventTransaction;
use App\Models\YuwaahEventMaster;
use App\Models\YuwaahEventType;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;
    



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
       //dd($request->all());
        // Validate the incoming login data
        $request->validate([
            'email' => ['required', 'string', 'min:3'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $YuwaahSakhi = YuwaahSakhi::where('sakhi_id', $request->email)->where('status',1)->first();
        //dd($YuwaahSakhi);
        if (!$YuwaahSakhi) {
            throw ValidationException::withMessages([
                'email' => ['Account is not active, Please contact to admin.'],
            ]);
        }

         // Check password
        if (!$YuwaahSakhi || !Hash::check($request->password, $YuwaahSakhi->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

         // Generate API token
         $token = $YuwaahSakhi->createToken('YuwaahSakhi API Token')->plainTextToken;
         $YuwaahSakhi->update(['remember_token' => $token]);

        $credentials = $request->only('sakhi_id', 'password');
        //dd($credentials);
        if (Auth::guard('web')->login($YuwaahSakhi)) {
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
        $allsubmittedEventCount = EventTransaction::where('ys_id',getUserId())->where('event_date_submitted','<>',NULL)->count();
        $learnerCount = Learner::where('status','Active')->count();
        return view($this->dir.'.dashboard',[
            'opportunites'=> $opportunites,
            'learnerCount'=>$learnerCount,
            'allEventCount'=>$allEventCount,
            'allsubmittedEventCount'=>$allsubmittedEventCount,
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
        ->whereOr('sakhi_id',null)
        ->whereOr('sakhi_id',getUserId())
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



    public function LearnerList(Request $request)
    {
        $query = Learner::where('status', 'Active');
        //dd($request->all());
        // Apply filters only if it's a POST or if filters are present in GET
        $filters = $request->only([
            'name',
            'phone',
            'email',
        ]);

        if (!empty($filters)) {
           
            // Base query with join on phone number (stripped of "+91 ")
                $query = Learner::where('learners.status', 'Active')
                ->leftJoin('yhub_learners', function ($join) {
                    $join->on('learners.primary_phone_number', '=', DB::raw("REPLACE(yhub_learners.email_address, '+91 ', '')"));
                })
                ->select(['learners.*',
                'yhub_learners.email_address as yhub_email_address',
                'yhub_learners.completion_status as completion_status'
                ]); // Ensure we select only learner fields

            // Apply filters
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
                $query->where('gender', $request->gender);
            }

           
        }

    // Paginate with query string to preserve filters in pagination
    $learnerList = $query->with('eventTransactions')->paginate(20)->appends($request->query());
    //dd($learnerList);

    $eventTypeId = DB::table('yuwaah_event_type')
    ->whereRaw('LOWER(name) = ?', ['job'])
    ->value('id');

    //dd($eventTypeId );

    return view($this->dir . '.learner_page', [
        'leanerList' => $learnerList,
        'jobEventId'=> $eventTypeId
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




    public function AssignLearnerOpportunities(Request $request, $id)
    {
        $idStirng = decryptString($id);
        $opportunities = Opportunity::find($idStirng);

        $query = Learner::with(['OpportunitiesAssigned'])
            ->where('status', 'Active');

        // Extract filters
        $filters = $request->only([
            'name',
            'age',
            'end_age',
            'gender',
            'education_level',
            'digital_proficiency',
            'english_knowledge',
            'mobility_level',
            'engaged_earning'
        ]);

        // Apply filters
        if (!empty($filters)) {
            if (!empty($filters['name'])) {
                $query->where('first_name', 'like', '%' . $filters['name'] . '%');
            }

            if (!empty($filters['age']) || !empty($filters['end_age'])) {
                $startAge = $filters['age'] ?? 0;
                $endAge = $filters['end_age'] ?? 100;

                $fromDate = now()->subYears($endAge)->startOfDay();
                $toDate = now()->subYears($startAge)->endOfDay();

                $query->whereBetween('date_of_birth', [$fromDate, $toDate]);
            }

            if (!empty($filters['gender'])) {
                $query->where('gender', $filters['gender']);
            }

            if (!empty($filters['education_level'])) {
                $query->where('education_level', $filters['education_level']);
            }

            if (!empty($filters['digital_proficiency'])) {
                $query->where('digital_proficiency', $filters['digital_proficiency']);
            }

            if (!empty($filters['english_knowledge'])) {
                $query->where('english_knowledge', $filters['english_knowledge']);
            }

            if (!empty($filters['mobility_level'])) {
                $query->where('mobility_level', $filters['mobility_level']);
            }

            if (!empty($filters['engaged_earning'])) {
                $query->where('engaged_earning', $filters['engaged_earning']);
            }
        }

        $learnerList = $query->paginate(10)->appends($filters);

        $learnerIdArr = OpportunitiesAssigned::where('opportunites_id', $idStirng)
            ->where('yuwah_sakhi_id', getUserId())
            ->pluck('learner_id');

        return view($this->dir . '.learner_to_opportunites', [
            'item' => $opportunities,
            'leanerList' => $learnerList,
            'ysid' => encryptString(getUserId()),
            'opid' => $id,
            'learnerIdArr' => $learnerIdArr
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
        $eventList = YuwaahEventType::where('status',1)->get();
        //$learnerList = Learner::where('status',1)->get();
        //dd($learnerList);
        //dd($eventList);
        //All Event Transction Count
        $allEventCount = EventTransaction::where('ys_id',getUserId())->count();
        $eventList = YuwaahEventType::all();
        $eventCategoryList = [];

        if (old('event_type')) {
            $eventCategoryList = YuwaahEventMaster::where('event_type_id', old('event_type'))->get();
            //dd($eventCategoryList);
        }   
        
        return view($this->dir.'.add_event',[
            'eventList' => $eventList,
            'allEventCount'=>$allEventCount,
            'eventCategoryList'=>$eventCategoryList 
        ]);
    }


    public function getEventCategoryDocuments(Request $request)
    {
        $eventTypeId = $request->input('event_type_id');
        $documents = YuwaahEventMaster::find($eventTypeId);
        $category = explode(',',$documents['event_category']);
        $documentsArr = [
            'document' =>  [
                'doc_1'=> $documents['document_1'],
                'doc_2'=> $documents['document_2'],
                'doc_3'=> $documents['document_3']
            ],
        ];
        return response()->json($documentsArr);
    }


    public function getEventDocuments(Request $request)
    {
        $eventTypeId = $request->input('event_type_id');
        $categoryList = YuwaahEventMaster::where('event_type_id',$eventTypeId)->get();
        foreach($categoryList as $item){
            $categoryArr[$item['id']] = $item['event_category'];    
        }
        $documentsArr = [
            'document' =>  [],
            'category'=>$categoryArr
        ];
        return response()->json($documentsArr);
    }







    public function storeEventTransaction(Request $request)
    {
      // Step 1: Detect document fields
            // OR safer way: merge input + files
           // Get all keys that start with document_doc_
           $documentFields = $request->input('document_fields', []);
       
            //dd($documentFields);
            // Step 2: Base rules
            $rules = [
            'event_type'               => 'required|string|max:255',
            'event_category'           => 'required|string|max:255',
            'event_value'              => 'required|numeric|min:0',
            'beneficiary_phone_number' => 'required|string|max:15',
            'beneficiary_name'         => 'required|string|max:255',
            'comment'                  => 'nullable|string|max:1000',
            'document_type'            => 'nullable|string|max:1000',
            ];

            // Step 3: Add document rules
            foreach ($documentFields as $field) {
            $others = array_diff($documentFields, [$field]);
            $rules[$field] = 'required_without_all:' . implode(',', $others) 
                        . '|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048';
            }

            // Step 4: Custom messages
            $messages = [];
            foreach ($documentFields as $field) {
            $messages["$field.required_without_all"] = 'Please upload at least one document.';
            }

            // Step 5: Validate
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the highlighted errors.');
            }
        try {
            $uploadedPaths = [];
            //dd($request->allFiles());
              // Loop through request inputs and find any file inputs that start with 'document_doc_'
            foreach ($request->allFiles() as $key => $file) {
                if (Str::startsWith($key, 'document_doc_')) {
                    $path = $file->store('uploads/eventtransaction', 'public');
                    $uploadedPaths[$key] = $path;
                }
            }
            //dd($uploadedPaths);
            // You can store the file paths as JSON or comma-separated values in DB
            $uploadedDocLinks = json_encode($uploadedPaths); // Or use implode if you prefer a string

    
            // Handle file upload
            if ($request->hasFile('uploaded_doc_links')) {
                $uploadedPath = $request->file('uploaded_doc_links')->store('uploads/eventtransaction', 'public');
            }
            $action = $request->input('action');
            // Unique identifiers (adjust if needed)
            $eventName = $request->input('event_name');
            $sakhiId = getUserId(); // Assuming current Sakhi user
            $existingEvent = "";
            if($request->get('id')){
                $id = $request->get('id');
                $existingEvent = EventTransaction::where('id', $id)
                    ->where('ys_id', $sakhiId)
                    ->first();
            }


            //Get Learner id
            
            $learner_id = $request->input('learner_id');
            if (!$learner_id && $request->filled('beneficiary_phone_number')) {
                $learner_id = DB::table('learners')
                    ->where('primary_phone_number', $request->input('beneficiary_phone_number'))
                    ->value('id');
            }

            //Get Event Name Based on Event Type 
            $event_name = YuwaahEventType::where('id', $request->input('event_type'))
                             ->value('name');
            $data = [
                'event_name'               => $event_name,
                'beneficiary_phone_number' => $request->input('beneficiary_phone_number'),
                'beneficiary_name'         => $request->input('beneficiary_name'),
                'event_id'                 => $request->input('event_type'),
                'event_type'               => $request->input('event_type'),
                'event_category'           => $request->input('event_category'),
                'event_value'              => $request->input('event_value'),
                'ys_id'                    => getUserId(),
                'comment'                  => $request->input('comment'),
                'document_type'            => $request->input('document_type'),
                'uploaded_doc_links'       => $uploadedDocLinks,
                'event_date_created'       => now(),
                'learner_id'               => $learner_id,
            ];

            if ($action === 'submit') {
                $data['event_date_submitted'] = now(); // Only on submit
            }

            if ($existingEvent) {
                // Update existing event
                //dd($uploadedDocLinks);
                //dd($data);
                if (empty(json_decode($uploadedDocLinks, true))) {
                    $data['uploaded_doc_links'] = $existingEvent['uploaded_doc_links'];
                }
                $existingEvent->update($data);

                // If External comment by the Field Agent Save into another database
                $external_comment = $request->external_comment;
                if (!empty($request->external_comment)) {
                   // dd('dd');
                   
                   try {
                    DB::connection('mysql2')->table('event_transaction_comments')->insert([
                        'event_transaction_id' => $id,
                        'comment' => $request->external_comment,
                        'comment_type' => 'agent',
                        'agent_id' => getUserId(),
                        'user_name' => getUserName(),
                        'user_id' => getUserId(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    //dd('Comment inserted successfully. ID: ' . $id);
                
                } catch (\Exception $e) {
                    //dd('Insert failed: ' . $e->getMessage());
                    return redirect()->back()
                    ->withInput()
                    ->with('error', $e->getMessage());
                }
                }

            } else {
                // Create new event
                EventTransaction::create($data);
            }
    
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
        //dd($request->all());
        $eventList = [];
        $allEventCount= "";
        $filter = $request->query('filter', 'desc'); // default to 'desc'
        $orderBy = $request->query('order_by', 'id'); // default to 'id'
        
        // Start query
        $query = EventTransaction::with(['Event','EventType'])
        ->where('ys_id', getUserId());

        // Apply search filters
        if ($request->has('name') && !empty($request->name)) {
            $query->where('event_name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('beneficiary_name') && !empty($request->beneficiary_name)) {
            $query->where('beneficiary_name', 'like', '%' . $request->beneficiary_name . '%');
        }

        if ($request->has('beneficiary_number') && !empty($request->beneficiary_number)) {
            $query->where('beneficiary_phone_number', 'like', '%' . $request->beneficiary_number . '%');
        }

        if ($request->has('event_type') && !empty($request->event_type)) {
            $query->where('event_id', $request->event_type); // exact match
            // If partial match is needed: ->where('event_type', 'like', '%' . $request->event_type . '%');
        }
        // Order and paginate
        $eventList = $query->orderBy($orderBy, $filter)->paginate();
       //dd($eventList );

       

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
        return view('user.editprofile',[
            'userDetails'=>$user,
            'pageTitle'=>$pageTitle
        ]);
    }


    public function getDistrictDropdown(Request $request)
    {
        $stateId = $request->state_id;
    
        // Call your helper function
        $class = "w-[330px] h-[40px] bg-[#FFFFFF] border-[1px] rounded-[10px] border-[#28388F0D] font-[400] text-[10px] leading-[12.19px] pl-2.5 text-[#A7A7A7] focus:ring-1 focus:ring-blue-500";
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
            'email' => 'required|email',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

         // Optional custom messages
        $messages = [
            'date_of_birth.required' => 'Date of birth is required.',
            'email.email' => 'Please enter a valid email address.',
            'profile_picture.image' => 'Only image files are allowed for profile picture.',
        ];
        // Fetch the profile
        $id = Auth::user()->id;
        $profile = YuwaahSakhi::findOrFail($id);
        // Update basic fields
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->dob = Carbon::now()->subYears(13)->toDateString();;
        $profile->year_of_exp = 0;
        $profile->gender = 'Male';
        $profile->work_hour_in_day = 0;
        $profile->education_level = 1;
        $profile->infrastructure_available = 'Yes';
        $profile->specific_qualification = 1;
        $profile->service_offered = 1;
        $profile->loan_taken = 'No';
        $profile->courses_completed = 1;
        $profile->type_of_loan = $request->loantype;
        $profile->digital_proficiency = 0;
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




    public function VerifyMobile(Request $request){
        return view('forgot-password');
    }



    public function verifyMobileNumber(Request $request){
       
        $request->validate([
            'mobilenumber' => ['required', 'regex:/^[6-9]\d{9}$/', 'digits:10'],
        ], [
            'mobilenumber.required' => 'Mobile number is required.',
            'mobilenumber.regex' => 'Enter a valid 10-digit mobile number.',
            'mobilenumber.digits' => 'Mobile number must be exactly 10 digits.',
        ]);
        $mobile = $request->get('mobilenumber');
        $yuwaahsakhi = YuwaahSakhi::where('contact_number',$mobile)->first();
        if (!$yuwaahsakhi) {
            return redirect()->back()->withErrors(['mobilenumber' => 'This mobile number is not registered with us.'])->withInput();
        }
        $otp = rand(100000, 999999);
        try {
            MobileOtp::create([
                'mobile_number' => $mobile,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
                'is_verified'=>0
            ]);
            // Here you can trigger your SMS API
            // sendOtpSms($mobile, $otp);
            return redirect()->route('verify.otp.page')
            ->with('success', 'OTP sent successfully.')
            ->with('mobileNumber', $mobile);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Failed to save OTP: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while sending OTP. Please try again.');
        }
       
    }


    public function verifyOTP(Request $request){
         // On reload or GET request, retrieve the mobile number from session
        $mobile = session('mobileNumber');
        // Validate the OTP Generated for this Mobile Number or not
        $mobileOTP = MobileOtp::where('mobile_number', $mobile)
        ->where('is_verified', 0)
        ->where('expires_at', '<', now())
        ->where(function($query) {
            $query->where('otp', '<>', '')
                ->orWhereNull('otp');
        })
        ->orderBy('id', 'desc')
        ->first();
        // Optional: Retrieve success message if needed
        $successMessage = session('success');
        if ($request->isMethod('post')) {
            // Store mobile number in session on POST request
            $mobile = $request->get('mobile');
            $request->session()->put('mobileNumber', $mobile);
            //dd($request->all());
            $otp1 = $request->get('d1');
            $otp2 = $request->get('d2');
            $otp3 = $request->get('d3');
            $otp4 = $request->get('d4');
            $otp5 = $request->get('d5');
            $otp6 = $request->get('d6');
            $otp = $otp1.$otp2.$otp3.$otp4.$otp5.$otp6;
            $mobileOTPDetails = MobileOtp::where('mobile_number', $mobile)
            ->where('is_verified', 0)
            ->where('otp', $otp)
            ->where('expires_at', '>', now())
            ->orderBy('id', 'desc')
            ->first();
            if ($mobileOTPDetails) {
                // Update the OTP status to verified
                $mobileOTPDetails->is_verified = 1;
                $mobileOTPDetails->save();
                return redirect()->back()->with('verifiedotp', 'OTP Verified.');
            }else{
                return redirect()->back()->with('error', 'Incorrect OTP');
            }
            

        }
        return view('verify_otp',[
            'mobile'=>$mobile
        ]);
    }





    public function changePassword(Request $request){
         // Validate input
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        try {
            // Decrypt mobile number
            $mobile = decryptString($request->mobile);
    
            // Fetch YuwaahSakhi user by mobile number
            $sakhi = YuwaahSakhi::where('contact_number', $mobile)->first();
    
            if (!$sakhi) {
                return response()->json(['status'=>false,'message' => 'Yuwaah Sakhi user not found'], 404);
            }
    
            // Update password
            $sakhi->password = Hash::make($request->password);
            $sakhi->save();
            return response()->json(['status'=>true,'message' => 'Password changed successfully']);
    
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    
    }





    public function getPromotionDetails(Request $request, $id)
    {
        try {
            // Decrypt the encrypted ID
            $promotionId = decryptString($id);

            // Retrieve promotion or fail
            $promotion = Promotion::findOrFail($promotionId);

            // Return the view with promotion details
            return view($this->dir . '.promotion_details_page', [
                'promotion' => $promotion
            ]);

        } catch (\Exception $e) {
            // Handle errors (invalid decryption, record not found, etc.)
            return redirect()->back()->with('error', 'Invalid promotion or access denied.');
        }
    }




    
    public function getBeneficiaries(Request $request)
    {
        $query = $request->input('name');
        $results = Learner::where('status','Active')
            ->where('first_name', 'like', "%$query%")
            ->select('first_name','primary_phone_number','id')
            ->limit(10)
            ->get();
        return response()->json($results);
    }




    public function getEventDetails(Request $request,$id){
        $eventList = YuwaahEventType::where('status',1)->get();
        //dd($eventList);
        $eventCategoryList = YuwaahEventMaster::where('status',1)->get();
        //dd($eventCategoryList);
      
        $idstr = decryptString($id);
        $eventTransactionDetails = EventTransaction::with('Event')->where('id',$idstr)->first();
        //dd($eventTransactionDetails);
        $event_tpe_id = $eventTransactionDetails['event_type'];

        //Get All Category List
        $eventCategoryList = YuwaahEventMaster::where('event_type_id',$event_tpe_id)->where('status',1)->get();
       // dd( $eventCategoryList);

        $documentTypeArr = [];
        $documentTypeArr[] = $eventCategoryList[0]['document_1'];
        $documentTypeArr[] = $eventCategoryList[0]['document_2'];
        $documentTypeArr[] = $eventCategoryList[0]['document_3'];

       //dd();
       //dd( $documentTypeArr);
       $count =0;
       $documentNewArr = [];
        foreach($documentTypeArr as $key=>$val){
            $documentNewArr[] = [
                'doc_name' => $documentTypeArr[$count],
                'document'=> $val
            ];
            $count++;
        }
        //dd($eventCategoryList);
       

       
        return view($this->dir.'.learner_to_event',[
            'item'=>$eventTransactionDetails,
            'ysid'=>encryptString(getUserId()),
            'eventList'=>$eventList,
            'eventCategoryList'=>$eventCategoryList,
            'documentArr'=>$documentNewArr,
            'documentTypeArr'=>$documentTypeArr,
            'opid'=>$id,
        ]);

    }


}
