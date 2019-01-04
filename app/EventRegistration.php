<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    //

    protected $fillable = ['user_id', 'event_id', 'order_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id');
    }
}

