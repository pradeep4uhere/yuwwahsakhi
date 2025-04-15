<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventAssigned extends Model
{
    use HasFactory;


    protected $table = 'event_assigned';

    protected $fillable = [
        'event_id',
        'learner_id',
        'yuwah_sakhi_id',
        'assigned_date',
        'is_deleted',
    ];

    // If you're using Laravel's soft deletes, you can enable this:
    // use Illuminate\Database\Eloquent\SoftDeletes;
    // protected $dates = ['deleted_at'];

    /**
     * Relationship: EventAssigned belongs to an EventTransaction
     */
    public function eventTransaction()
    {
        return $this->belongsTo(EventTransaction::class, 'event_id');
    }

}
