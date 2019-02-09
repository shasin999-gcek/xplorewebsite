<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfflineRegistration extends Model
{
    //

    protected $primaryKey = 'order_id';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
