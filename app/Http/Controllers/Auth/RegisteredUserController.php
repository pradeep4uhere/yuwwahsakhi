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
use App\Models\MobileOtp;
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
    public function store(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'ysid' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'email'],
            // 'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            // 'education' => ['required', 'integer'],
            // 'qualification' => ['required', 'integer'],
            // 'experience' => ['required', Rule::in(['0-1', '1-2', '2-5', '5+'])],
            // 'work_hours' => ['required', Rule::in(['1-4', '5-8', '8+'])],
            // 'infrastructure' => ['required', Rule::in(['Yes', 'No'])],
            // 'loan_type' => ['required', 'integer'],
            // 'amount' => ['required', 'numeric', 'min:0'],
            // 'loan_balance' => ['required', 'numeric', 'min:0'],
            // 'state_id' => ['required', 'integer'],
            // 'district_id' => ['required', 'integer'],
            // 'block_id' => ['required', 'integer'],
            // 'pincode' => ['required', 'integer'],
            // 'upload_center_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            // 'upload_profile_photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            // If needed, you can include email/password too
            // 'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            // 'password' => ['required', 'confirmed', Password::defaults()],
        ], 
            [
            //     // Custom error messages (optional)
                'ysid.required' => 'Please Enter Valid YS ID',
                'mobile.required' => 'Please Enter Valid Mobile Number',
            //     'upload_profile_photo.required' => 'Please upload a profile photo.',
            //     'upload_profile_photo.image' => 'The profile photo must be an image.',
            ]
        );
    try {
        //Validate User Based On YS ID and Mobile Number
        $userDetails = YuwaahSakhi::where('sakhi_id',$request->ysid)->where('contact_number',$request->mobile)->first();
        $mobile = $userDetails['contact_number'];
        $otp = rand(100000, 999999);
        event(new \App\Events\GenerateOtp($mobile, $otp));
        return redirect()->route('verify.mobile.register', ['id' => $mobile]);
        //return view('auth.verify_mobile_register',['userDetails'=>$userDetails]);
        
        //dd($userDetails);
        // Handle image uploads
        // $centerPhotoPath = $request->file('upload_center_photo')->store('uploads/center_photos', 'public');
        // $profilePhotoPath = $request->file('upload_profile_photo')->store('uploads/profile_photos', 'public');
        // $sakhiId = 'YS' . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
        // $user = YuwaahSakhi::create([
        //     'name' => $request->name,
        //     'sakhi_id'=>$sakhiId,
        //     'email' => $request->email,
        //     'password' => Hash::make('Password@123'),
        //     'contact_number'=> $request->contact_number,
        //     'dob'=> $request->dob,
        //     'gender'=> $request->gender,
        //     'year_of_exp'=> $request->experience,
        //     'work_hour_in_day'=>$request->work_hours,
        //     'infrastructure_available'=> $request->infrastructure,
        //     'loan_type'=> $request->loan_type,
        //     'loan_amount'=> $request->amount,
        //     'loan_balance'=> $request->loan_balance,
        //     'education_level'=> $request->education,
        //     'qualification_level'=> $request->education,
        //     'specific_qualification'=>$request->qualification,
        //     'digital_proficiency'=>$request->digital_proficiency,
        //     'service_offered'=>$request->serviceofferd,
        //     'state'=>$request->state_id,
        //     'district'=>$request->district_id,
        //     'block_id'=>$request->block_id,
        //     'pincode'=>$request->pincode,
        //     'center_photo' => $centerPhotoPath,
        //     'profile_photo' => $profilePhotoPath,
        // ]);

        //event(new Registered($user));
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return back()->withInput()->withErrors(['error' => 'Something went wrong. Please try again.'. $errorMessage]);
        }
    }



    public function verifyMobileOTPScreen(Request $request){
        $mobile = $request->query('id');
        return view('auth.verify_mobile_register',['mobile'=>$mobile]);
    }



    public function verifyMobileNumber(Request $request){
       $mobile = $request->get('mobile');
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
        //dd($mobileOTPDetails);
        if ($mobileOTPDetails) {
            // Update the OTP status to verified
            $mobileOTPDetails->is_verified = 1;
            $mobileOTPDetails->save();
            // 🔥 Fire OTP Verified Event
            event(new \App\Events\OtpVerified($mobileOTPDetails));
            $yuwaahSakhiDetails = YuwaahSakhi::where('contact_number',$mobile)->where('status',0)->first();
            if($yuwaahSakhiDetails){
                return view('auth.register_process',['mobile'=>$mobile]);
            }else{
                return back()->withInput()->withErrors(['error' => 'User Already Registred.']);
            }
        }else{
            return back()->withInput()->withErrors(['error' => 'Invalid OTP, Please enter correct OTP.']);
        }
    }


    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registrationProcess(Request $request)
    {
        $mobile = $request->get('mobile');
        $email = $request->get('email');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');

        // Find user by mobile number
        $user = YuwaahSakhi::where('contact_number', $mobile)->first();
        if (!$user) {
            return back()->withErrors(['mobile' => 'No user found with this mobile number.'])->withInput();
        }

        // Check if email is already used by another user
        $emailExists = YuwaahSakhi::where('email', $email)
        ->where('id', '!=', $user->id)
        ->exists();

        if ($emailExists) {
            return back()->withErrors(['email' => 'This email address is already registered.'])->withInput();
        }
        $error = '';
        if($password==$password_confirmation){
            // Update user info
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->save();
            return redirect()->route('login')->withSuccess(['rsuccess' => 'User Register Successfully.']);
        }else{
            $error = "Password did not matached.";
            return view('auth.register_process',[
                'mobile'=>$mobile,
                'error'=>$error
            ]);
        }
    }
}
