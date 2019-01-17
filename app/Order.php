<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tzsk\Payu\Fragment\Payable;

class Order extends Model
{
    use Payable;
}
