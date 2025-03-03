<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Opportunity;


class Pathway extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'opportunity_id',
        'pathway_title',
        'pathway_order',
        'status',
    ];


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;



    public static function getFormateData($pathwayPagination){

        // Ensure the paginated data is not empty
        if ($pathwayPagination->isEmpty()) {
            return [
                'opportunity' => null,
                'pathways' => [],
                'pagination' => $pathwayPagination->toArray()
            ];
        }
        
        // Get the opportunity details from the first pathway
        $opportunityId = $pathwayPagination->first()->opportunity_id;
        $opportunity = self::getOpportunities($opportunityId);

        // Format the pathways
        $pathways = [];
        foreach ($pathwayPagination as $item) {
            $pathways[] = [
                'id' => $item->id,
                'opportunity_id' => $item->opportunity_id,
                'pathway_title' => $item->pathway_title,
                'pathway_order' => $item->pathway_order,
                'status' => $item->status,
            ];
        }

        // Final response
        return [
            'opportunity' => Opportunity::getFormatedSingleData($opportunity),
            'pathways' => $pathways,
            'pagination' => $pathwayPagination->toArray(),
        ];

    }



    public static function getOpportunities($opportunityId)
    {
        
        return Opportunity::find($opportunityId);
    }


}
