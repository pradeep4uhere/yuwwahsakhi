<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTransaction extends Model
{
    use HasFactory;

    protected $table = 'event_transactions';

    protected $fillable = [
        'learner_id',
        'beneficiary_phone_number',
        'beneficiary_name',
        'event_type',
        'event_id',
        'event_category',
        'event_name',
        'event_date_created',
        'event_date_submitted',
        'event_value',
        'ys_id',
        'uploaded_doc_links',
        'comment',
        'document_type'
    ];

    protected $casts = [
        'event_date_created' => 'date',
        'event_date_submitted' => 'date',
        'event_value' => 'decimal:2',
    ];


    public function Event()
    {
        return $this->belongsTo(YuwaahEventMaster::class, 'event_id'); // Assuming learners are stored in users table
    }


    public function EventType()
    {
        return $this->belongsTo(YuwaahEventType::class, 'event_type'); // Assuming learners are stored in users table
    }



    /**
     * Relationship: EventTransaction has many EventAssigned
     */
    public function assignedEvents()
    {
        return $this->hasMany(EventAssigned::class, 'event_id');
    }

    public function learner()
    {
        return $this->belongsTo(Learner::class, 'learner_id');
    }

    
}
