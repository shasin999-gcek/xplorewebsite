<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    //

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function college()
    {
        return $this->belongsTo('App\CollegeList', 'college_id');
    }
}
