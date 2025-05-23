<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;

     // Specify the table name if it's different from the default "opportunities"
     protected $table = 'opportunities';

       // Define the fields that are mass assignable
     protected $fillable = [
        'opportunities_title',
        'description',
        'payout_monthly',
        'start_date',
        'end_date',
        'number_of_openings',
        'provider_name',
        'opportunitie_type',
        'incentive',
        'document', // Store file path or file name here
        'sakhi_id',
    ];

     // Define any necessary casts (optional)
     protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];



    /**
     * All Pater Count For Admin Panel
     */
    public static function getAllCount(){
        return self::count();
    }



    public static function getFormatedData($opportunitywithPagination)
    {
        // Format each item in the paginated collection
        $formattedData = $opportunitywithPagination->getCollection()->map(function ($opportunity) {
            return self::getFormatedSingleData($opportunity);  // Call the method to format individual opportunity
        });
    
        return [
            'data' => $formattedData,
            'current_page' => $opportunitywithPagination->currentPage(),
            'per_page' => $opportunitywithPagination->perPage(),
            'total' => $opportunitywithPagination->total(),
            'last_page' => $opportunitywithPagination->lastPage(),
            'next_page_url' => $opportunitywithPagination->nextPageUrl(),
            'prev_page_url' => $opportunitywithPagination->previousPageUrl(),
        ];
    }
    
    public static function getFormatedSingleData(Opportunity $opportunity)
    {
        if ($opportunity) {
            return [
                'id' => $opportunity->id,
                'sakhi_id'=>$opportunity->sakhi_id,
                'opportunities_title' => ucwords($opportunity->opportunities_title),
                'opportunitie_type'=>$opportunity->opportunitie_type,
                'description' => $opportunity->description,
                'payout_monthly' => $opportunity->payout_monthly,
                'start_date' => $opportunity->start_date,
                'end_date' => $opportunity->end_date,
                'incentive'=> $opportunity->incentive,
                'number_of_openings' => $opportunity->number_of_openings,
                'provider_name' => $opportunity->provider_name,
                'document' => asset('/storage/documents/' . $opportunity->document),
                'patheway'=>[]
            ];
        }
    }


    
    public static function getFormatedPaginationData($opportunitywithPagination)
    {
        // Format each item in the paginated collection
        $formattedData = $opportunitywithPagination->getCollection()->map(function ($opportunity) {
            return self::getFormatedSingleData($opportunity);  // Call the method to format individual opportunity
        });
    
        return [
            'data' => $formattedData,
            'current_page' => $opportunitywithPagination->currentPage(),
            'per_page' => $opportunitywithPagination->perPage(),
            'total' => $opportunitywithPagination->total(),
            'last_page' => $opportunitywithPagination->lastPage(),
            'next_page_url' => $opportunitywithPagination->nextPageUrl(),
            'prev_page_url' => $opportunitywithPagination->previousPageUrl(),
        ];
    }
    

}
