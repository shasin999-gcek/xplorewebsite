<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkshopRegistration extends Model
{
    //

    protected $fillable = ['user_id', 'workshop_id', 'order_id', 'is_reg_success', 'type'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function workshop()
    {
        return $this->belongsTo('App\Workshop', 'workshop_id');
    }
}
