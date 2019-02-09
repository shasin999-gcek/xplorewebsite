<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventRegistration;
use App\WorkshopRegistration;
use App\Payment;
use App\Payment_Insta;
use PDF;

class GenerateInvoicePDF extends Controller
{
    //

    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function generateEventTicket($orderId)
    {
        $payment_paytm = NULL;
        $paytm_insta = NULL; 

        $event_reg = EventRegistration::with('user', 'event')->where([
            ['order_id', '=', $orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();


        if($event_reg->type != 'ONLINE')
        {
            $data = [
                'orderId' => $orderId,
                'name' => $event_reg->user->name,
                'email' => $event_reg->user->email,
                'mobileNumber' => $event_reg->user->mobile_number,
                'event' => $event_reg->event->name,
                'paid' => ($event_reg->type != 'OFFLINE') ? 0 : $event_reg->event->reg_fee,
                'transId' => 'OFFLINE',
                'transDate' => $event_reg->created_at,
                'bankName' => 'OFFLINE'
            ];
            
            $pdf = PDF::loadView('ticket', $data);
            return $pdf->stream($event_reg->event->slug . '-ticket.pdf');   
        }

        $payment_paytm = Payment::find($orderId);
        if(!$payment_paytm){
            $payment_insta = Payment_Insta::find($orderId);
        }
        
        $data = [
            'orderId' => $orderId,
            'name' => $event_reg->user->name,
            'email' => $event_reg->user->email,
            'mobileNumber' => $event_reg->user->mobile_number,
            'event' => $event_reg->event->name,
            'paid' => ($payment_paytm) ? $payment_paytm->TXNAMOUNT : $payment_insta->amount,
            'transId' => ($payment_paytm) ? $payment_paytm->TXNID : $payment_insta->payment_id,
            'transDate' => ($payment_paytm) ? $payment_paytm->TXNDATE : $payment_insta->created_at,
            'bankName' => ($payment_paytm) ? $payment_paytm->BANKNAME : $payment_insta->billing_instrument
        ];
        
        $pdf = PDF::loadView('ticket', $data);
        return $pdf->stream($event_reg->event->slug . '-ticket.pdf');

    }

    public function generateWorkshopTicket($orderId)
    {
        $payment_paytm = NULL;
        $paytm_insta = NULL; 

        $workshop_reg = WorkshopRegistration::with('user', 'workshop')->where([
            ['order_id', '=', $orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();

        if($workshop_reg->type != 'ONLINE')
        {
            $data = [
                'orderId' => $orderId,
                'name' => $workshop_reg->user->name,
                'email' => $workshop_reg->user->email,
                'mobileNumber' => $workshop_reg->user->mobile_number,
                'event' => $workshop_reg->workshop->name,
                'paid' => ($workshop_reg->type != 'OFFLINE') ? 0 : $workshop_reg->workshop->reg_fee,
                'transId' => 'OFFLINE',
                'transDate' => $workshop_reg->created_at,
                'bankName' => 'OFFLINE'
            ];
            
            $pdf = PDF::loadView('ticket', $data);
            return $pdf->stream($workshop_reg->workshop->slug . '-ticket.pdf');   
        }

        $payment_paytm = Payment::find($orderId);
        if(!$payment_paytm){
            $payment_insta = Payment_Insta::find($orderId);
        }

        $data = [
            'orderId' => $orderId,
            'name' => $workshop_reg->user->name,
            'email' => $workshop_reg->user->email,
            'mobileNumber' => $workshop_reg->user->mobile_number,
            'event' => $workshop_reg->workshop->name,
           'paid' => ($payment_paytm) ? $payment_paytm->TXNAMOUNT : $payment_insta->amount,
            'transId' => ($payment_paytm) ? $payment_paytm->TXNID : $payment_insta->payment_id,
            'transDate' => ($payment_paytm) ? $payment_paytm->TXNDATE : $payment_insta->created_at,
            'bankName' => ($payment_paytm) ? $payment_paytm->TXNDATE : $payment_insta->billing_instrument
        ];

        $pdf = PDF::loadView('ticket', $data);
        return $pdf->stream($workshop_reg->workshop->slug . '-ticket.pdf');

    }
}
