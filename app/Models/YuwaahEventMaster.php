<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YuwaahEventMaster extends Model
{
    use HasFactory;


    protected $table = 'yuwaah_event_masters'; // Table name

    protected $fillable = [
        'event_type_id',
        'event_type',
        'event_category',
        'description',
        'eligibility',
        'fee_per_completed_transaction',
        'date_event_created_in_master',
        'status',
        'document_1',
        'document_2',
        'document_3',
    ];



    // Fetch all events
    // public function getAllEvents(){
    //     return  YuwaahEventMaster::all();
    // }


    // Fetch all events
    public static function getAllEvents(){
        return  YuwaahEventMaster::count();
    }

    // Create a new event
    public function addNewEvents(){
        $event = YuwaahEventMaster::create([
            'event_type' => 'Course',
            'event_category' => 'Technology',
            'description' => 'A new coding bootcamp',
            'eligibility' => 'Open for all',
            'fee_per_completed_transaction' => 99.99,
            'date_event_created_in_master' => now(),
        ]);
    }
}
