<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use GeoIp2\Database\Reader;
use App\Models\AdminLoginLog;
use Jenssegers\Agent\Agent;

class AdminAuthController extends Controller
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


        $admin = Admin::where('email', $request->email)->first();

         // Check password
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Generate API token
        $token = $admin->createToken('Admin API Token')->plainTextToken;
        // Store token in session for later API requests
        session(['api_token' => $token]);

        //$credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->login($admin)) {
            // Generate API token
            $admin->update(['remember_token' => $token]);

            $ip = $request->ip();
            $agent = new Agent();
            $location = []; // Fetch location using GeoIP or other services
    
            AdminLoginLog::create([
                'admin_id' => Auth::guard('admin')->id(),
                'ip_address' => $ip,
                'device' => $agent->device(),
                'platform' => $agent->platform(),
                'browser' => $agent->browser(),
                'location' => json_encode($location),
                'login_time' => now(),
            ]);
    
            // Authentication passed, redirect to the admin dashboard
            return redirect()->intended('/admin/dashboard');
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
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Authenticate the newly created admin
        Auth::guard('admin')->login($admin);

        // Redirect to the admin dashboard after successful registration
        return redirect('/admin/dashboard');
    }

    /**
     * Handle admin logout.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        // Log out the admin
        Auth::guard('admin')->logout();

        // Redirect to the login page
        return redirect('/admin/login');
    }




    public function loginForm(Request $request){
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/admin/dashboard');
        }
        return view('admin.login');
    }


    public function registerForm(){
        return view('admin.register');
    }
}
