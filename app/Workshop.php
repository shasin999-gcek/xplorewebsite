<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    //
    protected $dates = ['starts_on', 'ends_on'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'workshop_registrations', 'workshop_id', 'user_id')
                ->withPivot('user_id', 'workshop_id', 'order_id', 'is_reg_success');
    }
}
