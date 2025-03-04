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
use Illuminate\Support\MessageBag;


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

        $dashboard = [
            'partner' => $partner,
            'partnerCenter'=>$partnerCenter,
            'YuwaahSakhi'=>$YuwaahSakhi,
            'Opportunities'=>$Opportunities,
            'Promotions'=>$Promotions
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

        
        $partnerDetails = PartnerCenter::find($id);
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
            'error'=> $errors,
            'success'=>$success,
            'title' => __('messages.add_new_partner_center'),
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
            'title' => __('messages.edit_partner_center'),
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

        
        // Call the 'getPartnerList' method
        return view('admin.yuwaahsakhi.add', [
            'response'=>$responseArray,
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

        return view('admin.yuwaahsakhi.edit', [
            'response' => $responseArray,
            'success' => session('success'), // ✅ Fetch success message from session
            'yuwaahsakhi' => $details,
            'errors'=>$errors,
            'title' => __('messages.edit_yuwaahsakhi'),
            'page_title' => __('messages.yuwaahsakhi'),
        ]);
    }

    

















}
