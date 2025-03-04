<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerCenter extends Model
{
    use HasFactory;

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
        'district',
        'city',
        'state',
        'status',
        'address',
        'password',
        'onboard_date',
    ];



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
        if ($partner) {
            return [
                    'id'=>$partner->id,
                    'center_name'=>$partner->center_name,
                    'partner_id'=>$partner->partner_id,
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
                    'onboard_date'=>$partner->onboard_date,
                ];
        }
    }




    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }

}
