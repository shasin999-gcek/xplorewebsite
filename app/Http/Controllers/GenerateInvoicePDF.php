<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EventRegistration;
use App\WorkshopRegistration;
use App\Payment;
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

        $event_reg = EventRegistration::with('user', 'event')->where([
            ['order_id', '=', $orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();

        $payment_data = Payment::findOrFail($orderId);

        $data = [
            'orderId' => $orderId,
            'name' => $event_reg->user->name,
            'email' => $event_reg->user->email,
            'mobileNumber' => $event_reg->user->mobile_number,
            'event' => $event_reg->event->name,
            'paid' => $payment_data->TXNAMOUNT,
            'transId' => $payment_data->TXNID,
            'transDate' => $payment_data->TXNDATE,
            'bankName' => $payment_data->BANKNAME
        ];

        $pdf = PDF::loadView('ticket', $data);
        return $pdf->stream($event_reg->event->slug . '-ticket.pdf');

    }

    public function generateWorkshopTicket($orderId)
    {

        $workshop_reg = WorkshopRegistration::with('user', 'workshop')->where([
            ['order_id', '=', $orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();

        $payment_data = Payment::findOrFail($orderId);

        $data = [
            'orderId' => $orderId,
            'name' => $workshop_reg->user->name,
            'email' => $workshop_reg->user->email,
            'mobileNumber' => $workshop_reg->user->mobile_number,
            'event' => $workshop_reg->workshop->name,
            'paid' => $payment_data->TXNAMOUNT,
            'transId' => $payment_data->TXNID,
            'transDate' => $payment_data->TXNDATE,
            'bankName' => $payment_data->BANKNAME
        ];

        $pdf = PDF::loadView('ticket', $data);
        return $pdf->stream($workshop_reg->workshop->slug . '-ticket.pdf');

    }
}
