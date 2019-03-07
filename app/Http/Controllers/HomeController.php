<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\EventTransactionSuccess;
use App\Mail\WorkshopTransactionSuccess;
use App\Event;
use App\Workshop;
use App\EventRegistration;
use App\WorkshopRegistration;
use App\Payment;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->isAdmin()) {
           return redirect()->route('admin.dashboard');
       }

       $user = Auth::user();

       // check all payments status

//       $fail_event_regs =  EventRegistration::where([
//         ['user_id', $user->id],
//         ['is_reg_success', false]
//       ])->pluck('order_id');
//
//       $fail_workshop_regs =  WorkshopRegistration::where([
//         ['user_id', $user->id],
//         ['is_reg_success', false]
//        ])->pluck('order_id');
//
//       $orderIds = $fail_event_regs->concat($fail_workshop_regs);
//
//       foreach ($orderIds as $orderId) {
//          if(!Payment::find($orderId))
//          {
//            $status = $this->savePaymentDetails($orderId);
//            if($status == 'E')
//            {
//               Mail::to($user)->send(new EventTransactionSuccess($orderId));
//            }
//            else if($status == 'W')
//            {
//               Mail::to($user)->send(new WorkshopTransactionSuccess($orderId));
//            }
//
//          }
//       }

       $registered_events = $user->s_events;
       $registered_workshops = $user->s_workshops;

       $events = Event::with('category')->get();
       $workshops = Workshop::with('category')->get();

       return view('home', [
           'registered_events' => $registered_events,
           'registered_workshops' => $registered_workshops,
           'currentUser' => $user,
           'events' => $events,
           'workshops' => $workshops,
           'fail' => false
       ]);

    }


    public function addCollege(Request $request)
    {
        $validatedData = $request->validate([
           'college_name' => 'required|max:50'
        ]);

        $authUser = $request->user();
        $authUser->college_name = $validatedData['college_name'];
        $authUser->save();

        return back();
    }

    public function savePaymentDetails($orderId)
    {
      $key = config('services.paytm.key');
      $mid = config('services.paytm.mid');

       // Verify Transaction again by Paytm Transaction api
      // Create an array having all required parameters for status query.
      $requestParamList = array("MID" => $mid, "ORDERID" => $orderId);

      $StatusCheckSum = getChecksumFromArray($requestParamList, $key);

      $requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

      // Call the PG's getTxnStatusNew() function for verifying the transaction status.
      $responseParamList = getTxnStatusNew($requestParamList);
      
      $responseParamList['CURRENCY'] = 'INR';
      $responseParamList['GATEWAYNAME'] = 'UPI';
      $responseParamList['PAYMENTMODE'] = 'UPI';

      unset($responseParamList['REFUNDAMT']);

      Payment::create($responseParamList);

      if($responseParamList['STATUS'] == 'TXN_SUCCESS')
      {
        $e_reg_updated = DB::table('event_registrations')
          ->where('order_id', $orderId)
          ->update(['is_reg_success' => true]);

        $w_reg_updated = DB::table('workshop_registrations')
          ->where('order_id', $orderId)
          ->update(['is_reg_success' => true]);

        return ($e_reg_updated) ? 'E' : 'W';  
      }

      return 'F';
    }
}
