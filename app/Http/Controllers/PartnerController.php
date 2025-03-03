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
use Illuminate\Support\Facades\Validator;




class PartnerController extends Controller
{

    public $dir = 'partner';

    /**
     * Display the user's profile form.
     */
    public function dashboard(Request $request)
    {
        return view('partner.dashboard', [
            'title' => 'Dashboard',
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
        $partnerCenter = PartnerCenter::paginate();
        $fotmatedPartnerCenterlList = PartnerCenter::getFormatedPaginationData($partnerCenter);
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
        $opportunity = Opportunity::find($id);
       // dd($opportunity);
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
    

}
