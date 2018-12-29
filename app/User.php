<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Uuid;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'mobile_number',
        'referred_by',
        'password', 
        'needs_accomadation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($user) {
            $user->referral_id = (string) Uuid::generate(4);
        });
    }

    public function isAdmin() 
    {
        return $this->is_admin;
    }

    public static function isReferralIdValid($referral_id)
    {
        return self::where('referral_id', $referral_id)->count() ? true : false;
    }

}
