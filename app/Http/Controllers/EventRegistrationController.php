<?php

namespace App\Http\Controllers;

use App\Mail\EventTransactionSuccess;
use Illuminate\Http\Request;
use App\Http\Requests\PaytmCallback;
use App\EventRegistration;
use App\Payment;
use App\Event;
use Auth;
use Illuminate\Support\Facades\Mail;


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
    public function store(Request $request)
    {
        $event_id = $request['event_id'];
        $event = Event::findOrFail($event_id);

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
            'MID' => config('services.paytm.mid'),
            'ORDER_ID' => $order_id,
            'CUST_ID' => $user->firebase_uid,
            'TXN_AMOUNT' => $event->reg_fee,
            'CHANNEL_ID' => config('services.paytm.channel_id'),
            'WEBSITE' => config('services.paytm.website'),
            'MOBILE_NO' => $user->mobile_number,
            'EMAIL' => $user->email,
            'INDUSTRY_TYPE_ID' => config('services.paytm.industry_type_id'),
            'CALLBACK_URL' => route('event.payment.callback'),
        ];

        $CHECK_SUM = getChecksumFromArray($PAYTM_POST_PARAMS, config('services.paytm.key'));

        $PAYTM_POST_PARAMS['CHECKSUMHASH'] = $CHECK_SUM;

        $formData = [
            'PAYTM_POST_PARAMS' => $PAYTM_POST_PARAMS,
            'PAYTM_TXN_URL' => config('services.paytm.txn_url'),
        ];

        //dd($formData);
        return view('paytm_redirect', $formData);
    }


    public  function paytmCallback(PaytmCallback $request)
    {
        $key = config('services.paytm.key');
        $mid = config('services.paytm.mid');

        $PAYTM_RESPONSE_PARAMS = $request->validated();

        $view_data = [
            'transId' => $PAYTM_RESPONSE_PARAMS['TXNID'],
            'orderId' => $PAYTM_RESPONSE_PARAMS['ORDERID']
        ];

        $paytm_checksum = $request['CHECKSUMHASH'];
        $is_valid_checksum = verifychecksum_e($PAYTM_RESPONSE_PARAMS, $key, $paytm_checksum);

        if($is_valid_checksum == "TRUE")
        {
            if($request['STATUS'] == 'TXN_SUCCESS')
            {
                $order_id = $PAYTM_RESPONSE_PARAMS["ORDERID"];

                $event_reg = EventRegistration::where('order_id', $order_id)->firstOrFail();
                if(!($event_reg->event->reg_fee == $PAYTM_RESPONSE_PARAMS['TXNAMOUNT']))
                {
                    // Transaction Failure [Doesnt paid the actual amount]
                    // Todo : Redirect to the event page with Transaction Failure message
                    // Incase he lost money ask him to contact web admin
                    $view_data['respMsg'] = "Doesn't Paid actual amount";
                    return view('transerr', $view_data);
                }

                // Verify Transaction again by Paytm Transaction api
                // Create an array having all required parameters for status query.
                $requestParamList = array("MID" => $mid, "ORDERID" => $order_id);

                $StatusCheckSum = getChecksumFromArray($requestParamList, $key);

                $requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

                // Call the PG's getTxnStatusNew() function for verifying the transaction status.
                $responseParamList = getTxnStatusNew($requestParamList);

                // Verify the response

                unset($responseParamList['REFUNDAMT']);
                foreach ($responseParamList as $name => $value)
                {
                    if(isset($PAYTM_RESPONSE_PARAMS[$name]) && $PAYTM_RESPONSE_PARAMS[$name] != $value)
                    {
                        // Transaction failure
                        // Todo: Redirect to the event page with Transaction Failure
                        $view_data['respMsg'] = "Transaction failed due to tampering of data";
                        return view('transerr', $view_data);
                    }
                }

                // when control reaches here Transaction is verifeid
                // update the payment info
                Payment::create($PAYTM_RESPONSE_PARAMS);

                // update the registration as successful
                $user = Auth::user();
                $user->events()->updateExistingPivot($event_reg->event->id, ['is_reg_success' => true]);

                Mail::to($request->user())->send(new EventTransactionSuccess($order_id));

                return redirect()->route('home');
            }
            else
            {
                // Transaction Failure but need to save to db for further assistence
                Payment::create($PAYTM_RESPONSE_PARAMS);
                // Todo : Redirect to the event page with Transaction Failure message
               
                $view_data['respMsg'] = $PAYTM_RESPONSE_PARAMS['RESPMSG'];
                return view('transerr', $view_data);

            }
        }
        else
        {
            // Response is tampered abort with Forbidden repose
            $view_data['respMsg'] = "Tampering detected";
            return view('transerr', $view_data);
        }
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
