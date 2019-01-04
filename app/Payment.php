<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $primaryKey = 'ORDERID';

    public $incrementing = false;

    protected $fillable = [
        'ORDERID',
        'CUST_ID',
        'TXNID',
        'BANKTXNID',
        'TXNAMOUNT',
        'CURRENCY',
        'STATUS',
        'RESPCODE',
        'RESPMSG',
        'TXNDATE',
        'GATEWAYNAME',
        'BANKNAME',
        'PAYMENTMODE',
        'BIN_NUMBER',
        'CARD_LAST_NUMS',
    ];

    public $timestamps = false;

    protected $dates = ['TXNDATE'];

    protected function getDateFormat()
    {
        return 'Y-m-d H:i:s.u';
    }

}

