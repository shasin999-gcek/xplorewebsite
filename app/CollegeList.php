<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollegeList extends Model
{
    //

    public function users()
    {
        return $this->hasMany('App\UserDetails', 'college_id');
    }
}
