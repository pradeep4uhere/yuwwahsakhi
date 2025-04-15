<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Models\YuwaahSakhi;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'email' => ['required', 'email'],
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'education' => ['required', 'integer'],
            'qualification' => ['required', 'integer'],
            'experience' => ['required', Rule::in(['0-1', '1-2', '2-5', '5+'])],
            'work_hours' => ['required', Rule::in(['1-4', '5-8', '8+'])],
            'infrastructure' => ['required', Rule::in(['Yes', 'No'])],
            'loan_type' => ['required', 'integer'],
            'amount' => ['required', 'numeric', 'min:0'],
            'loan_balance' => ['required', 'numeric', 'min:0'],
            'state_id' => ['required', 'integer'],
            'district_id' => ['required', 'integer'],
            'block_id' => ['required', 'integer'],
            'pincode' => ['required', 'integer'],
            'upload_center_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'upload_profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        
            // If needed, you can include email/password too
            // 'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            // 'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            // Custom error messages (optional)
            'upload_center_photo.required' => 'Please upload a center photo.',
            'upload_center_photo.image' => 'The center photo must be an image.',
            'upload_profile_photo.required' => 'Please upload a profile photo.',
            'upload_profile_photo.image' => 'The profile photo must be an image.',
        ]);
    try {
        // Handle image uploads
        $centerPhotoPath = $request->file('upload_center_photo')->store('uploads/center_photos', 'public');
        $profilePhotoPath = $request->file('upload_profile_photo')->store('uploads/profile_photos', 'public');

        $user = YuwaahSakhi::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('Password@123'),
            'contact_number'=> $request->contact_number,
            'dob'=> $request->dob,
            'gender'=> $request->gender,
            'year_of_exp'=> $request->experience,
            'work_hour_in_day'=>$request->work_hours,
            'infrastructure_available'=> $request->infrastructure,
            'loan_type'=> $request->loan_type,
            'loan_amount'=> $request->amount,
            'loan_balance'=> $request->loan_balance,
            'education_level'=> $request->education,
            'qualification_level'=> $request->education,
            'specific_qualification'=>$request->qualification,
            'digital_proficiency'=>$request->digital_proficiency,
            'service_offered'=>$request->serviceofferd,
            'state'=>$request->state_id,
            'district'=>$request->district_id,
            'block_id'=>$request->block_id,
            'pincode'=>$request->pincode,
            'center_photo' => $centerPhotoPath,
            'profile_photo' => $profilePhotoPath,
        ]);

        event(new Registered($user));
        //Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return back()->withInput()->withErrors(['error' => 'Something went wrong. Please try again.'. $errorMessage]);
        }
    }
}
