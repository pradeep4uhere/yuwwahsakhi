<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PartnerPlacementUser extends Authenticatable
{
    use HasFactory;

    use Notifiable;

    protected $table = 'partner_placement_users';

    protected $fillable = [
        'name', 'email', 'phone', 'pp_code', 'state', 'status', 'district', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];



    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }


      /**
     * All Pater Count For Admin Panel
     */
    public static function getAllCount(){
        return self::count();
    }


    public function sakhiUsers()
    {
        return $this->hasMany(YuwaahSakhi::class, 'partner_placement_user_id');
    }
}
