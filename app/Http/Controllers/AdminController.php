<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use App\Http\Controllers\Auth\ApiAuthController;
use Illuminate\Support\Facades\Http;
use App\Models\Partner;
use App\Models\PartnerCenter;
use App\Models\Opportunity;
use App\Models\Pathway;
use App\Models\Promotion;
use App\Models\YuwaahSakhi;
use App\Models\YuwaahEventMaster;
use App\Models\YuwaahEventType;
use App\Models\YhubLearner;
use App\Models\EventTransaction;
use App\Models\PartnerPlacementUser;
use Illuminate\Support\Facades\Storage;
use App\Models\YuwaahSakhiSetting;
use App\Models\Learner;
use App\Exports\LearnersExport;
use App\Exports\PartnersExport;
use App\Imports\LearnersImport;
use App\Exports\YhubLearnersMatchedExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Exports\YhubLearnersExport;
use App\Exports\PartnerPlacementUserExport;




class AdminController extends Controller
{
    
      /**
     * Display the user's profile form.
     */
    public function dashboard(Request $request)
    {
        $partner = Partner::getAllCount();
        $partnerCenter = partnerCenter::getAllCount();
        $YuwaahSakhi = YuwaahSakhi::getAllCount();
        $Opportunities = Opportunity::getAllCount();
        $Promotions = Promotion::getAllCount();
        $event = YuwaahEventMaster::getAllEvents();
        $learner = Learner::getAllCount();
        $learnerAgeGroup = Learner::getLearnerAgeGroup();
        $PartnerPlacementUser = PartnerPlacementUser::getAllCount();
       

        $dashboard = [
            'partner' => $partner,
            'partnerCenter'=>$partnerCenter,
            'YuwaahSakhi'=>$YuwaahSakhi,
            'Opportunities'=>$Opportunities,
            'Promotions'=>$Promotions,
            'eventcount'=>$event,
            'Learner'=>$learner,
            'learnerAgeGroup'=>$learnerAgeGroup,
            'PartnerPlacementUser'=>$PartnerPlacementUser
        ];
        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'dashboard'=>$dashboard,
        ]);
    }



    /**
     * Get All Partner List
     */
    public function allPartnerList(Request $request){
        // Create an instance of the controller
        // Optional: validate or sanitize 'search' input
        $searchQuery = $request->input('search');
        $authApiController = new ApiAuthController();
        //$response = $authApiController->getPartnerList($request);
            // Initialize the query
            $query = Partner::with(['state', 'district', 'block']);
            if ($request->has('status')) {
            $query->where('status', $request->status);
        }
         // Apply search filters on name, email, and contact_number
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('contact_number', 'like', '%' . $searchQuery . '%');
            });
        }

        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }

        $query->orderBy('name','asc');
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', env('PAGINATION'));

        // Execute the query and return paginated results
        $response =  $query->paginate($perPage);

        // Call the 'getPartnerList' method
        return view('admin.partner.list', [
            'response'=>$response,
            'title' => 'All Partner',
        ]);
    }



    /**
     * Add New Parter
     */
    public function addNewPartner(Request $request){
        $responseArray = [];
        $errors = [];
        $success = [];
        $inputs['name']='';
        $inputs['email']='';
        $inputs['contact_number']='';
        $inputs['partner_id']='';
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->addNewPartner($request);  // Get the response directly
        
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
           
        
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
                $inputs = $request->all();
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
                $inputs = $request->all();
            }
            
        }
        
        // Call the 'getPartnerList' method
        return view('admin.partner.add', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'inputs'=>$inputs,
            'title' => __('messages.add_new_partner'),
        ]);
    }



    /*
    * Edit Partner List
    */
    public function editPartner(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            // Call the 'addNewPartner' method and capture the response
            //dd($request);
            $response = $authApiController->updatePartner($request, $id);  // Get the response directly
            //dd($response);
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
           // dd($responseArray);
            // Optionally, dump the response for debugging
            //dd($responseArray['error']);
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
        }

        
        $partnerDetails = Partner::find($id);
        // Call the 'getPartnerList' method
        return view('admin.partner.edit', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'partnerDetails'=>$partnerDetails,
            'title' => __('messages.edit_partner'),
        ]);
    }





    /**
     * Delete Partner
     */
    public function deletePartner(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->deletePartner($id);  // Get the response directly
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
                // Check the response status
            if ($responseArray['status'] === true) {
                // Success message
                return redirect()->route('admin.partner')->with('success', 'Partner deleted successfully.');
            } else {
                // Error message
                return redirect()->route('admin.partner')->with('error', 'Failed to delete partner.');
            }

    }





    /**
     * Get All Partner List
     */
    public function allPartnerCenterList(Request $request){
        // Create an instance of the controller
        $searchQuery = $request->input('search');
        $authApiController = new ApiAuthController();
        // Initialize the query
        $query = PartnerCenter::with(['state', 'district', 'block']);
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Apply search filters on name, email, and contact_number
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('center_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('contact_number', 'like', '%' . $searchQuery . '%');
            });
        }

         // Filter by status if provided in the request
         if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }

        $query->orderBy('center_name','ASC');
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', env('PAGINATION'));

        // Execute the query and return paginated results
        $response =  $query->paginate($perPage);
        //$response = $authApiController->getPartnerCenterList($request);
        //dd($response);
        // Call the 'getPartnerList' method
        return view('admin.partnercenter.list', [
            'response'=>$response,
            'title' => 'All Partner Center',
        ]);
    }



    /**
     * Add New Parter
     */
    public function addNewPartnerCenter(Request $request){
        $responseArray = [];
        $errors = [];
        $success = [];
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->addNewPartnerCenter($request);  // Get the response directly
        
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
            $errors = [];
            $success = null;

        
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false) {
                if (isset($responseArray['errors'])) {
                    if (is_array($responseArray['errors'])) {
                        $errors = $responseArray['errors'];
                    } else {
                        $errors = ['error' => [$responseArray['errors']]]; // Convert string error to an array
                    }
                }
            }
            
           
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
            
        }
        //dd($responseArray);
        $partnerList = Partner::where('status','=',1)->get();
        // Call the 'getPartnerList' method
        return view('admin.partnercenter.add', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'partnerList'=> $partnerList,
            'title' => __('messages.add_new_partner_center'),
        ]);
    }



    /*
    * Edit Partner List
    */
    public function editPartnerCenter(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->updatePartnerCenter($request, $id);  // Get the response directly
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
            //dd($responseArray);
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
            
        }

        
        $partnerDetails = PartnerCenter::with(['state','district','block'])->find($id);
        //dd($partnerDetails);
        $partnerList = Partner::where('status','=',1)->get();
        // Call the 'getPartnerList' method
        return view('admin.partnercenter.edit', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'partnerDetails'=>$partnerDetails,
            'partnerList'=>$partnerList,
            'title' => __('messages.edit_partner_center'),
        ]);
    }





    /**
     * Delete Partner
     */
    public function deletePartnerCenter(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->deletePartnerCenter($id);  // Get the response directly
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array

                // Check the response status
            if ($responseArray['status'] === true) {
                // Success message
                return redirect()->route('admin.partnercenter')->with('success', 'Partner Division deleted successfully.');
            } else {
                // Error message
                return redirect()->route('admin.partnercenter')->with('error', 'Failed to delete partner Division.');
            }

    }


    //All Opportunites Details


    /**
     * Get All Partner List
     */
    public function getOpportunitiesList(Request $request){
        // Create an instance of the controller
        $authApiController = new ApiAuthController();
        $response = $authApiController->getOpportunitiesList($request);
      //dd($response);
        // Call the 'getPartnerList' method
        return view('admin.opportunites.list', [
            'response'=>$response,
            'title' => 'All Opportunites List',
        ]);
    }



    /**
     * Add New Parter
     */
    public function addNewOpportunities(Request $request)
{
    if ($request->isMethod('POST')) {
        // Step 1: Validate input
        $validator = Validator::make($request->all(), [
            'opportunities_title'  => 'required|string|max:255', 
            'description'          => 'required|string|max:5000',
            'payout_monthly'       => 'required|numeric|min:0',
            'start_date'           => 'required|date|after_or_equal:today',
            'end_date'             => 'required|date|after:start_date',
            'number_of_openings'   => 'required|integer|min:1',
            'provider_name'        => 'required|string|max:255',
            'incentive'            => 'required|string|max:255',
            'document'             => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Step 2: Prepare data
        $attributes = $request->only([
            'opportunities_title',
            'description',
            'payout_monthly',
            'start_date',
            'end_date',
            'number_of_openings',
            'provider_name',
            'incentive',
        ]);

        // Step 3: File upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $fileName);
            $attributes['document'] = $fileName;
        }

        // Step 4: Check duplicate
        $existing = Opportunity::where('opportunities_title', $attributes['opportunities_title'])
            ->where('start_date', $attributes['start_date'])
            ->first();

        if ($existing) {
            return redirect()->back()
                ->withErrors(['This opportunity already exists with the same title and start date.'])
                ->withInput();
        }

        // Step 5: Save
        $opportunity = Opportunity::create($attributes);

        return redirect()->back()->with('success', 'Opportunity added successfully.');
    }

    // Initial GET request view
    return view('admin.opportunites.add', [
        'title' => __('messages.add_new_opportunity'),
    ]);
}

    
    public function getOpportunitiesDetails(Request $request, $id)
    {
        $idStr = decryptString($id);

        // Retrieve opportunity details
        $opportunityDetails = Opportunity::find($idStr);
        //dd($opportunityDetails);
        // Handle not found case
        if (!$opportunityDetails) {
            return redirect()->back()->with('error', 'Opportunity not found.');
        }

        // Optional: call getPartnerList() if needed
        // $partnerList = $this->getPartnerList();

        return view('admin.opportunites.details', [
            'opportunityDetails' => $opportunityDetails,
            'title' => __('Opportunity Details'),
            // 'partnerList' => $partnerList, // Uncomment if needed
        ]);
    }




    /*
    * Edit Partner List
    */
    public function updateOpportunities(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->updateOpportunities($request, $id);  // Get the response directly
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
           //dd($responseArray);
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
            
        }

        $details = Opportunity::find($id);
        //dd($details);
        return view('admin.opportunites.edit', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'details'=>$details,
            'title' => __('messages.edit_opportunity'),
        ]);
    }





    /**
     * Delete Partner
     */
    public function deleteOpportunities(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->deleteOpportunities($id);  // Get the response directly
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
                // Check the response status
            if ($responseArray['status'] === true) {
                // Success message
                return redirect()->route('admin.opportunities.list')->with('success', 'Opportunities  deleted successfully.');
            } else {
                // Error message
                return redirect()->route('admin.opportunities.list')->with('error', 'Failed to delete Opportunities.');
            }

    }







/** All Promotions Methods Start Here  */

    /**
     * Get All Partner List
     */
    public function getPromotionList(Request $request){
        // Create an instance of the controller
        $authApiController = new ApiAuthController();
        $response = $authApiController->getPromotionList($request);
        //dd($response);
        // Call the 'getPartnerList' method
        return view('admin.promotions.list', [
            'response'=>$response,
            'title' => 'Promotions',
        ]);
    }



    /**
     * Add New Parter
     */
    public function addNewPromotion(Request $request){
        $responseArray = [];
        $errors = [];
        $success = [];
        $errormessage = "";
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->addNewPromotionalItem($request);  // Get the response directly
        
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
        
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false && array_key_exists('error',$responseArray)) {
                if(isset($responseArray['errors'])){
                    $errors = $responseArray['errors'];
                }
                $success = [];
            }else if($responseArray['status'] !== true){
                $errormessage = $responseArray['message'];
                $success = [];
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
            
        }
        
        // Call the 'getPartnerList' method
        return view('admin.promotions.add', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'errormessage'=>$errormessage,
            'title' => __('messages.add_new_promotion'),
        ]);
    }



    /*
    * Edit Partner List
    */
    public function updatePromotion(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();

            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->updatePromotion($request, $id);  // Get the response directly
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
           
        
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
            
        }

        
        $details = Promotion::find($id);
        // Call the 'getPartnerList' method
        return view('admin.promotions.edit', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'details'=>$details,
            'title' => __('messages.edit_promotion'),
            'page_title' => __('messages.promotion'),
        ]);
    }





    /**
     * Delete Partner
     */
    public function deletePromotion(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
        // Create an instance of the ApiAuthController
        $authApiController = new ApiAuthController();
        // Call the 'addNewPartner' method and capture the response
        $response = $authApiController->deletePromotion($id);  // Get the response directly
        // If the response is a JsonResponse, you can convert it into an array
        $responseArray = $response->getData(true);  // Convert to array
            // Check the response status
        if ($responseArray['status'] === true) {
            // Success message
            return redirect()->route('admin.promotions.list')->with('success', __('messages.promotion_deleted_successfully'));
        } else {
            // Error message
            return redirect()->route('admin.promotions.list')->with('error', __('messages.failed_to_delete_promotion'));
        }
    }





    /***********
     * All Yuwaah Sakhi Methods Here
     */
    public function getYuwaahList(Request $request){
        $searchQuery = $request->input('search');
        $query = YuwaahSakhi::with(['state', 'district', 'block','partner','partnercenter']);
            if ($request->has('status')) {
            $query->where('status', $request->status);
        }
         // Apply search filters on name, email, and contact_number
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('sakhi_id', 'like', '%' . $searchQuery . '%')
                ->orWhere('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('csc_id', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('csc_id', 'like', '%' . $searchQuery . '%')
                ->orWhere('address', 'like', '%' . $searchQuery . '%')
                ->orWhere('contact_number', 'like', '%' . $searchQuery . '%');

            });
        }

        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }

        $query->orderBy('id','desc');
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', env('PAGINATION'));

        // Execute the query and return paginated results
        $responsearr =  $query->paginate($perPage);
        $response = YuwaahSakhi::getFormatedPaginationData($responsearr);
        //dd($response);
        return view('admin.yuwaahsakhi.list', [
             'response'=>$response,
             'title' => 'Yuwaah Sakhi',
         ]);
    }


    /**
     * Add New Yuwaah Sakhi
     */
    public function addNewYuwaahSakhi(Request $request){
        $responseArray = [];
        $errors = [];
        $success = [];
        
        if ($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();

            // Call the 'addNewYuwaahSakhi' method and capture the response
            $response = $authApiController->addNewYuwaahSakhi($request); 

            // Convert response to an array
            $responseArray = $response instanceof \Illuminate\Http\JsonResponse ? $response->getData(true) : [];
            //dd($responseArray);
            // Check if 'status' exists in the response
            if (isset($responseArray['status']) && $responseArray['status'] == false) {
                if (isset($responseArray['errors'])) {
                    return redirect()->back()->withErrors($responseArray['errors'])->withInput();
                }
            } elseif (isset($responseArray['status']) && $responseArray['status'] == true) {
                return redirect()->route('admin.yuwaahsakhi.list')->with('success', __($responseArray['message']));
            } else {
                return redirect()->back()->withErrors(['Unexpected error.'])->withInput();
            }
        }

        //All Partner List
        $partnerList = Partner::where('status',1)->get()->toArray();
        //dd( $partnerList);
        // Call the 'getPartnerList' method

        return view('admin.yuwaahsakhi.add', [
            'response'=>$responseArray,
            'partnerList'=>$partnerList,
            'title' => __('messages.add_yuwaah_sakhi'),
        ]);
    }
    

    /*
    * Edit updateYuwaahSakhi
    */
    public function updateYuwaahSakhi(Request $request, $id)
    {
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
        if ($request->isMethod('PUT')) { 
            $authApiController = new ApiAuthController();
            $response = $authApiController->updateYuwaahSakhi($request, $id);
            $responseArray = $response->getData(true);
            //dd($responseArray);
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
            }else if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
                return redirect()->route('admin.yuwaahsakhi.list')->with('success', __($responseArray['message']));
            } else {
                return redirect()->back()->withErrors(['Unexpected error occurred.'])->withInput();
            }
        }

        $details = YuwaahSakhi::find($id);
        //All Partner List
        $partnerList = Partner::where('status',1)->get()->toArray();
        return view('admin.yuwaahsakhi.edit', [
            'response' => $responseArray,
            'success' => session('success'), // ✅ Fetch success message from session
            'yuwaahsakhi' => $details,
            'errors'=>$errors,
            'partnerList'=>$partnerList,
            'title' => __('messages.edit_yuwaahsakhi'),
            'page_title' => __('messages.yuwaahsakhi'),
        ]);
    }


    public function getPartnerCenters(Request $request)
    {
        $partnerId = $request->partner_id;
        $centers = PartnerCenter::where('partner_id', $partnerId)->get(['id', 'center_name']);
        return response()->json($centers);
    }
    




    /**All Event Master Methods Start Here */


    /**
     * Get All Partner List
     */
    public function allEventMasterList(Request $request){
        $searchQuery = $request->input('search');
        $query = YuwaahEventMaster::query();
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
         // Apply search filters on name, email, and contact_number
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('event_type', 'like', '%' . $searchQuery . '%')
                ->orWhere('event_category', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%')
                ->orWhere('eligibility', 'like', '%' . $searchQuery . '%')
                ->orWhere('fee_per_completed_transaction', 'like', '%' . $searchQuery . '%');
            });
        }

        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }

        $query->orderBy('id','desc');
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', env('PAGINATION'));
        $response =  $query->paginate($perPage);
        return view('admin.eventmaster.list', [
            'response'=>$response,
            'title' => 'All Event Category',
            'Module'=> 'Event Category'
        ]);
    }



    /**
     * Add New Parter
     */
    public function addNewEventMaster(Request $request){
        $errors = [];
        $success = null;
        $responseArray = [];
       
        if($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'event_type' => 'required|in:Course,Social Protection,Jobs,Self Empl / Entrepreneurship',
                'event_category' => 'required|string|max:255',
                'description' => 'nullable|string',
                'eligibility' => 'nullable|string|max:255',
                'fee_per_completed_transaction' => 'nullable|numeric|min:0',
                'date_event_created_in_master' => 'required|date',
                'document_1' => 'required|string|max:255',
                'document_2' => 'required|string|max:255',
                'document_3' => 'required|string|max:255',
            ]);


            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator) // ✅ Correctly pass validation errors
                    ->withInput(); // ✅ Keep old input values
            }
            // Handle file uploads if they exist
            $documents = [];
            $documents = [
                'document_1' => $request->document_1,
                'document_2' => $request->document_2,
                'document_3' => $request->document_3,
            ];
            
            // foreach (['document_1', 'document_2', 'document_3'] as $doc) {
            //     if ($request->hasFile($doc)) {
            //         $documents[$doc] = $request->file($doc)->store('event_documents', 'public');
            //     } else {
            //         $documents[$doc] = null;
            //     }
            // }

            try {
                $eventMaster = YuwaahEventMaster::create([
                    'event_type' => $request->event_type,
                    'status' => 1,
                    'event_category' => $request->event_category,
                    'description' => $request->description ?? null,
                    'eligibility' => $request->eligibility ?? null,
                    'fee_per_completed_transaction' => $request->fee_per_completed_transaction ?? null,
                    'date_event_created_in_master' => $request->date_event_created_in_master,
                    'document_1' => $documents['document_1'],
                    'document_2' => $documents['document_2'],
                    'document_3' => $documents['document_3'],
                ]);
    
                $success = 'Event Master added successfully!';
                $responseArray = $eventMaster; // Pass the new event data
               
                return redirect()->back()
                ->with('success', 'Event Master added successfully!');
    
            } catch (\Exception $e) {
                $errors[] = 'Something went wrong! ' . $e->getMessage();
                return redirect()->back()
                ->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()])
                ->withInput(); // ✅ Keeps old form data
            }

        }

        return view('admin.eventmaster.add', [
            'title' => __('messages.add_new_partner'),
            'Module' => __('Event Master')
        ]);
            // Return the Blade view
        
    }


    public function editEventMaster(Request $request, $id)
    {
        $errors = [];
        $success = null;
        $id = decryptString($id);
        
        // Fetch existing event details
        $eventMaster = YuwaahEventMaster::find($id);
        if (!$eventMaster) {
            return redirect()->back()->withErrors(['error' => 'Event not found.']);
        }
    
        if ($request->isMethod('POST')) {
            // Validation
            $validator = Validator::make($request->all(), [
                'event_type' => 'required|numeric',
                'event_category' => 'required|string|max:255',
                'description' => 'nullable|string',
                'fee_per_completed_transaction' => 'nullable|numeric|min:0',
                'date_event_created_in_master' => 'required|date',
                'document_1' => 'required|string|max:255',
                'status' => 'required|in:1,0', // Ensuring status is valid
            ]);
    
           // dd($request->all());
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // Handle file uploads
            $documents = [
                'document_1' => $request->document_1,
                'document_2' => $request->document_2,
                'document_3' => $request->document_3,
            ];
            
            // foreach (['document_1', 'document_2', 'document_3'] as $doc) {
            //     if ($request->hasFile($doc)) {
            //         $documents[$doc] = $request->file($doc)->store('event_documents', 'public');
            //     }
            // }
    
           // dd($request->all());
        

            try {
                // Update event
                $eventMaster->update([
                    'event_type' => $request->event_type,
                    'event_type_id' => $request->event_type,
                    'event_category' => $request->event_category,
                    'description' => $request->description ?? null,
                    'eligibility' => $request->eligibility ?? null,
                    'fee_per_completed_transaction' => $request->fee_per_completed_transaction ?? null,
                    'date_event_created_in_master' => $request->date_event_created_in_master,
                    'document_1' => $documents['document_1'],
                    'document_2' => $documents['document_2'],
                    'document_3' => $documents['document_3'],
                    'status' => $request->status,
                ]);
    
                return redirect()->back()->with('success', 'Event Master updated successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()])
                    ->withInput();
            }
        }
        //all Event Type List
        $evetnTypeList = YuwaahEventType::where('status',1)->get();
        //dd($eventMaster);
        return view('admin.eventmaster.edit', [
            'eventDetails' => $eventMaster,
            'evetnTypeList'=>$evetnTypeList,
            'title' => __('messages.edit_event_category'),
            'Module' => __('Event Category')
        ]);
    }




    /**
     * Delete Partner
     */
    public function deleteEventMaster(Request $request, $id)
    {
        try {
            $id = decryptString($id); // Decrypt the ID if it's encrypted
            $eventMaster = YuwaahEventMaster::find($id);

            if (!$eventMaster) {
                return redirect()->route('admin.eventcategory.list')->with('error', 'Event Category not found.');
            }

            // Delete associated documents if they exist
            foreach (['document_1', 'document_2', 'document_3'] as $doc) {
                if ($eventMaster->$doc) {
                    Storage::disk('public')->delete($eventMaster->$doc);
                }
            }

            // Delete the record from the database
            $eventMaster->delete();

            return redirect()->route('admin.eventcategory.list')->with('success', 'Event Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventcategory.list')->with('error', 'Failed to delete Event Category: ' . $e->getMessage());
        }
    }








    /***
     * Yuwaah Sakhi Home Page Setting
     */
    public function yuwaahSakhiHomePageSetting(Request $request){
        if ($request->isMethod('POST')) {
            $request->validate([
                'home_page_title' => 'required|string|max:255',
                'description' => 'required|string',
                'home_page_banner_type' => 'required|integer',
                'youtube_url' => 'nullable|url',
                'profile_photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle multiple banner images
            $banners = [];
            $existingBanners = YuwaahSakhiSetting::where('id', 1)->value('banners'); // Get existing banners

            if ($request->hasFile('banners')) {
                foreach ($request->file('banners') as $file) {
                    $path = $file->store('banners', 'public'); // Stores in storage/app/public/banners
                    $banners[] = $path;
                }
            } else {
                $banners = json_decode($existingBanners, true) ?? []; // Keep existing banners if none are uploaded
            }



             // Save settings
            YuwaahSakhiSetting::updateOrCreate(
                        ['id' => 1], // Assuming a single row setup
                        [
                            'home_page_title' => $request->input('home_page_title'),
                            'description' => $request->input('description'),
                            'home_page_banner_type' => $request->input('home_page_banner_type'),
                            'youtube_url' => $request->input('youtube_url'),
                            'banners' => json_encode($banners), // Store as JSON
                        ]
                );
            return redirect()->back()->with('success', 'Settings updated successfully!');
                
        }
        $bannerArr = [];
        $setting = YuwaahSakhiSetting::first();
        if($setting['banners']!=''){
            $bannerArr = json_decode($setting['banners'],true);
        }
        //dd($bannerArr);
        //dd($setting);
        $title = "Yuwaah Sakhi Setting";
        return view('admin.yuwaahsetting.index', compact('setting','title','bannerArr'));
    }




    public function deleteBanner(Request $request)
{
    $request->validate([
        'banner' => 'required|string'
    ]);

    $bannerPath = $request->input('banner');

    // Get the current banners from the database
    $settings = YuwaahSakhiSetting::where('id', 1)->first();
    if (!$settings) {
        return response()->json(['success' => false, 'message' => 'Settings not found.']);
    }

    $banners = json_decode($settings->banners, true) ?? [];
    //dd( $banners);

    // Remove the selected banner from the array
    if (($key = array_search($bannerPath, $banners)) !== false) {
        unset($banners[$key]);
        // Delete the file from storage
        Storage::disk('public')->delete($bannerPath);
    }

    // Update the database
    $settings->update(['banners' => json_encode(array_values($banners))]);

    return response()->json(['success' => true, 'message' => 'Banner deleted successfully.']);
}






/**
 * All Learnser List
 */
public function allLearnerList(Request $request){
        $searchQuery = $request->input('search');
        $query = Learner::with(['state', 'district', 'block']);
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
         // Apply search filters on name, email, and contact_number
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('first_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('last_name', 'like', '%' . $searchQuery . '%')
                ->orWhere('date_of_birth', 'like', '%' . $searchQuery . '%')
                ->orWhere('gender', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('primary_phone_number', 'like', '%' . $searchQuery . '%');
            });
        }

        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }

        $query->orderBy('id','desc');
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', env('PAGINATION'));

        // Execute the query and return paginated results
        $response =  $query->paginate($perPage);
        return view('admin.learner.list', [
            'response'=>$response,
            'title' => 'All Learner',
        ]);
}




public function exportLearnersCSV()
{
    return Excel::download(new LearnersExport, 'learners'.date('y_m_d_h_i_s_a').'.csv');
}




public function exportDashboardLearnersCSV()
{
    return Excel::download(new YhubLearnersExport, 'dashboard_learners'.date('y_m_d_h_i_s_a').'.csv');
}


public function exportDashboardMatchedLearnersCSV()
{
    return Excel::download(new YhubLearnersMatchedExport, 'dashboard_learners'.date('y_m_d_h_i_s_a').'.csv');
}


public function exportPartners()
{
    return Excel::download(new PartnersExport, 'partners_'.date('y_m_d_h_i_s_a').'.csv');
}





public function importVLEForm(Request $request){
    $partnerList = Partner::where('status','=',1)->get();
    return view('admin.learner.importvleform', [
        'title' => 'field Agent Import',
        'partnerList'=>$partnerList
    ]);
}


public function importvle(Request $request)
{
    $request->validate([
        'partner_id'        => 'required',
        'partner_center_id' => 'required',
        'file'              => 'required|mimes:csv,txt'
    ]);

    $uploadedFile = $request->file('file');

    if (!$uploadedFile->isValid()) {
        return back()->with('error', 'File upload failed.');
    }

    $handle = fopen($uploadedFile->getPathname(), 'r');

    if (!$handle) {
        return back()->with('error', 'Unable to open file.');
    }

    $defaultPassword = Hash::make('password@123');

    // Create duplicate file
    $duplicateFilePath = storage_path('app/duplicate_yuwaah_sakhi_' . time() . '.csv');
    $duplicateFile = fopen($duplicateFilePath, 'w');

    fputcsv($duplicateFile, [
        'csc_id',
        'state',
        'district',
        'city',
        'name',
        'contact_number',
        'email',
        'location_type',
        'reason'
    ]);

    $insertCount = 0;
    $duplicateCount = 0;

    // Skip header
    fgetcsv($handle);

    while (($row = fgetcsv($handle, 1000, ',')) !== false) {

        if (count($row) < 8) {
            continue; // skip invalid rows
        }

        $email = isset($row[6]) ? trim($row[6]) : null;
        $email = preg_replace('/[^\x20-\x7E]/', '', $email);

        $contact = isset($row[5]) ? trim($row[5]) : null;
        $contact = preg_replace('/\D+/', '', $contact);

        $cscId = $row[0] ?? null;

        $existingRecord = YuwaahSakhi::where('csc_id', $cscId)
            ->orWhere('contact_number', $contact)
            ->orWhere('email', $email)
            ->first();

        if ($existingRecord) {

            $reason = [];

            if ($existingRecord->csc_id == $cscId) {
                $reason[] = 'Duplicate CSC ID';
            }

            if ($existingRecord->contact_number == $contact) {
                $reason[] = 'Duplicate Contact';
            }

            if ($existingRecord->email == $email) {
                $reason[] = 'Duplicate Email';
            }

            fputcsv($duplicateFile, array_merge($row, [implode(', ', $reason)]));
            $duplicateCount++;

        } else {

            YuwaahSakhi::create([
                'password'          => $defaultPassword,
                'sakhi_id'          => generateYuwaahSakhiCode(
                                        $request['partner_id'],
                                        $request['partner_center_id']
                                    ),
                'csc_id'            => $cscId,
                'name'              => $row[4],
                'email'             => $email,
                'district'          => $row[2],
                'state'             => $row[1],
                'city'              => $row[3],
                'location_type'     => $row[7],
                'contact_number'    => $contact,
                'partner_id'        => $request['partner_id'],
                'partner_center_id' => $request['partner_center_id'],
                'onboard_date'      => now()
            ]);

            $insertCount++;
        }
    }

    // ✅ CLOSE FILES AFTER LOOP
    fclose($handle);
    fclose($duplicateFile);

    // If duplicates exist → download file
    if ($duplicateCount > 0) {

        session([
            'duplicate_file' => basename($duplicateFilePath)
        ]);
    
        return back()->with(
            'success',
            "CSV Imported! Inserted: $insertCount, Duplicates: $duplicateCount. Duplicate file will download in 30 seconds."
        );
    }
}



public function importLearnerForm(Request $request){
    return view('admin.learner.importform', [
        'title' => 'Learner Import',
    ]);
}

public function importLearners(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt|max:2048',
    ]);

    $file = $request->file('file');

    

    // Read and parse the CSV
    $rows = array_filter(array_map('trim', file($file->getRealPath())));
    $delimiter = (substr_count($rows[0], ';') > substr_count($rows[0], ',')) ? ';' : ',';

    $header = str_getcsv(array_shift($rows), $delimiter);

    foreach ($rows as $index => $line) {
        $row = str_getcsv($line, $delimiter);

        if (count($row) !== count($header)) {
            return response()->json([
                'error' => "Row $index has " . count($row) . " columns, expected " . count($header),
            ], 400);
        }

        $data = array_combine($header, $row);

        // Parse DOB
        try {
            $dob = (!empty($data['DOB']) && strtolower($data['DOB']) !== 'undefined')
                ? \Carbon\Carbon::createFromFormat('d/m/y', $data['DOB'])->format('Y-m-d')
                : null;
        } catch (\Exception $e) {
            $dob = null;
        }

        $validGenders = ['Male', 'Female', 'Other'];
        $gender = ucfirst(strtolower(trim($data['GENDER'] ?? '')));
        $gender = in_array($gender, $validGenders) ? $gender : 'Male';

        // Create learner
       //dd($data);
       $lastName = isset($data['LAST NAME'])
       ? iconv('Windows-1252', 'UTF-8//IGNORE', $data['LAST NAME'])
       : null;
        
        $firstName = isset($data['FIRST NAME'])
            ? iconv('Windows-1252', 'UTF-8//IGNORE', $data['FIRST NAME'])
            : null;
        
        $unitInstitute = isset($data['UNIT_INSTITUTE'])
            ? iconv('Windows-1252', 'UTF-8//IGNORE', $data['UNIT_INSTITUTE'])
            : null;


        \App\Models\Learner::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => 'NA',
            'primary_phone_number' => $data['USER PHONE NUMBER'] ?? null,
            'gender' => $gender,
            'date_of_birth' => $dob,
            'education_level' => $data['EDUCATION LEVEL'] ?? null,
            'digital_proficiency' => $data['DIGITAL PROFECIENCY LEVEL'] ?? null,
            'MONTHLY_FAMILY_INCOME_RANGE' => $data['MONTHLY FAMILY INCOME RANGE'] ?? null,
            'USER_EMAIL' => $data['USER EMAIL'] ?? null,
            'DISTRICT_CITY' => $data['DISTRICT/CITY'] ?? null,
            'STATE' => $data['STATE'] ?? null,
            'PIN_CODE' => $data['PIN CODE'] ?? null,
            'PROGRAM_CODE' => $data['PROGRAM CODE'] ?? null,
            'PROGRAM_STATE' => $data['PROGRAM STATE'] ?? null,
            'PROGRAM_DISTRICT' => $data['PROGRAM DISTRICT'] ?? null,
            'UNIT_INSTITUTE' => $unitInstitute,
            'SOCIAL_CATEGORY' => $data['SOCIAL CATEGORY'] ?? null,
            'RELIGION' => $data['RELIGION'] ?? null,
            'USER_MARIAL_STATUS' => $data['USER MARIAL STATUS'] ?? null,
            'DIFFRENTLY_ABLED' => $data['DIFFRENTLY ABLED'] ?? null,
            'english_knowledge' => $data['ENGLISH PROFECIENCY LEVEL'] ?? null,
            'IDENTITY_DOCUMENTS' => $data['IDENTITY DOCUMENTS'] ?? null,
            'REASON_FOR_LEARNING_NEW_SKILLS' => $data['REASON FOR LEARNING NEW SKILLS'] ?? null,
            'EARN_AT_MY_OWN_TIME' => $data['EARN AT MY OWN TIME'] ?? null,
            'work_hours_per_day' => is_numeric($data['EARNING HOURS PER DAY']) ? $data['EARNING HOURS PER DAY'] : 0,
            'work_kind' => $data['NATURE OF WORK'] ?? null,
            'preferred_skill1' => $data['SPECIFIC SKILL'] ?? null,
            'RELOCATE_FOR_JOB' => $data['RELOCATE FOR JOB'] ?? null,
            'job_qualifications' => $data['JOB QUALIFICATION'] ?? null,
            'WHEN_CAN_USER_START' => $data['WHEN CAN USER START '] ?? null,
            'experiance' => $data['USER JOB EXPERIANCE'] ?? 0,
            'interested_in_opportunities' => ($data['INTERESTED TO RUN A BUSINESS'] == 'FALSE') ? 0 : 1,
            'business_status' => $data[' BUSINESS STATUS'] ?? null,
            'USER_NEED_HELP_WITH' => $data['USER NEED HELP WITH'] ?? null,
            'profile_photo_url' => $data['USER PHOTO URL'] ?? null,
            'create_date' => $data['USER PROFILE CREATED DATE'] ?? null,
        ]);
    }

    return response()->json([
        'status' => 'success',
        'message' => 'CSV imported successfully.',
    ]);
}


    public function importLearnerssssss(Request $request)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(600); 
        $request->validate([
            'file' => 'required|mimes:csv,xlsx'
        ]);
        //dd($request->all());
        // Store the uploaded file
        $filePath = $request->file('file')->storeAs('imports', 'learners.csv','public');
        //echo  asset('storage/'.$filePath);
        //echo $absoluteFilePath = asset('storage/' . $filePath); die;
        //dd($absoluteFilePath);
        // Send the file path to Node.js server
        $client = new Client();
        // $response = $client->post('http://127.0.0.1:3000/process', [
        //     'json' => [
        //         'filePath' => storage_path('app/' . $filePath, 'public') // send local path
        //     ]
        // ]);
        $absFilePath = storage_path('app/public/' . $filePath);
        return response()->json(['success' => true, 'message' => 'file Uploaded successfully.','filepath'=>$absFilePath]);
       
        //return back()->with('success', $response);
        // Import the file and process it in chunks
        //Excel::import(new LearnersImport, $request->file('file'));
        //return back()->with('success', 'Learners imported successfully!');
    }






    /**
     * Yuwaah Sakhi Details
     */
    public function getYuwaahDetails(Request $request, $id){
        $idstr = decryptString($id);
        $yuwaahSakhiDetails = YuwaahSakhi::findorfail($idstr);
        $details = YuwaahSakhi::getFormatedData($yuwaahSakhiDetails);
        return view('admin.yuwaahsakhi.details', [
            'userDetails' => $details,
            'title' => __('Yuwaah Sakhi Details')
        ]);

    }






    /**
     * Add New Parter
     */
    public function addNewEventType(Request $request){
        $errors = [];
        $success = null;
        $responseArray = [];
       
        if($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'description' => 'nullable|string',
            ]);


            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator) // ✅ Correctly pass validation errors
                    ->withInput(); // ✅ Keep old input values
            }
           
            try {
                $eventMaster = YuwaahEventType::create([
                    'name' => $request->name,
                    'status' => 1,
                    'description' => $request->description ?? null,
                    ]);
    
                $success = 'Event Type added successfully!';
                $responseArray = $eventMaster; // Pass the new event data
               
                return redirect()->back()
                ->with('success', 'Event Type added successfully!');
    
            } catch (\Exception $e) {
                $errors[] = 'Something went wrong! ' . $e->getMessage();
                return redirect()->back()
                ->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()])
                ->withInput(); // ✅ Keeps old form data
            }

        }

        return view('admin.eventmaster.add_event_type', [
            'title' => __('messages.add_new_event_type'),
            'Module' => __('Event Type')
        ]);
            // Return the Blade view
        
    }



      /**
     * Get All Partner List
     */
    public function allEventTypeList(Request $request){
        $searchQuery = $request->input('search');
        $query = YuwaahEventType::query();
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
         // Apply search filters on name, email, and contact_number
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%');
            });
        }

        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }

        $query->orderBy('id','desc');
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', env('PAGINATION'));
        $response =  $query->paginate($perPage);
        return view('admin.eventmaster.eventtypelist', [
            'response'=>$response,
            'title' => 'All Event Type',
            'Module'=> 'Event Type'
        ]);
    }






    public function editEventType(Request $request, $id)
    {
        $errors = [];
        $success = null;
        $id = decryptString($id);
        
        // Fetch existing event details
        $eventMaster = YuwaahEventType::find($id);
        if (!$eventMaster) {
            return redirect()->back()->withErrors(['error' => 'Event not found.']);
        }
    
        if ($request->isMethod('POST')) {
            // Validation
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|in:1,0', // Ensuring status is valid
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            try {
                // Update event
                $eventMaster->update([
                    'name' => $request->name,
                    'description' => $request->description ?? null,
                    'status' => $request->status,
                ]);
    
                return redirect()->back()->with('success', 'Event Type updated successfully!');
            } catch (\Exception $e) {
                return redirect()->back()
                    ->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()])
                    ->withInput();
            }
        }
    
        return view('admin.eventmaster.editeventtype', [
            'eventDetails' => $eventMaster,
            'title' => __('messages.edit_event_type'),
            'Module' => __('Edit Event Type')
        ]);
    }






    

     /**
     * Add New Parter
     */
    public function addNewEventCategory(Request $request){
            $errors = [];
            $success = null;
            $responseArray = [];
        
            if($request->isMethod('POST')) {

                //dd($request->all());
                $validator = Validator::make($request->all(), [
                    'event_type' => 'required|numeric',
                    'event_category' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'eligibility' => 'nullable|string|max:255',
                    'fee_per_completed_transaction' => 'nullable|numeric|min:0',
                    'date_event_created_in_master' => 'required|date',
                    'document_1' => 'required|string|max:255',
                ]);


                // If validation fails, redirect back with errors
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator) // ✅ Correctly pass validation errors
                        ->withInput(); // ✅ Keep old input values
                }
                // Handle file uploads if they exist
                $documents = [];
                $documents = [
                    'document_1' => $request->document_1,
                    'document_2' => $request->document_2,
                    'document_3' => $request->document_3,
                ];
                
                // foreach (['document_1', 'document_2', 'document_3'] as $doc) {
                //     if ($request->hasFile($doc)) {
                //         $documents[$doc] = $request->file($doc)->store('event_documents', 'public');
                //     } else {
                //         $documents[$doc] = null;
                //     }
                // }

                try {
                    $eventMaster = YuwaahEventMaster::create([
                        'event_type_id' => $request->event_type,
                        'status' => 1,
                        'event_category' => $request->event_category,
                        'description' => $request->description ?? null,
                        'eligibility' => $request->eligibility ?? null,
                        'fee_per_completed_transaction' => $request->fee_per_completed_transaction ?? null,
                        'date_event_created_in_master' => $request->date_event_created_in_master,
                        'document_1' => $documents['document_1'],
                        'document_2' => $documents['document_2'],
                        'document_3' => $documents['document_3'],
                    ]);
        
                    $success = 'Event Category added successfully!';
                    $responseArray = $eventMaster; // Pass the new event data
                
                    return redirect()->back()
                    ->with('success', 'Event Category added successfully!');
        
                } catch (\Exception $e) {
                    $errors[] = 'Something went wrong! ' . $e->getMessage();
                    return redirect()->back()
                    ->withErrors(['error' => 'Something went wrong! ' . $e->getMessage()])
                    ->withInput(); // ✅ Keeps old form data
                }

            }

            //all Event Type List
            $evetnTypeList = YuwaahEventType::where('status',1)->get();
            //dd($evetnTypeList);

            return view('admin.eventmaster.add_event_category', [
                'evetnTypeList'=>$evetnTypeList,
                'title' => __('messages.add_new_event_category'),
                'Module' => __('Event Category')
            ]);
                // Return the Blade view
        
    }







/**
 * All Learnser List
 */
public function allLearnerSkillsList(Request $request){
    $searchQuery = $request->input('search');
    $query = YhubLearner::with(['state', 'district', 'block']);
    if ($request->has('status')) {
        $query->where('status', $request->status);
    }
     // Apply search filters on name, email, and contact_number
    if (!empty($searchQuery)) {
        $query->where(function($q) use ($searchQuery) {
            $q->where('first_name', 'like', '%' . $searchQuery . '%')
            ->orWhere('last_name', 'like', '%' . $searchQuery . '%')
            ->orWhere('gender', 'like', '%' . $searchQuery . '%')
            ->orWhere('email_address', 'like', '%' . $searchQuery . '%')
            ->orWhere('completion_percent', 'like', '%' . $searchQuery . '%')
            ->orWhere('completion_status', 'like', '%' . $searchQuery . '%');
        });
    }

    // Sorting logic based on 'sort_by' and 'sort_order' parameters
    if ($request->has('sort_by')) {
        $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
        $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
        $query->orderBy($sortBy, $sortOrder);
    }

    $query->orderBy('id','desc');
    // Set the number of items per page from the request, or default to 10
    $perPage = $request->get('per_page', env('PAGINATION'));

    // Clone query before pagination
    $allRows = (clone $query)->get();
    // Execute the query and return paginated results
    $response =  $query->paginate($perPage);
    //dd($response);
    return view('admin.learner.skilllearnerlist', [
        'response'=>$response,
        'allRows' => $allRows, 
        'title' => 'All Skill Learner',
    ]);
}




public function importEventTransactionForm(Request $request){
    $partnerList = Partner::where('status','=',1)->get();
    return view('admin.eventtransaction.importform', [
        'title' => 'Event Transaction Import',
        'partnerList'=>$partnerList
    ]);
}



public function importEventTransaction(Request $request)
{
    $request->validate([
        'partner_id'        => 'required',
        'partner_center_id' => 'required',
        'file'              => 'required|mimes:csv,txt'
    ]);

    $path = $request->file('file')->getRealPath();
    $file = fopen($path, 'r');
    $header = fgetcsv($file); // skip header row

    //dd($request->all());

    while (($row = fgetcsv($file, 1000, ',')) !== FALSE) {
          // Convert all columns to UTF-8
    $row = array_map(function ($field) {
        return mb_convert_encoding($field, 'UTF-8', 'ISO-8859-1');
    }, $row);
    $eventValue = preg_replace('/[^0-9.\-]/', '', $row[1]); 

    
    // If it's empty or not numeric, set it to 0
    if ($eventValue === '' || !is_numeric($eventValue)) {
        $eventValue = 0;
    }
    
    EventTransaction::create([
            'beneficiary_phone_number'  => $row[0],  // reuse hashed password
            'event_value'               => $eventValue,
            'event_id'                  => $row[7], //Event Type Id
            'event_type'                => $row[7], //Event Type Id
            'event_category'            => $row[8], // Event Master Value id
            'event_name'                => $row[11],
            'review_status'             => $row[9],
            'event_date_created'        => now(),
            'event_date_submitted'      => now(),
            'ys_id'                     => $row[10],
            'event_category_name'       => $row[6],
        ]);
       
    }

    fclose($file);

    return back()->with('success', 'CSV Imported Successfully!');
}





    /**
     * Get All Partner List
     */
    public function allPlacementPartnerList(Request $request){
        // Create an instance of the controller
        // Optional: validate or sanitize 'search' input
        $searchQuery = $request->input('search');
        $authApiController = new ApiAuthController();
        //$response = $authApiController->getPartnerList($request);
            // Initialize the query
            $query = PartnerPlacementUser::with(['state', 'district']);
            if ($request->has('status')) {
            $query->where('status', $request->status);
        }
         // Apply search filters on name, email, and contact_number
        if (!empty($searchQuery)) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%')
                ->orWhere('phone', 'like', '%' . $searchQuery . '%');
            });
        }

        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'id');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }

        $query->orderBy('name','asc');
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', env('PAGINATION'));

        // Execute the query and return paginated results
        $response =  $query->paginate($perPage);

        //dd($response);

        // Call the 'getPartnerList' method
        return view('admin.placementpartner.list', [
            'response'=>$response,
            'title' => 'All Placement Partner',
        ]);
    }
    


    


   
    /*
    * Edit Partner List
    */
    public function editPlacementPartner(Request $request, $id){
        $responseArray = [];
        $errors = [];
        $success = [];
        $id = decryptString($id);
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            // Call the 'addNewPartner' method and capture the response
            //dd($request);
            $response = $authApiController->updatePlacementPartner($request, $id);  // Get the response directly
            //dd($response);
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
           // dd($responseArray);
            // Optionally, dump the response for debugging
            //dd($responseArray['error']);
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
        }

        
        $partnerDetails = PartnerPlacementUser::find($id);
        //dd( $partnerDetails);
        // Call the 'getPartnerList' method
        return view('admin.placementpartner.edit', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'partnerDetails'=>$partnerDetails,
            'title' => __('Edit Placement Partner'),
        ]);
    }




    /**
     * Add New Parter
     */
    public function addNewPlacementPartner(Request $request){
        $responseArray = [];
        $errors = [];
        $success = [];
        $inputs['name']='';
        $inputs['email']='';
        $inputs['contact_number']='';
        $inputs['partner_id']='';
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->addNewPlacementPartner($request);  // Get the response directly
        
            // If the response is a JsonResponse, you can convert it into an array
            $responseArray = $response->getData(true);  // Convert to array
           
        
            // Optionally, dump the response for debugging
            if ($responseArray['status'] === false) {
                $errors = $responseArray['errors'];
                $success = [];
                $inputs = $request->all();
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
                $inputs = $request->all();
            }
            
        }
        
        // Call the 'getPartnerList' method
        return view('admin.placementpartner.add', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'inputs'=>$inputs,
            'title' => __('Add New Placement Partner'),
        ]);
    }



    public function export()
    {
        return Excel::download(new PartnerPlacementUserExport, 'partner_users.xlsx');
    }




}
