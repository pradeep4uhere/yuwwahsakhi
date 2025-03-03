<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'promotional_descriptions',
        'material_file',
        'thumbnail',
        'banner',
        'status'
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    

    public static function getFormatedData(Promotion $promotion)
    {
        if ($promotion) {
            return [
                'id' => $promotion->id,
                'promotional_descriptions' => $promotion->promotional_descriptions,
                'material_file' => asset('/storage/promotion/' . $promotion->material_file),
                'thumbnail' => asset('/storage/promotion/' . $promotion->thumbnail),
                'banner' => asset('/storage/promotion/' . $promotion->banner),
                'status' => $promotion->status,
                'created_at'=>$promotion->created_at
            ];
        }
    }



        public static function getFormatedPaginationData($promotionwithPagination)
        {
            // Format each item in the paginated collection
            $formattedData = $promotionwithPagination->getCollection()->map(function ($promotion) {
                return self::getFormatedData($promotion);  // Call the method to format individual opportunity
            });
        
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


}
