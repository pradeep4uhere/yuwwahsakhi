<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Partner;
use App\Models\PartnerCenter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use GeoIp2\Database\Reader;
use App\Models\PartnerLoginLog;
use Jenssegers\Agent\Agent;



class PartnerCenterAuthController extends Controller
{
    

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

        // Attempt to log the admin in using the 'admin' guard
        $credentials = $request->only('email', 'password');
     //dd( $credentials);

        if (Auth::guard('partner_center')->attempt($credentials)) {
            $partner = Auth::guard('partner_center')->user(); // Get authenticated partner
            if (!$partner) {
                return back()->withErrors(['error' => 'Authentication failed.']);
            }
            $ip = $request->ip();
            $agent = new Agent();
            $location = []; // Fetch location using GeoIP or other services
            PartnerLoginLog::create([
                'partner_id' => $partner->id,
                'ip_address' => $ip,
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'location' => json_encode($location),
                'login_time' => now(),
            ]);
    
            // Authentication passed, redirect to the admin dashboard
            return redirect()->intended('/partnercenter/dashboard');
        }

        // Authentication failed, return back with error message
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Handle admin registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validate the registration data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin user
        $admin = PartnerCenter::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'partner_id'=> generateRandomCar(5)
        ]);

        // Authenticate the newly created admin
        Auth::guard('partner_center')->login($admin);

        // Redirect to the admin dashboard after successful registration
        return redirect('/partner_center/dashboard');
    }

    /**
     * Handle admin logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        // Log out the admin
        Auth::guard('partner_center')->logout();

        // Redirect to the login page
        return redirect('/partnercenter/login');
    }



    public function loginForm(Request $request){
        if (Auth::guard('partner_center')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/partnercenter/dashboard');
        }
        return view('partner_center.login');
    }


    public function registerForm(){
        return view('partnercenter.register');
    }

}
