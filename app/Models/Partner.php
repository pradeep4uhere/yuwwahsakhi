<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Ensure this is imported


class Partner extends Authenticatable
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'partner_id',
        'name',
        'email',
        'password',
        'contact_number',
        'address',
        'state_id',
        'district_id',
        'block_id',
        'pincode',
        'status',
        'onboard_date',
    ];


    /**
     * All Pater Count For Admin Panel
     */
    public static function getAllCount(){
        return self::count();
    }






    public static function allPartnerList(Request $request){
        $perPage = env('PAGINATION');
        $query = Partner::query()
        ->select('id','partner_id', 'name', 'email', 'contact_number', 'address', 'status', 'onboard_date');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by', 'id');
            $sortOrder = $request->input('sort_order', 'asc');
            $query->orderBy($sortBy, $sortOrder);
        }

        $partners = $query->paginate($perPage);

        return $partners;
    }


    /**
     * Formate the Partner Data
     */
    public static function formatedPartnerData(Partner $partner){
       
        if ($partner) {
            return [
                    'name'=>$partner->name,
                    'partner_id'=>$partner->partner_id,
                    'email'=>$partner->email,
                    'contact_number'=>$partner->contact_number,
                    'status'=>$partner->status,
                    'onboard_date'=>$partner->onboard_date,
                ];
        }
    }



    /**
     * formatedPartnerListData
     */
    public static function formatedPartnerListData(array $partners){
        $data = [];    

            foreach ($partners as $item) {
                
            $data[] = [
                    'id'=>$item->id,
                    'partner_id'=>$item->partner_id,
                    'name'=>$item->name,
                    'email'=>$item->email,
                    'contact_number'=>$item->contact_number,
                    'status'=>$item->status,
                    'onboard_date'=>$item->onboard_date,
                ];
            }
            return $data;
        
    }



    public function partnerCenters()
    {
        return $this->hasMany(PartnerCenter::class, 'partner_id');
    }



    public function YuwwahSakhi()
    {
        return $this->hasMany(YuwaahSakhi::class, 'partner_center_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

}
