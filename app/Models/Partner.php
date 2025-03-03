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
        'status',
        'onboard_date',
    ];


    public static function allPartnerList(Request $request){
        $perPage = env('PAGINATION');
        $query = Partner::query()
        ->select('id', 'name', 'email', 'contact_number', 'address', 'status', 'onboard_date');

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
                    'email'=>$partner->email,
                    'contact_number'=>$partner->contact_number,
                    'address'=>$partner->address,
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
                    'name'=>$item->name,
                    'email'=>$item->email,
                    'contact_number'=>$item->contact_number,
                    'address'=>$item->address,
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

}
