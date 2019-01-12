<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\EventRegistration;
use App\Payment;

class EventTransactionSuccess extends Mailable
{
    use Queueable, SerializesModels;


    public $orderId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderId)
    {
        //
        $this->orderId = $orderId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $event_reg = EventRegistration::with('user', 'event')->where([
            ['order_id', '=', $this->orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();

        $payment_data = Payment::findOrFail($this->orderId);

        $data = [
            'orderId' => $this->orderId,
            'name' => $event_reg->user->name,
            'email' => $event_reg->user->email,
            'mobileNumber' => $event_reg->user->mobile_number,
            'event' => $event_reg->event->name,
            'paid' => $payment_data->TXNAMOUNT,
        ];

        return $this->subject('Transaction Successfull')->view('mail.trans_success')->with($data);
    }
}
