<?php

namespace App\Http\Controllers;

use App\Event;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Requests\PaytmCallback;
use App\EventRegistration;
use Auth;

class PaymentController extends Controller
{
    //

    public function __construct()
    {
       $this->middleware('auth');
    }

    public  function paytmCallback(PaytmCallback $request)
    {
        $key = config('services.paytm.key');
        $mid = config('services.paytm.mid');

        $PAYTM_RESPONSE_PARAMS = $request->validated();

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
                    dd($PAYTM_RESPONSE_PARAMS);
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
                        dd($responseParamList);
                    }
                }

                // when control reaches here Transaction is verifeid
                // update the payment info
                Payment::create($PAYTM_RESPONSE_PARAMS);

                // update the registration as successful
                $user = Auth::user();
                $user->events()->updateExistingPivot($event_reg->event->id, ['is_reg_success' => true]);

                return redirect()->route('home');
            }
            else
            {
                // Transaction Failure but need to save to db for further assistence
                Payment::create($PAYTM_RESPONSE_PARAMS);
                // Todo : Redirect to the event page with Transaction Failure message
               dd($PAYTM_RESPONSE_PARAMS);

            }
        }
        else
        {
            // Response is tampered abort with Forbidden repose
            dump($PAYTM_RESPONSE_PARAMS);
            dd($is_valid_checksum);
        }
    }
}
