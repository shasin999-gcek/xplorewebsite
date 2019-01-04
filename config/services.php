<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paytm' => [
        'mid' => env('PAYTM_MERCHANT_MID'),
        'key'=> env('PAYTM_MERCHANT_KEY'),
        'website' => env('PAYTM_MERCHANT_WEBSITE', 'WEBSTAGING'),
        'channel_id' => env('PAYTM_MERCHANT_CHANNEL_ID', 'WEB'),
        'industry_type_id' => env('PAYTM_MERCHANT_INDUSTRY_TYPE_ID', 'Retail'),
        'txn_url' => env('PAYTM_TXN_URL', 'https://securegw-stage.paytm.in/theia/processTransaction'),
    ],

];
