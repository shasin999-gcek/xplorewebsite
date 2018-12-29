<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function workshops()
    {
        return $this->hasMany('App\Workshop');
    }
}
