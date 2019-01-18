<?php

namespace App\Http\Controllers;

use App\Mail\WorkshopTransactionSuccess;
use App\Mail\WorkshopTransactionInstaSuccess;
use Illuminate\Http\Request;
use App\Http\Requests\PaytmCallback;
use App\WorkshopRegistration;
use App\Payment;
use App\Workshop;
use Auth;
use Illuminate\Support\Facades\Mail;
use DB;
use DateTime;
use App\Payment_Insta;

class WorkshopRegistrationController extends Controller
{
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
        $workshop_id = $request['workshop_id'];
        $workshop = Workshop::findOrFail($workshop_id);

        // get authenticated user
        $user = Auth::user();
        $workshop_id = $workshop->id;
        $user_id = $user->id;
        $order_id = 'XPLR' . uniqid();

        WorkshopRegistration::create([
            'user_id' => $user_id,
            'workshop_id' => $workshop_id,
            'order_id' => $order_id,
        ]);

        $PAYTM_POST_PARAMS = [
            'MID' => config('services.paytm.mid'),
            'ORDER_ID' => $order_id,
            'CUST_ID' => $user->firebase_uid,
            'TXN_AMOUNT' => $workshop->reg_fee,
            'CHANNEL_ID' => config('services.paytm.channel_id'),
            'WEBSITE' => config('services.paytm.website'),
            'MOBILE_NO' => $user->mobile_number,
            'EMAIL' => $user->email,
            'INDUSTRY_TYPE_ID' => config('services.paytm.industry_type_id'),
            'CALLBACK_URL' => route('workshop.payment.callback'),
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
            'orderId' => $PAYTM_RESPONSE_PARAMS['ORDERID'],
            'route' => 'workshop.register',
            'name' => 'workshop_id',
            'value' => 0
        ];

        $order_id = $PAYTM_RESPONSE_PARAMS["ORDERID"];
        $workshop_reg = WorkshopRegistration::where('order_id', $order_id)->firstOrFail();
        $view_data['value'] = $workshop_reg->workshop_id;

        $paytm_checksum = $request['CHECKSUMHASH'];
        $is_valid_checksum = verifychecksum_e($PAYTM_RESPONSE_PARAMS, $key, $paytm_checksum);

        if($is_valid_checksum == "TRUE")
        {
            if($request['STATUS'] == 'TXN_SUCCESS')
            {

                if(!($workshop_reg->workshop->reg_fee == $PAYTM_RESPONSE_PARAMS['TXNAMOUNT']))
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
//                $user = Auth::user();
//                $user->workshops()->updateExistingPivot($workshop_reg->workshop->id, ['is_reg_success' => true]);

                DB::table('workshop_registrations')
                    ->where('order_id', $order_id)
                    ->update(['is_reg_success' => true]);

                Mail::to($request->user())->send(new WorkshopTransactionSuccess($order_id));

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

    public function storeInsta(Request $request)
    {
        $workshop_id = $request['workshop_id'];
        $workshop = Workshop::findOrFail($workshop_id);

        // get authenticated user
        $user = Auth::user();
        $workshop_id = $workshop->id;
        $user_id = $user->id;
        $order_id = 'XPLR' . uniqid();

        WorkshopRegistration::create([
            'user_id' => $user_id,
            'workshop_id' => $workshop_id,
            'order_id' => $order_id,
        ]);
        
        
        $key = 'X-Api-Key:'.config('services.instamojo.api_key');
        $token = 'X-Auth-Token:'.config('services.instamojo.api_token');

        $INSTA_POST_PARAMS = [
            'purpose' => $order_id,
            'amount' => $workshop->reg_fee, # Amount to be charged.
            'buyer_name' => $user->name, # Payee Name.
            'email' => $user->email, # Payee Email Address.
            'phone' => $user->mobile_number,
            'redirect_url' => route('workshop.insta.callback','order_id='.$order_id),
            'send_email' => false,
            
            'send_sms' => false,
            'allow_repeated_payments' => false
        ];

        $ch = curl_init();

        // For Live Payment
        // curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
        // For Test payment
      //  curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');

        curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/'.$request->get('payment_id'));
        if(config('services.instamojo.api_env') == "PROD"){
            curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/'.$request->get('payment_id'));
        }

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
            'route' => 'workshop.register-insta',
            'name' => 'workshop_id',
            'value' => 0
        ];

        $order_id = $request->get('order_id');
        $workshop_reg = WorkshopRegistration::where('order_id', $order_id)->firstOrFail();
        $view_data['value'] = $workshop_reg->workshop_id;

       // $MAC_PROVIDED = $INSTA_RESPONSE_PARAMS['mac'];
       // unset($INSTA_RESPONSE_PARAMS['mac']);
       // $MAC_CALCULATED = checkMAC($INSTA_RESPONSE_PARAMS,$salt);

        if($response['success'] == true)
        {
            if($INSTA_RESPONSE_PARAMS['status'] == 'Credit')
            {

                if(!($workshop_reg->workshop->reg_fee == $INSTA_RESPONSE_PARAMS['amount']))
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
                // $user->workshops()->updateExistingPivot($workshop_reg->workshop->id, ['is_reg_success' => true]);

                DB::table('workshop_registrations')
                    ->where('order_id', $order_id)
                    ->update(['is_reg_success' => true]);

                Mail::to($INSTA_RESPONSE_PARAMS['buyer_email'])->send(new WorkshopTransactionInstaSuccess($order_id));

                return redirect()->route('home');
            }
            else
            {
                // Transaction Failure but need to save to db for further assistence
                Payment_Insta::create($INSTA_RESPONSE_PARAMS);
                // Todo : Redirect to the workshop page with Transaction Failure message
               
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



    /**
     * Display the specified resource.
     *
     * @param  \App\WorkshopRegistration  $workshopRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(WorkshopRegistration $workshopRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WorkshopRegistration  $workshopRegistration
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkshopRegistration $workshopRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WorkshopRegistration  $workshopRegistration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkshopRegistration $workshopRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WorkshopRegistration  $workshopRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkshopRegistration $workshopRegistration)
    {
        //
    }
}
