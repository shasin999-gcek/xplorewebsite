<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $dates = ['date'];

   // protected $dateFormat = 'Y-m-d\TH:i';

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'event_registrations', 'event_id', 'user_id')
                ->withPivot('user_id', 'event_id', 'order_id', 'is_reg_success');
    }
}
