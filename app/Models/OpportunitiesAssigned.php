<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpportunitiesAssigned extends Model
{
    use HasFactory;
    protected $table = 'opportunities_assigned';

    protected $fillable = [
        'opportunites_id',
        'learner_id',
        'yuwah_sakhi_id',
        'assigned_date'
    ];

    // Optional: relationships
    public function opportunity()
    {
        return $this->belongsTo(Opportunity::class, 'opportunity_id');
    }

    public function learner()
    {
        return $this->belongsTo(User::class, 'learner_id'); // Assuming learners are stored in users table
    }

    public function assigner()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
