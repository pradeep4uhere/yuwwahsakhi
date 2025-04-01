<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YuwaahSakhiLoginLog extends Model
{
    use HasFactory;

    protected $table = 'yuwaah_sakhi_login_logs';

    protected $fillable = [
        'user_id', 'user_type', 'ip_address', 'device', 'platform', 'browser', 'location', 'login_time'
    ];

    protected $casts = [
        'location' => 'array',
        'login_time' => 'datetime',
    ];
}
