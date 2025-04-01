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
       
        // Validate the incoming login data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);


        $YuwaahSakhi = YuwaahSakhi::where('email', $request->email)->first();
        //dd($YuwaahSakhi);

         // Check password
        if (!$YuwaahSakhi || !Hash::check($request->password, $YuwaahSakhi->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

         // Generate API token
         $token = $YuwaahSakhi->createToken('YuwaahSakhi API Token')->plainTextToken;
         $YuwaahSakhi->update(['remember_token' => $token]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
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
        return view('profile.edit', [
            'user' => $request->user(),
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
        return view($this->dir.'.dashboard');
    }
}
