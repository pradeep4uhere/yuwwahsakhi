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
        'document', // Store file path or file name here
    ];

     // Define any necessary casts (optional)
     protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];



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
                'opportunities_title' => $opportunity->opportunities_title,
                'description' => $opportunity->description,
                'payout_monthly' => $opportunity->payout_monthly,
                'start_date' => $opportunity->start_date,
                'end_date' => $opportunity->end_date,
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
