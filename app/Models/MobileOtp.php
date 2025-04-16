<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOtp extends Model
{
    use HasFactory;

    protected $table = 'mobile_otps';

    protected $fillable = [
        'mobile_number',
        'otp',
        'expires_at',
        'is_verified'
    ];
}
