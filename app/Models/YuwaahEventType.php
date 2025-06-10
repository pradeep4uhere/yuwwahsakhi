<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YuwaahEventType extends Model
{
    use HasFactory;

    protected $table = 'yuwaah_event_type';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];
    
}
