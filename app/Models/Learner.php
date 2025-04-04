<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Learner extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'status',
        'date_of_birth',
        'gender',
        'email',
        'institution',
        'education_level',
        'digital_proficiency',
        'english_knowledge',
        'interested_in_opportunities',
        'opportunity_types',
        'job_mobility',
        'job_kind',
        'job_qualifications',
        'job_timing',
        'experience_years',
        'work_hours_per_day',
        'work_kind',
        'earn_qualifications',
        'business_status',
        'business_description',
    ];

    protected $casts = [
        'opportunity_types' => 'array',
        'job_qualifications' => 'array',
        'earn_qualifications' => 'array',
        'interested_in_opportunities' => 'boolean',
        'date_of_birth' => 'date',
    ];
}
