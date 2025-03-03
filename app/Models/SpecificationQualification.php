<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class SpecificationQualification extends Model
{
    use HasFactory;

    protected $table = 'specification_qualifications';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qualification',
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
        if (self::where('qualification', $item)->exists()) {
            return false;
        }

        self::create([
            'qualification' => $item
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
        if (self::where('qualification', $newItem)->exists()) {
            return 'Item already exists'; // Return message if the new item already exists
        }

        // Update the item
        $item->qualification = $newItem;
        $item->status = $status;
        $item->save();
        return true; // Successfully updated
    }



}
