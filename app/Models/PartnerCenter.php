<?php

namespace App\Models;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerCenter extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;
    

    protected $table = 'partner_centers'; // Ensure this matches your DB table name
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'partner_id',
        'center_name',
        'email',
        'contact_number',
        'district_id',
        'block_id',
        'state_id',
        'status',
        'address',
        'pincode',
        'password',
        'onboard_date',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


      /**
     * All Pater Count For Admin Panel
     */
    public static function getAllCount(){
        return self::count();
    }



    public static function allPartnerList(Request $request){
        $perPage = env('PAGINATION');
        $query = PartnerCenter::query()
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
    public static function formatedPartnerCenterData(PartnerCenter $partner){
        //dd($partner);
        if ($partner) {
            return [
                    'id'=>$partner->id,
                    'center_name'=>$partner->center_name,
                    'partner_id'=>$partner->partner_id,
                    'email'=>$partner->email,
                    'contact_number'=>$partner->contact_number,
                    'state'=>$partner->state->name ?? 'NA',
                    'district'=>$partner->district->name ?? 'NA',
                    'block'=>$partner->block->name ?? 'NA',
                    'address'=>$partner->address,
                    'status'=>$partner->status,
                    'yuwwah_sakhi_count' => $partner->yuwwah_sakhi_count ?? 0,
                    'onboard_date'=>$partner->onboard_date,
                    'created_at'=>$partner->created_at,
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
                    'state'=>$item->state->name,
                    'status'=>$item->status,
                    'yuwwah_sakhi_count' => $item->yuwwah_sakhi_count ?? 0,
                    'onboard_date'=>$item->onboard_date,
                    'created_at'=>$item->created_at,
                ];
            }
            return $data;
        
    }



    public static function getFormatedPaginationData($promotionwithPagination)
    {
        // Format each item in the paginated collection
        $formattedData = $promotionwithPagination->getCollection()->map(function ($promotion) {
            return self::formatedPartnerCenterData($promotion);  // Call the method to format individual opportunity
        });
    //dd( $formattedData);
        return [
            'data' => $formattedData,
            'current_page' => $promotionwithPagination->currentPage(),
            'per_page' => $promotionwithPagination->perPage(),
            'total' => $promotionwithPagination->total(),
            'last_page' => $promotionwithPagination->lastPage(),
            'next_page_url' => $promotionwithPagination->nextPageUrl(),
            'prev_page_url' => $promotionwithPagination->previousPageUrl(),
        ];
    }


    /**
     * Formate the Partner Data
     */
    public static function getFormatedSingleData(PartnerCenter $partner){
        if ($partner) {
            return [
                    'id'=>$partner->id,
                    'center_name'=>$partner->center_name,
                    'partner_id'=>$partner->partner_id,
                    'email'=>$partner->email,
                    'contact_number'=>$partner->contact_number,
                    'address'=>$partner->address,
                    'status'=>$partner->status,
                    'yuwwah_sakhi_count' => $partner->yuwwah_sakhi_count ?? 0,
                    'onboard_date'=>$partner->onboard_date,
                ];
        }
    }




    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

    public function YuwwahSakhi()
    {
        return $this->hasMany(YuwaahSakhi::class, 'partner_center_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }


}
