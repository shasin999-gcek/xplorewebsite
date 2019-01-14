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
        'firebase_uid',
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

    public function events()
    {
        return $this->belongsToMany('App\Event', 'event_registrations', 'user_id', 'event_id')
            ->withPivot('user_id', 'event_id', 'order_id', 'is_reg_success');
    }

    public function s_events()
    {
        return $this->belongsToMany('App\Event', 'event_registrations', 'user_id', 'event_id')
            ->withPivot('user_id', 'event_id', 'order_id', 'is_reg_success')
            ->wherePivot('is_reg_success', true);
    }


    public function s_events_api()
    {
        return $this->belongsToMany('App\Event', 'event_registrations', 'user_id', 'event_id')
            ->with('category')
            ->withPivot('user_id', 'event_id', 'order_id', 'is_reg_success')
            ->wherePivot('is_reg_success', true);
    }

    public function workshops()
    {
        return $this->belongsToMany('App\Workshop', 'workshop_registrations', 'user_id', 'workshop_id')
            ->withPivot('user_id', 'workshop_id', 'order_id', 'is_reg_success');
    }

    public function s_workshops()
    {
        return $this->belongsToMany('App\Workshop', 'workshop_registrations', 'user_id', 'workshop_id')
            ->withPivot('user_id', 'workshop_id', 'order_id', 'is_reg_success')
            ->wherePivot('is_reg_success', true);
    }

    public function s_workshops_api()
    {
        return $this->belongsToMany('App\Workshop', 'workshop_registrations', 'user_id', 'workshop_id')
            ->with('category')
            ->withPivot('user_id', 'workshop_id', 'order_id', 'is_reg_success')
            ->wherePivot('is_reg_success', true);
    }

}
