<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class ServicesOffered extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services_offered';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_name',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


     
    public static function addNewItem($item)
    {

        // Check if item already exists in the database
        if (self::where('service_name', $item)->exists()) {
            return false;
        }

        self::create([
            'service_name' => $item
        ]);
        
        return true;
    }




    public static function updateGlobalItem($id, $newItem, $status)
    {
        // Check if the item exists
        $item = self::find($id);
        if (!$item) {
            return false; // Item not found
        }

        // Check if the new item name already exists
        if (self::where('service_name', $newItem)->exists()) {
            return 'Item already exists'; // Return message if the new item already exists
        }

        // Update the item
        $item->service_name = $newItem;
        $item->status = $status;
        $item->save();
        return true; // Successfully updated
    }
}
