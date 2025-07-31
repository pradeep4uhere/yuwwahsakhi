<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class YhubLearner extends Model
{
    use HasFactory;

    protected $table = 'yhub_learners';

    protected $fillable = [
        'country',
        'user_id',
        'first_name',
        'last_name',
        'email_address',
        'gender',
        'role',
        'grade',
        'state',
        'district',
        'school',
        'course_name',
        'completion_status',
        'course_end_datetime',
        'completion_percent',
        'load_date',
    ];

    protected $casts = [
        'course_end_datetime' => 'datetime',
        'load_date' => 'date',
        'completion_status' => 'boolean',
    ];


    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }


    public function scopeMatchedWithLearners($query)
    {
        return $query->whereExists(function ($q) {
            $q->select(DB::raw(1))
            ->from('learners')
            ->whereRaw("RIGHT(learners.primary_phone_number, 10) = RIGHT(yhub_learners.primary_contact_number, 10)");
        });
    }
}
