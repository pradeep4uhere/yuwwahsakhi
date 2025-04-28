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
use Illuminate\Support\Facades\Storage;
use App\Models\YuwaahSakhiSetting;
use App\Models\Learner;
use App\Exports\LearnersExport;
use App\Exports\PartnersExport;
use App\Imports\LearnersImport;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;



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
       

        $dashboard = [
            'partner' => $partner,
            'partnerCenter'=>$partnerCenter,
            'YuwaahSakhi'=>$YuwaahSakhi,
            'Opportunities'=>$Opportunities,
            'Promotions'=>$Promotions,
            'eventcount'=>$event,
            'Learner'=>$learner,
            'learnerAgeGroup'=>$learnerAgeGroup
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
        $authApiController = new ApiAuthController();
        $response = $authApiController->getPartnerList($request);
        //dd($response);
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
            }
            if ($responseArray['status'] === true) {
                $errors = [];
                $success = $responseArray['message'];
            }
            
        }
        
        // Call the 'getPartnerList' method
        return view('admin.partner.add', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
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
            $response = $authApiController->updatePartner($request, $id);  // Get the response directly
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
        $authApiController = new ApiAuthController();
        $response = $authApiController->getPartnerCenterList($request);
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
                return redirect()->route('admin.partnercenter')->with('success', 'Partner Center deleted successfully.');
            } else {
                // Error message
                return redirect()->route('admin.partnercenter')->with('error', 'Failed to delete partner Center.');
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
    public function addNewOpportunities(Request $request){
        $responseArray = [];
        $errors = [];
        $success = [];
       
        if($request->isMethod('POST')) {
            // Create an instance of the ApiAuthController
            $authApiController = new ApiAuthController();
            
            // Call the 'addNewPartner' method and capture the response
            $response = $authApiController->addNewOpportunities($request);  // Get the response directly
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
       
        // Call the 'getPartnerList' method
        return view('admin.opportunites.add', [
            'response'=>$responseArray,
            'errors'=> $errors,
            'success'=>$success,
            'title' => __('messages.add_new_opportunity'),
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
         // Create an instance of the controller
         $authApiController = new ApiAuthController();
         $response = $authApiController->getYuwaahList($request);
         //dd($response);
         // Call the 'getPartnerList' method
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
        // Create an instance of the controller
        $response = YuwaahEventMaster::paginate(env('PAGINATION'));
        //dd($response);
       // dd($response);
        // Call the 'getPartnerList' method
        return view('admin.eventmaster.list', [
            'response'=>$response,
            'title' => 'All Event Master',
            'Module'=> 'Event Master'
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
                'event_type' => 'required|in:Course,Social Protection,Jobs,Self Empl / Entrepreneurship',
                'event_category' => 'required|string|max:255',
                'description' => 'nullable|string',
                'eligibility' => 'nullable|string|max:255',
                'fee_per_completed_transaction' => 'nullable|numeric|min:0',
                'date_event_created_in_master' => 'required|date',
                'document_1' => 'required|string|max:255',
                'document_2' => 'required|string|max:255',
                'document_3' => 'required|string|max:255',
                'status' => 'required|in:1,0', // Ensuring status is valid
            ]);
    
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
    
            try {
                // Update event
                $eventMaster->update([
                    'event_type' => $request->event_type,
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
    
        return view('admin.eventmaster.edit', [
            'eventDetails' => $eventMaster,
            'title' => __('messages.edit_event_master'),
            'Module' => __('Event Master')
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
                return redirect()->route('admin.eventmaster.list')->with('error', 'Event Master not found.');
            }

            // Delete associated documents if they exist
            foreach (['document_1', 'document_2', 'document_3'] as $doc) {
                if ($eventMaster->$doc) {
                    Storage::disk('public')->delete($eventMaster->$doc);
                }
            }

            // Delete the record from the database
            $eventMaster->delete();

            return redirect()->route('admin.eventmaster.list')->with('success', 'Event Master deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.eventmaster.list')->with('error', 'Failed to delete Event Master: ' . $e->getMessage());
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
    $response = Learner::paginate();
    return view('admin.learner.list', [
        'response'=>$response,
        'title' => 'All Learner',
    ]);
}




public function exportLearnersCSV()
{
    return Excel::download(new LearnersExport, 'learners.csv');
}


public function exportPartners()
{
    return Excel::download(new PartnersExport, 'partners.csv');
}





public function importLearnerForm(Request $request){
    return view('admin.learner.importform', [
        'title' => 'Learner Import',
    ]);
}

    public function importLearners(Request $request)
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

}
