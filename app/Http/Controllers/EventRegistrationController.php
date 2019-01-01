<?php

namespace App\Http\Controllers;

use App\EventRegistration;
use Illuminate\Http\Request;

use App\Event;
use Auth;


class EventRegistrationController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event)
    {
        // get authenticated user
        $user = Auth::user();
        $event_id = $event->id;
        $user_id = $user->id;
        $order_id = 'ORDS' . uniqid();

        EventRegistration::create([
            'user_id' => $user_id,
            'event_id' => $event_id,
            'order_id' => $order_id,
        ]);

        $PAYTM_POST_PARAMS = [
            'MID' => env('PAYTM_MERCHANT_MID'),
            'ORDER_ID' => $order_id,
            'CUST_ID' => $user->firebase_uid,
            'TXN_AMOUNT' => $event->reg_fee,
            'CHANNEL_ID' => env('PAYTM_MERCHANT_CHANNEL_ID'),
            'WEBSITE' => env('PAYTM_MERCHANT_WEBSITE'),
            'MOBILE_NO' => $user->mobile_number,
            'EMAIL' => $user->email,
            'INDUSTRY_TYPE_ID' => env('PAYTM_MERCHANT_INDUSTRY_TYPE_ID'),
            'CALLBACK_URL' => route('event.payment.callback'),
        ];

        $CHECK_SUM = getChecksumFromArray($PAYTM_POST_PARAMS, env('PAYTM_MERCHANT_KEY'));

        $PAYTM_POST_PARAMS['CHECKSUMHASH'] = $CHECK_SUM;

        $formData = [
            'PAYTM_POST_PARAMS' => $PAYTM_POST_PARAMS,
            'PAYTM_TXN_URL' => env('PAYTM_TXN_URL'),
        ];

        //dd($formData);
        return view('paytm_redirect', $formData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(EventRegistration $eventRegistration)
    {
        //

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(EventRegistration $eventRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventRegistration $eventRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventRegistration  $eventRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventRegistration $eventRegistration)
    {
        //
    }
}
