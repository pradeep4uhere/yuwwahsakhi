<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Partner;
use App\Models\PartnerCenter;
use App\Models\Opportunity;
use App\Models\Pathway;
use App\Models\Promotion;
use App\Models\YuwaahSakhi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session; 
use Log;
use Illuminate\Validation\Rule;

class ApiAuthController extends Controller
{
     /**
     * Handle login requests.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'status'=>true,
            'user' => $user,
            'token' => $token,
        ]);
    }

    /**
     * Get the authenticated user.
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    /**
     * Handle logout requests.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([ 'status'=>true,'message' => 'Logged out successfully']);
    }


    /********************************  Partner API Start Here  *****************/


    /**
     * Get All Partner List 
     */
    public function getPartnerList(Request $request){
         // Initialize the query
         $query = Partner::with(['state', 'district', 'block']);
         if ($request->has('status')) {
            $query->where('status', $request->status);
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
        return $query->paginate($perPage);

    }


     /**
     * Add New Partner In Admin section
     */
    public function addNewPartner(Request $request){
        //dd($request->all());
         // Validate incoming request
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'partner_id' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email',
            'contact_number' => 'required|string|max:15',
            'password' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        

        if ($validator->fails()) {
            return response()->json([ 'status'=>false,'errors' => $validator->errors()], 422);
        }

        try {
            // Create a new partner
            $partner = Partner::create([
                'partner_id' => $request->partner_id, // Generate unique partner ID
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'contact_number' => $request->contact_number,
                'status' => $request->status,
                'onboard_date' => now(),
            ]);

            return response()->json([
                'status'=>true,
                'message' => 'Partner added successfully.',
                'partner' => $partner,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'message' => 'Failed to add partner.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




/**
 * Update Partner Data
 */
    public function updatePartner(Request $request, $partnerId)
    {
       
        Log::info('Locale set to: ' . app()->getLocale());
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'partner_id' => 'required|string|max:255',
            'email' => 'required|email|unique:partners,email,'. $partnerId,
            'contact_number' => 'required|string|max:15',
            'password' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>false,
                'errors' => $validator->errors()], 422);
        }
      

        try {
            // Find the partner by ID
            $partner = Partner::find($partnerId);
            //dd($partner);
            if (!$partner) {
                return response()->json([
                    'status'=>false,
                    'message' => 'Partner not found.',
                ], 404);
            }
        
            // Update partner data
            $partner->update([
                'name' => $request->name,
                'partner_id'=>$request->partner_id,
                'email' => $request->email,
                'password' => $request->password,
                'contact_number' => $request->contact_number,
                'status' => $request->status,
            ]);

            $partnerData = Partner::formatedPartnerData($partner);
            
            return response()->json([
                'status'=>true,
                'message' => __('messages.partner_updated_successfully'),
                'partner' => $partnerData,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'message' => _('message.failed_to_update_partner'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }








    /**
     * Delete a partner by ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePartner($id)
    {
        try {
            // Find the partner by ID
            $partner = Partner::find($id);

            if (!$partner) {
                return response()->json([
                    'status'=>false,
                    'message' => 'Partner not found.',
                ], 404);
            }

            // Delete the partner
            $partner->delete();

            return response()->json([
                'status'=>true,
                'message' => 'Partner deleted successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'message' => 'Failed to delete partner.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



   /**
    * Get Opportunitess Details In Amdin Section
    */
    public function getPartnerDetails(Request $request, $id){
        $partner = Partner::find($id);
        if (!$partner) {
            return response()->json([
                'status'=>false,
                'message' => __('messages.partner_not_found'),
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => __('messages.partner_found'),
            'data'=> Partner::formatedPartnerData($partner)
        ]);
    }


    /********************************  Partner API Ends Here  *****************/





    /**
     * Get Admin Profile
     */
    public function getAdminProfileDetails(Request $request)
    {
        // Get the currently authenticated admin
        $admin = Auth::user();

        if (!$admin) {
            return response()->json([
                'status' => false,
                'message' => 'Admin not authenticated.',
            ], 401);
        }

        // Return the admin's profile details
        return response()->json([
            'status' => true,
            'data' => [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'status' => $admin->status,
                'role' => $admin->role,
                'created_at' => $admin->created_at->toDateTimeString(),
                'updated_at' => $admin->updated_at->toDateTimeString(),
            ],
        ]);
    }


/*******************************************************************************/
/*******************************************************************************/
/************************  Partner Center APIs   *******************************/
/*******************************************************************************/
/*******************************************************************************/

    /**
     * Get All Partner List 
     */
    public function getPartnerCenterList(Request $request){
        // Initialize the query
       $query = PartnerCenter::with(['state', 'district', 'block','partner']);
       //dd(App\Models\PartnerCenter::with(['state', 'district', 'block'])->find(1));


       // Filter by status if provided in the request
       if ($request->has('status')) {
           $query->where('status', $request->status);
       }

       // Sorting logic based on 'sort_by' and 'sort_order' parameters
       if ($request->has('sort_by')) {
           $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
           $sortOrder = $request->input('sort_order', 'asc');  // Default sort order 'asc'
           $query->orderBy($sortBy, $sortOrder);
       }

       // Set the number of items per page from the request, or default to 10
       $perPage = $request->get('per_page', 10);

       // Execute the query and return paginated results
       return $query->paginate($perPage);

   }


    /**
    * Add New Partner In Admin section
    */
   public function addNewPartnerCenter(Request $request){
        // Validate incoming request
        $validator = Validator::make($request->all(), [
           'center_name' => 'required|string|max:255',
           'partner_centers_id' => 'required|string|max:255',
           'email' => 'required|email|unique:partner_centers,email',
           'contact_number' => 'required|string|max:15',
           'password' => 'required|string|max:255',
           'status' => 'required|boolean',
       ]);
       

       if ($validator->fails()) {
           return response()->json([ 'status'=>false,'errors' => $validator->errors()], 422);
       }

       try {
           // Create a new partner
           $partner = PartnerCenter::create([
               'partner_id' => $request->partner_id, // Generate unique partner ID
               'center_name' => $request->center_name,
               'partner_centers_id'=>$request->partner_centers_id,
               'email' => $request->email,
               'contact_number' => $request->contact_number,
               'password' => Hash::make($request->password),
               'status' => $request->status,
               'onboard_date' => now(),
           ]);

           return response()->json([
               'status'=>true,
               'message' => __('messages.partner_center_added_successfully'),
               'partner_center' => $partner,
           ], 201);
       } catch (\Exception $e) {
           return response()->json([
               'status'=>false,
               'message' => __('messages.failed_to_add_partner_center'),
               'errors' => $e->getMessage(),
           ], 500);
       }
   }




/**
* Update Partner Data
*/
   public function updatePartnerCenter(Request $request, $partnerId)
   {
      
       $validator = Validator::make($request->all(), [
           'center_name' => 'required|string|max:255',
           'partner_centers_id' => 'required|string|max:255',
           'email' => 'required|email|unique:partner_centers,email,'. $partnerId,
           'contact_number' => 'required|string|max:15',
           'password' => 'required|string|max:255',
           'status' => 'required|boolean',
       ]);
       if ($validator->fails()) {
           return response()->json([
               'status'=>false,
               'errors' => $validator->errors()], 422);
       }
       try {
           // Find the partner by ID
           $partner = PartnerCenter::with(['state','district','block'])->find($partnerId);
           if (!$partner) {
               return response()->json([
                   'status'=>false,
                   'message' => __('messages.partner_center_not_found'),
               ], 404);
           }
       
           // Update partner data
           $partner->update([
               'center_name' => $request->center_name,
               'partner_id' => $request->partner_id,
               'partner_centers_id' => $request->partner_centers_id,
               'email' => $request->email,
               'contact_number' => $request->contact_number,
               'address' => $request->password,
               'status' => $request->status,
           ]);

           $partnerData = PartnerCenter::formatedPartnerCenterData($partner);

           return response()->json([
               'status'=>true,
               'message' => __('messages.partner_center_updated_successfully'),
               'partner' => $partnerData,
           ], 200);
       } catch (\Exception $e) {
           return response()->json([
               'status'=>false,
               'message' => _('message.failed_to_update_partner_center').$e->getMessage(),
               'error' => $e->getMessage(),
           ], 500);
       }
   }








   /**
    * Delete a partner by ID.
    *
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
   public function deletePartnerCenter($id)
   {
       try {
           // Find the partner by ID
           $partner = PartnerCenter::find($id);

           if (!$partner) {
               return response()->json([
                   'status'=>false,
                   'message' => __('messages.partner_center_not_found'),
               ], 404);
           }

           // Delete the partner
           $partner->delete();

           return response()->json([
               'status'=>true,
               'message' => __('messages.partner_center_deleted_successfully'),
           ], 200);
       } catch (\Exception $e) {
           return response()->json([
               'status'=>false,
               'message' => __('messages.failed_to_delete_partner'),
               'error' => $e->getMessage(),
           ], 500);
       }
   }



   

   /**
    * Get Opportunitess Details In Amdin Section
    */
    public function getPartnerCenterDetails(Request $request, $id){
        $partnercenter = PartnerCenter::find($id);
        if (!$partnercenter) {
            return response()->json([
                'status'=>false,
                'message' => __('messages.partner_center_not_found'),
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => __('messages.partner_center_found'),
            'data'=> PartnerCenter::formatedPartnerCenterData($partnercenter)
        ]);
    }
/*******************************************************************************/
/*******************************************************************************/
/************************  Partner Center APIs Ends Here  **********************/
/*******************************************************************************/
/*******************************************************************************/



/*******************************************************************************/
/************************  Opportunities  APIs start Here  **********************/
/*******************************************************************************/


    /**
    * Add New Partner In Admin section
    */
    public function addNewOpportunities(Request $request){
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'opportunities_title'  => 'required|string|max:255', 
            'description'          => 'required|string|max:5000',
            'payout_monthly'       => 'required|numeric|min:0',
            'start_date'           => 'required|date|after_or_equal:today',
            'end_date'             => 'required|date|after:start_date',
            'number_of_openings'   => 'required|integer|min:1',
            'provider_name'        => 'required|string|max:255',
            'incentive'            => 'required|string|max:255',
            'document'             => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240', // File validation rules
        ]);
       

       if ($validator->fails()) {
           return response()->json([ 'status'=>false,'errors' => $validator->errors()], 422);
       }


        // Extract attributes for creating the opportunity
        $attributes = $request->only([
            'description',
            'payout_monthly',
            'end_date',
            'incentive',
            'number_of_openings',
            'provider_name'
        ]);


        // Handle file upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $fileName); // Store the file in public storage
            $attributes['document'] = $fileName;
        }

        // Use firstOrCreate to check for duplicates or create a new opportunity
        $opportunity = Opportunity::firstOrCreate(
            [
                'opportunities_title' => $request->opportunities_title,
                'start_date' => $request->start_date,
            ],
            $attributes
        );


        // Return response based on whether the opportunity was newly created
        if (!$opportunity->wasRecentlyCreated) {
            return response()->json([
                'status' => false,
                'message' => __('messages.the_opportunity_with_title'). "'{$request->opportunities_title}'". __('messages.already_exists'),
            ], 409); // 409 Conflict
        }

        return response()->json([
            'status' => true,
            'message' => __('messages.opportunity_added_successfully'),
            'data'=> Opportunity::getFormatedSingleData($opportunity)
        ]);

    
   }





/**
 * Update the Opportunities Data
 */
   public function updateOpportunities(Request $request, $id)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'opportunities_title'  => 'required|string|max:255',
            'incentive'            => 'required|string|max:255',
            'description'          => 'required|string|max:5000',
            'payout_monthly'       => 'required|numeric|min:0',
            'start_date'           => 'required|date|after_or_equal:today',
            'end_date'             => 'required|date|after:start_date',
            'number_of_openings'   => 'required|integer|min:1',
            'provider_name'        => 'required|string|max:255',
            'document'             => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240', // Optional file
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // Find the opportunity by ID
        $opportunity = Opportunity::find($id);

        if (!$opportunity) {
            return response()->json([
                'status' => false,
                'message' => __('messages.opportunities_not_found'),
            ], 404);
        }

        // Update the opportunity fields
        $opportunity->opportunities_title = $request->opportunities_title;
        $opportunity->description = $request->description;
        $opportunity->payout_monthly = $request->payout_monthly;
        $opportunity->start_date = $request->start_date;
        $opportunity->end_date = $request->end_date;
        $opportunity->incentive = $request->incentive;
        $opportunity->number_of_openings = $request->number_of_openings;
        $opportunity->provider_name = $request->provider_name;

        // Handle document upload if provided
        if ($request->hasFile('document')) {
            // Delete the old file if exists
            if ($opportunity->document) {
                Storage::delete('public/documents/' . $opportunity->document);
            }

            $file = $request->file('document');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $fileName); // Store file in public storage
            $opportunity->document = $fileName; // Update file name in database
        }

        // Save the updated opportunity
        $opportunity->save();

        return response()->json([
            'status' => true,
            'message' => __('messages.opportunity_updated_successfully'),
            'data'=> Opportunity::getFormatedSingleData($opportunity)
        ]);
    }








   /**
    * Delete a partner by ID.
    *
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
   public function deleteOpportunities($id)
   {
       try {
           // Find the partner by ID
           $partner = Opportunity::find($id);

           if (!$partner) {
               return response()->json([
                   'status'=>false,
                   'message' => __('messages.opportunities_not_found'),
               ], 404);
           }

           // Delete the partner
           $partner->delete();

           return response()->json([
               'status'=>true,
               'message' => __('messages.opportunities_deleted_successfully'),
           ], 200);
       } catch (\Exception $e) {
           return response()->json([
               'status'=>false,
               'message' => __('messages.failed_to_opportunities'),
               'error' => $e->getMessage(),
           ], 500);
       }
   }




   /**
     * Get All Partner List 
     */
    public function getOpportunitiesList(Request $request){
        // Initialize the query
       $query = Opportunity::query();

       // Filter by status if provided in the request
       if ($request->has('status')) {
           $query->where('status', $request->status);
       }

       // Sorting logic based on 'sort_by' and 'sort_order' parameters
       if ($request->has('sort_by')) {
           $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
           $sortOrder = $request->input('sort_order', 'asc');  // Default sort order 'asc'
           $query->orderBy($sortBy, $sortOrder);
       }

       // Set the number of items per page from the request, or default to 10
       $perPage = $request->get('per_page', 10);

       // Execute the query and return paginated results
       $opportunitywithPagination =  $query->paginate($perPage);

       return Opportunity::getFormatedData($opportunitywithPagination);

   }





   /**
    * Get Opportunitess Details In Amdin Section
    */
    public function getOpportunitiesDetails(Request $request, $id){
        $opportunity = Opportunity::find($id);
        if (!$opportunity) {
            return response()->json([
                'status'=>false,
                'message' => __('messages.opportunities_not_found'),
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => __('messages.opportunity_found'),
            'data'=> Opportunity::getFormatedSingleData($opportunity)
        ]);
    }

    
/*******************************************************************************/
/************************  Opportunities  APIs end Here  **********************/
/*******************************************************************************/




/*******************************************************************************/
/************************  All Global  APIs Start Here  **********************/
/*******************************************************************************/
public function getDigitalProficiencyLevels(){
   // Fetch the digital proficiency levels using the helper function
   $proficiencyLevels = getDropDownDigitalProficiencyLevels(); // Call the helper function here, not as a method

   return response()->json([
       'status' => true,
       'data' => $proficiencyLevels
   ]);
}


public function getEducationList(){
    // Fetch the digital proficiency levels using the helper function
    $educationlist = getDropDownEducationList(); // Call the helper function here, not as a method
 
    return response()->json([
        'status' => true,
        'data' => $educationlist
    ]);
 }



public function getSpecificationQualificationList(){
    // Fetch the digital proficiency levels using the helper function
    $list = getDropDownSpecificationQualificationList(); // Call the helper function here, not as a method
 
    return response()->json([
        'status' => true,
        'data' => $list
    ]);
 }



public function getServiceOfferedList(){
    // Fetch the digital proficiency levels using the helper function
    $list = getDropDownServiceOfferedList(); // Call the helper function here, not as a method
 
    return response()->json([
        'status' => true,
        'data' => $list
    ]);
 }




public function getLoanTypeList(){
    // Fetch the digital proficiency levels using the helper function
    $list = getDropDownLoanTypeList(); // Call the helper function here, not as a method
 
    return response()->json([
        'status' => true,
        'data' => $list
    ]);
 }




 /**
  * Add New Global Item Into Database Table
  */
  public function addNewGlobalItem(Request $request){
    $validator = Validator::make($request->all(), [
        'global_type' => 'required|string|in:DigitalProficiencyLevel,EducationLevel,SpecificationQualification,ServicesOffered,LoanType',
        'item_name'   => 'required|string|max:1000',
    ]);
    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $globalType = $request->get('global_type'); 
    $item = $request->get('item_name');

    // Dynamically call the addNewItem method
    if (in_array($globalType, ['DigitalProficiencyLevel', 'EducationLevel', 'SpecificationQualification', 'ServicesOffered', 'LoanType'])) {
        $model = 'App\\Models\\' . $globalType; // Dynamically get the model name
        $result = $model::addNewItem($item); // Call the addNewItem method
        // Check if the result is false, meaning the item already exists
        if ($result === false) {
            return response()->json([
                'status' => false,
                'message' => __('messages.item_already_exists')
            ], 422); // Return the duplicate error message
        }
        return response()->json(['status' => true, 'message' => "$globalType " . __('messages.item_added_successfully')]);
    } else {
        return response()->json(['status' => false, 'message' => 'Invalid global type'], 422);
    }

  }




/**
 * Update Global Item 
 */
  public function updateGlobalItem(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'global_type'  => 'required|string|in:DigitalProficiencyLevel,EducationLevel,SpecificationQualification,ServicesOffered,LoanType',
        'status'       => 'required|integer',
        'item_name'    => 'required|string|max:1000',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    $globalType = $request->get('global_type'); 
    $status = $request->get('status');
    $itemName = $request->get('item_name');

    // Dynamically call the updateGlobalItem method
    if (in_array($globalType, ['DigitalProficiencyLevel', 'EducationLevel', 'SpecificationQualification', 'ServicesOffered', 'LoanType'])) {
        $model = 'App\\Models\\' . $globalType; // Dynamically get the model name
        $result = $model::updateGlobalItem($id, $itemName, $status); // Call the updateGlobalItem method
        
        // Check for error message
        if ($result === false) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found'
            ], 404); // Return item not found error
        } elseif ($result === 'Item already exists') {
            return response()->json([
                'status' => false,
                'message' => 'Item already exists'
            ], 422); // Return duplicate error
        }

        return response()->json(['status' => true, 'message' => "$globalType item updated successfully"]);
    } else {
        return response()->json(['status' => false, 'message' => 'Invalid global type'], 422);
    }
}

 

/**
 * Add Pathways To opportunitesd
 */
public function addPathwaysToOpportunitiesd(Request $request){
    $validator = Validator::make($request->all(), [
        'opportunity_id' => 'required|integer',
        'pathway_title' => [
            'required',
            'string',
            'max:5000',
            Rule::unique('pathways')->where(function ($query) use ($request) {
                return $query->where('opportunity_id', $request->opportunity_id);
            })
        ],
        'pathway_order' => [
            'required',
            'integer',
            Rule::unique('pathways')->where(function ($query) use ($request) {
                return $query->where('opportunity_id', $request->opportunity_id);
            })
        ],
        'status' => 'required|integer',
    ]);

    // Extract attributes for creating the opportunity
    $attributes = $request->only([
        'opportunity_id',
        'pathway_title',
        'pathway_order',
        'status'
    ]);

    if ($validator->fails()) {
        return response()->json([ 'status'=>false,'errors' => $validator->errors()], 422);
    }

    try {
        // Create a new partner
        $pathway = Pathway::create([
            'opportunity_id' => $request->opportunity_id, // Generate unique partner ID
            'pathway_title' => $request->pathway_title,
            'pathway_order' => $request->pathway_order,
            'status' => $request->status,
            'created_at' => now(),
        ]);

        return response()->json([
            'status'=>true,
            'message' => __('messages.pathway_added_successfully'),
            'pathway' => $pathway,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'status'=>false,
            'message' => __('messages.failed_to_add_pathway'),
            'error' => $e->getMessage(),
        ], 500);
    }

}


 




   /**
     * Get All Partner List 
     */
    public function getPathwayList(Request $request){
        // Initialize the query
       $query = Pathway::query();

       // Filter by status if provided in the request
       if ($request->has('status')) {
           $query->where('status', $request->status);
       }

       // Sorting logic based on 'sort_by' and 'sort_order' parameters
       if ($request->has('sort_by')) {
           $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
           $sortOrder = $request->input('sort_order', 'asc');  // Default sort order 'asc'
           $query->orderBy($sortBy, $sortOrder);
       }
       $query->where('opportunity_id', $request->get('opportunity_id'));
       // Set the number of items per page from the request, or default to 10
       $perPage = $request->get('per_page', 10);

       // Execute the query and return paginated results
       $pathwaywithPagination =  $query->paginate($perPage);

       return Pathway::getFormateData($pathwaywithPagination);

   }



   /**
    * Update Pathwawy Of Opportunites
    */
    public function updatePathway(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'opportunity_id'  => 'required|integer',
            'pathway_title'   => 'required|string|max:100',
            'pathway_order'   => 'required|integer',
            'status'          => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }
    
        $opportunity_id = $request->get('opportunity_id'); 
        $pathway_title = $request->get('pathway_title'); 
        $pathway_order = $request->get('pathway_order'); 
        $status = $request->get('status');

          // Find the opportunity by ID
          $pathway = Pathway::find($id);

          if (!$pathway) {
              return response()->json([
                  'status' => false,
                  'message' => __('messages.pathway_not_found'),
              ], 404);
          }
  
          // Update the opportunity fields
          $pathway->opportunity_id = $request->opportunity_id;
          $pathway->pathway_title = $request->pathway_title;
          $pathway->pathway_order = $request->pathway_order;
          $pathway->status = $request->status;
          // Save the updated opportunity
          $pathway->save();
  
          return response()->json([
              'status' => true,
              'message' => __('messages.pathway_updated_successfully'),
              'data'=> $pathway
          ]);
    
       

    }

 



   /**
    * Delete a partner by ID.
    *
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
   public function deletePathway($id)
   {
       try {
           // Find the partner by ID
           $pathway = Pathway::find($id);

           if (!$pathway) {
               return response()->json([
                   'status'=>false,
                   'message' => __('messages.pathway_not_found'),
               ], 404);
           }

           // Delete the partner
           $pathway->delete();

           return response()->json([
               'status'=>true,
               'message' => __('messages.pathway_deleted_successfully'),
           ], 200);
       } catch (\Exception $e) {
           return response()->json([
               'status'=>false,
               'message' => __('messages.failed_to_pathway'),
               'error' => $e->getMessage(),
           ], 500);
       }
   }




   /*****
    * Add New Promotional Item
    */
    public function addNewPromotionalItem(Request $request){
        $validator = Validator::make($request->all(), [
            'promotional_descriptions'  => 'required|string',
            'material_file'   => 'required|file|mimes:pdf,doc,docx,jpg,png|max:10240',
            'thumbnail'     => 'required|file|mimes:jpeg,jpg,png|max:10240',
            'banner'     => 'required|file|mimes:jpeg,jpg,png|max:10240',
            'status'          => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        // Find the partner by ID
        // $promotion = Promotion::find($id);

        // if (!$promotion) {
        //     return response()->json([
        //         'status'=>false,
        //         'message' => __('messages.promotion_not_found'),
        //     ], 404);
        // }

        // Extract attributes for creating the opportunity
        $attributes = $request->only([
            'promotional_descriptions',
            'material_file',
            'thumbnail',
            'banner',
            'status'
        ]);


        // Handle file upload
        if ($request->hasFile('material_file')) {
            $file = $request->file('material_file');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/promotion/', $fileName); // Store the file in public storage
            $attributes['material_file'] = json_encode(["file"=>$fileName]);
        }

         // Handle file upload
         if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/promotion/', $fileName); // Store the file in public storage
            $attributes['thumbnail'] = $fileName;
        }

         // Handle file upload
         if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('public/promotion/', $fileName); // Store the file in public storage
            $attributes['banner'] = $fileName;
        }

        // Use firstOrCreate to check for duplicates or create a new opportunity
        $opportunity = Promotion::firstOrCreate(
            [
                'promotional_descriptions' => $request->promotional_descriptions,
                'status' => $request->status,
            ],
            $attributes
        );


        // Return response based on whether the opportunity was newly created
        if (!$opportunity->wasRecentlyCreated) {
            return response()->json([
                'status' => false,
                'message' => __('messages.promotion_recently_added'),
            ], 409); // 409 Conflict
        }

        return response()->json([
            'status' => true,
            'message' => __('messages.promotion_added_successfully'),
            'data'=> Promotion::getFormatedData($opportunity)
        ]);


    }





    /**
     * Get Promotion List
     */
    public function getPromotionList(Request $request){
          // Initialize the query
       $query = Promotion::query();

       // Filter by status if provided in the request
       if ($request->has('status')) {
           $query->where('status', $request->status);
       }

       $query->orderBy('id', 'desc');
       // Sorting logic based on 'sort_by' and 'sort_order' parameters
       if ($request->has('sort_by')) {
           $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
           $sortOrder = $request->input('sort_order', 'desc');  // Default sort order 'asc'
           $query->orderBy($sortBy, $sortOrder);
       }
       // Set the number of items per page from the request, or default to 10
       $perPage = $request->get('per_page', 10);

       // Execute the query and return paginated results
       $pathwaywithPagination =  $query->paginate($perPage);

       return Promotion::getFormatedPaginationData($pathwaywithPagination);

    }




    


   /**
    * Delete a partner by ID.
    *
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
   public function deletePromotion($id)
   {
       try {
           // Find the partner by ID
           $promotion = Promotion::find($id);

           if (!$promotion) {
               return response()->json([
                   'status'=>false,
                   'message' => __('messages.promotion_not_found'),
               ], 404);
           }

            // Delete associated files
            if (!empty($promotion->material_file)) {
                $materialFiles = json_decode($promotion->material_file, true); // Decode JSON properly
                if (is_array($materialFiles)) { // Ensure it's an array
                    foreach ($materialFiles as $file) {
                        $filePath = 'promotion/' . $file; // Construct the file path
                        if (\Storage::exists($filePath)) { // Check if file exists
                            \Log::info($filePath);
                            \Storage::delete($filePath); // Delete the file
                        }
                    }
                }
            }

            if (!empty($promotion->thumbnail)) {
                $thumbnailPath = 'promotion/' . $promotion->thumbnail; // Construct the file path
                if (\Storage::exists($thumbnailPath)) { // Check if file exists
                    \Log::info($thumbnailPath);
                    \Storage::delete($thumbnailPath); // Delete the file
                }
            }

            if (!empty($promotion->banner)) {
                $bannerPath = 'promotion/' . $promotion->banner; // Construct the file path
                if (\Storage::exists($bannerPath)) { // Check if file exists
                    \Log::info($bannerPath);
                    \Storage::delete($bannerPath); // Delete the file
                }
            }
           // Delete the partner
           $promotion->delete();

           return response()->json([
               'status'=>true,
               'message' => __('messages.promotion_deleted_successfully'),
           ], 200);
       } catch (\Exception $e) {
           return response()->json([
               'status'=>false,
               'message' => __('messages.failed_to_promotion'),
               'error' => $e->getMessage(),
           ], 500);
       }
   }




   



/**
 * Update the Opportunities Data
 */
public function updatePromotion(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'promotional_descriptions'  => 'required|string',
        'material_file'   => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:10240',
        'thumbnail'     => 'nullable|file|mimes:jpeg,,jpg,png|max:10240',
        'banner'     => 'nullable|file|mimes:jpeg,jpg,png|max:10240',
        'status'          => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

        // Find the opportunity by ID
        $promotion = Promotion::find($id);

        if (!$promotion) {
            return response()->json([
                'status' => false,
                'message' => __('messages.promotion_not_found'),
            ], 404);
        }

      
    
            // Extract attributes for creating the opportunity
            $attributes = $request->only([
                'promotional_descriptions',
                'material_file',
                'thumbnail',
                'banner',
                'status'
            ]);


            // Handle file upload
            if ($request->hasFile('material_file')) {
                $file = $request->file('material_file');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('public/promotion/', $fileName); // Store the file in public storage
                $attributes['material_file'] = json_encode(["file"=>$fileName]);
            }

            // Handle file upload
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('public/promotion/', $fileName); // Store the file in public storage
                $attributes['thumbnail'] = $fileName;
            }

            // Handle file upload
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->storeAs('public/promotion/', $fileName); // Store the file in public storage
                $attributes['banner'] = $fileName;
            }
            // Update the opportunity fields
            $promotion->promotional_descriptions = $request->promotional_descriptions;
            $promotion->status = $request->status;

            // Save the updated opportunity
            $promotion->save();

        return response()->json([
            'status' => true,
            'message' => __('messages.promotion_updated_successfully'),
            'data'=> Promotion::getFormatedData($promotion),
            
        ]);
}





/*************************** REST API For Yuwwah Sakhi Application ********************/
   
    public function addNewYuwaahSakhi(Request $request){
        //echo "<pre>";
        //print_r($request->all());
        //die;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'contact_number' => 'required|digits:10',
            'email' => 'required|string|email|max:255|unique:yuwaah_sakhi,email',
            'status' => 'required|integer|min:0|max:1',
            'partner_id' => 'required|integer|min:1',
            'partner_center_id' => 'required|integer|min:1',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
        }

        $validatedData = $validator->validated();
        $ysId = generateYuwaahSakhiCode($validatedData['partner_id'],$validatedData['partner_center_id']);
        //dd($ysId );
        //dd($validatedData);
        try {
            // Create a new record
            $yuwaahSakhi = YuwaahSakhi::create([
                'password' => Hash::make('password@123'),
                'sakhi_id'=>generateYuwaahSakhiCode($validatedData['partner_id'],$validatedData['partner_center_id']),
                'name' => $validatedData['name'],
                'email'=>$validatedData['email'],
                'dob'=>'1997-01-01',
                'year_of_exp'=>'0',
                'work_hour_in_day'=>0,
                'education_level'=>1,
                'infrastructure_available'=>'No',
                'specific_qualification'=>0,
                'service_offered'=>'0',
                'digital_proficiency'=>0,
                'district'=>1,
                'state'=>1,
                'city'=>1,
                'contact_number'=> $validatedData['contact_number'],
                'status' => $validatedData['status'],
                'partner_id' => $validatedData['partner_id'],
                'partner_center_id' => $validatedData['partner_center_id'],
                'onboard_date'=>now(),
                'state'=>$request->state_id,
            ]);
            //dd($yuwaahSakhi);
    
            // Return success response
            return response()->json([
                'status' => true,
                'message' => _('messages.yuwaahsakhi_added_successfully'),
                'data' => YuwaahSakhi::getFormatedData($yuwaahSakhi),
            ], 201);
    
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Handle exception and return error response
            return response()->json([
                'status' => false,
                'message' => _('messages.failed_to_add_yuwaahsakhi'),
                'error' => $e->getMessage(),
            ], 500);
        }

       
    }



    
    public function updateYuwaahSakhi(Request $request)
{
    // Validate input fields
    //dd($request->all());
    $validator = Validator::make($request->all(), [
        'id' => 'required|exists:yuwaah_sakhi,id',
        'name' => 'required|string|max:255',
        'contact_number' => 'required|digits:10',
        'email' => 'required|string|email|max:255|unique:yuwaah_sakhi,email,'.$request->id,
        'status' => 'required|integer|min:0|max:1',
        'partner_id' => 'required|integer|min:1',
        'partner_center_id' => 'required|integer|min:1',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    // Retrieve existing record
    $yuwaahSakhi = YuwaahSakhi::findOrFail($request->id);
    
    // Handle file uploads if provided
    $centerPhotoPath = $yuwaahSakhi->center_picture;
    if ($request->hasFile('center_photo')) {
        $centerPhotoPath = $request->file('center_photo')->store('uploads/yuwaah_sakhi', 'public');
    }

    $profilePhotoPath = $yuwaahSakhi->profile_picture;
    if ($request->hasFile('profile_photo')) {
        $profilePhotoPath = $request->file('profile_photo')->store('uploads/yuwaah_sakhi', 'public');
    }
//dd($request->all());
//dd($request->partner_id);
//dd(generateYuwaahSakhiCode($request->partner_id,$request->partner_center_id));
    // Update record
    $yuwaahSakhi->update([
        'name' => $request->name,
        'email' => $request->email,
        'sakhi_id'=>generateYuwaahSakhiCode($request->partner_id,$request->partner_center_id),
        'contact_number' => $request->contact_number,
        'status' => $request->status,
        'partner_id' => $request->partner_id,
        'partner_center_id' => $request->partner_center_id,
        'updated_at' => now(),
        'state'=>$request->state_id,
          ]);

    // Return success response
    return response()->json([
        'status' => true,
        'message' => _('messages.yuwaahsakhi_updated_successfully'),
        'data' => YuwaahSakhi::getFormatedData($yuwaahSakhi),
    ], 200);
}





   /**
    * Delete a partner by ID.
    *
    * @param  int  $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function deleteYuwaahSakhi($id)
    {
        try {
            // Find the partner by ID
            $yuwaahsakhi = YuwaahSakhi::find($id);
 
            if (!$yuwaahsakhi) {
                return response()->json([
                    'status'=>false,
                    'message' => __('messages.yuwaahsakhi_not_found'),
                ], 404);
            }
 
            // Delete the partner
            $yuwaahsakhi->delete();
 
            return response()->json([
                'status'=>true,
                'message' => __('messages.yuwaahsakhi_deleted_successfully'),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'message' => __('messages.yuwaahsakhi_not_found'),
                'error' => $e->getMessage(),
            ], 500);
        }
    }
 




    public function getYuwaahDetails(Request $request, $id){
        $yuwaahSakhi = YuwaahSakhi::find($id);
        if (!$yuwaahSakhi) {
            return response()->json([
                'status'=>false,
                'message' => __('messages.yuwaahsakhi_not_found'),
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => __('messages.yuwaahsakhi_found'),
            'data'=> YuwaahSakhi::getFormatedData($yuwaahSakhi)
        ]);
    }


    public function getYuwaahList(Request $request){
        // Initialize the query
        $query = YuwaahSakhi::query()->with(['Partner', 'PartnerCenter','State','District','Block']);
        // Filter by status if provided in the request
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        // Sorting logic based on 'sort_by' and 'sort_order' parameters
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');  // Default sort by 'id'
            $sortOrder = $request->input('sort_order', 'asc');  // Default sort order 'asc'
            $query->orderBy($sortBy, $sortOrder);
        }
        // Set the number of items per page from the request, or default to 10
        $perPage = $request->get('per_page', 10);
        // Execute the query and return paginated results
        $pathwaywithPagination =  $query->paginate($perPage);
        //dd($pathwaywithPagination);
        return YuwaahSakhi::getFormatedPaginationData($pathwaywithPagination);
    
    }

/*************************** REST API For Yuwwah Sakhi Application ********************/

}
