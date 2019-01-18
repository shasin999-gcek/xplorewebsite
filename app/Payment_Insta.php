<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_Insta extends Model
{
    protected $table = 'payment_instas';

    protected $primaryKey = 'order_id';

    public $incrementing = false;

    protected $fillable = [
    "order_id",
    "payment_id",
    "quantity",
    "status",
    "buyer_name",
    "buyer_phone",
    "buyer_email",
    "currency",
    "unit_price",
    "amount",
    "fees",
    "instrument_type",
    "billing_instrument",
    "failure", 
    "created_at",
    ];

    public $timestamps = false;

    protected $dates = ['created_at'];

    protected function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }
}
