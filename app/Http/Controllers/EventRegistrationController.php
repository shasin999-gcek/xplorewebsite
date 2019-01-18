<?php

namespace App\Http\Controllers;

use App\Mail\EventTransactionSuccess;
use App\Mail\EventTransactionInstaSuccess;
use Illuminate\Http\Request;
use App\Http\Requests\PaytmCallback;
use App\EventRegistration;
use App\Payment;
use App\Event;
use App\Payment_Insta;
use Auth;
use Illuminate\Support\Facades\Mail;
use DB;
use Tzsk\Payu\Facade\PaymentPayu;
use DateTime;

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
        $order_id = 'XPLR' . uniqid();

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

    public function storePayu(Request $request) 
    {
        $event_id = $request['event_id'];
        $event = Event::findOrFail($event_id);

        // get authenticated user
        $user = Auth::user();
        $event_id = $event->id;
        $user_id = $user->id;
        $order_id = 'XPLR' . uniqid();

        EventRegistration::create([
            'user_id' => $user_id,
            'event_id' => $event_id,
            'order_id' => $order_id,
        ]);

        $PAYU_POST_PARAMS = [
            'txnid' => $order_id, # Transaction ID.
            'amount' => $event->reg_fee, # Amount to be charged.
            'productinfo' => $event->name,
            'firstname' => $user->name, # Payee Name.
            'email' => $user->email, # Payee Email Address.
            'phone' => $user->mobile_number, # Payee Phone Number.
        ];
        
        return PaymentPayu::make($PAYU_POST_PARAMS, function ($then) {
            $then->redirectTo('payu.callback');
        });
    }

    public function payuCallback(Request $request) 
    {
        $payment = Payment::capture();

        $data = $payment->getData();
        dd($data);
    }

    public function storeInsta(Request $request)
    {
        $event_id = $request['event_id'];
        $event = Event::findOrFail($event_id);

        // get authenticated user
        $user = Auth::user();
        $event_id = $event->id;
        $user_id = $user->id;
        $order_id = 'XPLR' . uniqid();

        EventRegistration::create([
            'user_id' => $user_id,
            'event_id' => $event_id,
            'order_id' => $order_id,
        ]);
        
        
        $key = 'X-Api-Key:'.config('services.instamojo.api_key');
        $token = 'X-Auth-Token:'.config('services.instamojo.api_token');

        $INSTA_POST_PARAMS = [
            'purpose' => $order_id,
            'amount' => $event->reg_fee, # Amount to be charged.
            'buyer_name' => $user->name, # Payee Name.
            'email' => $user->email, # Payee Email Address.
            'phone' => $user->mobile_number,
            'redirect_url' => route('event.insta.callback','order_id='.$order_id),
            'send_email' => false,
            
            'send_sms' => false,
            'allow_repeated_payments' => false
        ];

        $ch = curl_init();

        // For Live Payment
        // curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
        // For Test payment
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array($key,$token));
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($INSTA_POST_PARAMS));
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 
        
        if ($err) {
            return redirect()->back();
        } else {
            $data = json_decode($response);
        }


        if($data->success == true) {
            return redirect($data->payment_request->longurl);
        } else {
            return redirect()->back();
        }
    }

    public function instaCallback(Request $request)
    {
        $key = 'X-Api-Key:'.config('services.instamojo.api_key');
        $token = 'X-Auth-Token:'.config('services.instamojo.api_token');
        
        $required = [
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
        if(config('services.instamojo.api_env') == "PROD"){
            curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payments/'.$request->get('payment_id'));
        }
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array($key,$token));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch); 


        $salt = config('services.instamojo.api_salt');
        $response = json_decode($response,true);
        $paymentresponse = $response['payment'];
        $INSTA_RESPONSE_PARAMS['order_id'] = $request->get('order_id');
        
        foreach($required as $r) {
            $INSTA_RESPONSE_PARAMS[$r] = $paymentresponse[$r];
        }
        $INSTA_RESPONSE_PARAMS['created_at'] = DateTime::createFromFormat('Y-m-d\TH:i:s.uO', $paymentresponse['created_at']);        
        
        $view_data = [
            'transId' => $INSTA_RESPONSE_PARAMS['payment_id'],
            'orderId' => $INSTA_RESPONSE_PARAMS['order_id'],
            'route' => 'event.register-insta',
            'name' => 'event_id',
            'value' => 0
        ];

        $order_id = $request->get('order_id');
        $event_reg = EventRegistration::where('order_id', $order_id)->firstOrFail();
        $view_data['value'] = $event_reg->event_id;

       // $MAC_PROVIDED = $INSTA_RESPONSE_PARAMS['mac'];
       // unset($INSTA_RESPONSE_PARAMS['mac']);
       // $MAC_CALCULATED = checkMAC($INSTA_RESPONSE_PARAMS,$salt);

        if($response['success'] == true)
        {
            if($INSTA_RESPONSE_PARAMS['status'] == 'Credit')
            {

                if(!($event_reg->event->reg_fee == $INSTA_RESPONSE_PARAMS['amount']))
                {
                    // Transaction Failure [Doesnt paid the actual amount
                    // Incase he lost money ask him to contact web admin
                    $view_data['respMsg'] = "Didn't Pay the actual amount";
                    return view('transerr', $view_data);
                }


                // when control reaches here Transaction is verifeid
                // update the payment info
                Payment_Insta::create($INSTA_RESPONSE_PARAMS);

                // update the registration as successful
                // $user = Auth::user();
                // $user->events()->updateExistingPivot($event_reg->event->id, ['is_reg_success' => true]);

                DB::table('event_registrations')
                    ->where('order_id', $order_id)
                    ->update(['is_reg_success' => true]);

                Mail::to($INSTA_RESPONSE_PARAMS['buyer_email'])->send(new EventTransactionInstaSuccess($order_id));

                return redirect()->route('home');
            }
            else
            {
                // Transaction Failure but need to save to db for further assistence
                Payment_Insta::create($INSTA_RESPONSE_PARAMS);
                // Todo : Redirect to the event page with Transaction Failure message
               
                $view_data['respMsg'] = 'Payment Declined';
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

    public function paytmCallback(PaytmCallback $request)
    {
        $key = config('services.paytm.key');
        $mid = config('services.paytm.mid');

        $PAYTM_RESPONSE_PARAMS = $request->validated();

        $view_data = [
            'transId' => $PAYTM_RESPONSE_PARAMS['TXNID'],
            'orderId' => $PAYTM_RESPONSE_PARAMS['ORDERID'],
            'route' => 'event.register',
            'name' => 'event_id',
            'value' => 0
        ];

        $order_id = $PAYTM_RESPONSE_PARAMS["ORDERID"];
        $event_reg = EventRegistration::where('order_id', $order_id)->firstOrFail();
        $view_data['value'] = $event_reg->event_id;

        $paytm_checksum = $request['CHECKSUMHASH'];
        $is_valid_checksum = verifychecksum_e($PAYTM_RESPONSE_PARAMS, $key, $paytm_checksum);

        if($is_valid_checksum == "TRUE")
        {
            if($request['STATUS'] == 'TXN_SUCCESS')
            {

                if(!($event_reg->event->reg_fee == $PAYTM_RESPONSE_PARAMS['TXNAMOUNT']))
                {
                    // Transaction Failure [Doesnt paid the actual amount
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
                        $view_data['respMsg'] = "Transaction failed due to tampering of data";
                        return view('transerr', $view_data);
                    }
                }

                // when control reaches here Transaction is verifeid
                // update the payment info
                Payment::create($PAYTM_RESPONSE_PARAMS);

                // update the registration as successful
                // $user = Auth::user();
                // $user->events()->updateExistingPivot($event_reg->event->id, ['is_reg_success' => true]);

                DB::table('event_registrations')
                    ->where('order_id', $order_id)
                    ->update(['is_reg_success' => true]);

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
