<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\PartnerPlacementUserExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlacementYuwaahSakhiExport;
use DB;
use App\Models\YuwaahSakhi;

use Carbon\Carbon;


class PlacementPartnerAuthController extends Controller
{
    

   

    public function loginForm()
    {
        return view('placementpartner.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('pp_partner')->attempt($credentials)) {
            return redirect()->route('placementpartner.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('pp_partner')->logout();
        return redirect()->route('placementpartner.login');
    }


     /**
     * Display the user's profile form.
     */
    public function dashboard(Request $request)
    {
       
        return view('placementpartner.dashboard', [
            'title' => 'Dashboard',
            'chartsData'=>"",
            'totalCount'=>0,
            'labels'=>"",
            'states'=>'',
            'learnerAgeGroup'=>'',
            'learnerGenderGroup'=>''
        ]);
    }



    public function viewAllFieldCenter(Request $request)
    {
       //All field Center
        $id = Auth::user()->id;
        //$data = YuwaahSakhi::where('partner_placement_user_id',$id)->paginate(50);
        $data = DB::table('yuwaah_sakhi as ys')
        ->leftJoin('partners as p', 'ys.partner_id', '=', 'p.id')
        ->leftJoin('partner_centers as pc', 'ys.partner_center_id', '=', 'pc.id')
        ->select(
            'ys.id',
            'ys.csc_id',
            'ys.sakhi_id',
            'ys.name',
            'ys.contact_number',
            'ys.email',
            'p.partner_id as partnerID',
            'p.name as partner_name',
            'pc.partner_centers_id as partner_division_id',
            'pc.center_name as partner_center_name',
            'ys.profile_picture',
            'ys.status',
            'ys.created_at'
        )
        ->where('partner_placement_user_id', $id)
        ->paginate(50);
        //dd($data );
        return view('placementpartner.fieldCenterList', [
            'title' => 'All Field Center',
            'data'=>$data
        ]);
    }


    public function exportPlacementYuwaahSakhi(Request $request)
    {
        $partnerPlacementUserId = $request->partner_placement_user_id;

        return Excel::download(
            new PlacementYuwaahSakhiExport($partnerPlacementUserId),
            'placement_yuwaah_sakhi_'.date('y_M_d_h_i_s_a').'.xlsx'
        );
    }
    


}
