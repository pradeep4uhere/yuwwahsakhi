<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YuwaahSakhiSetting extends Model
{
    use HasFactory;
    protected $table = 'yuwaah_sakhi_settings';

    protected $fillable = [
        'home_page_title',
        'description',
        'home_page_banner_type',
        'youtube_url',
        'banners',
    ];
}
