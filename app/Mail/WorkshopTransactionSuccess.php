<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\WorkshopRegistration;
use App\Payment;

class WorkshopTransactionSuccess extends Mailable
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
        $workshop_reg = WorkshopRegistration::with('user', 'workshop')->where([
            ['order_id', '=', $this->orderId],
            ['is_reg_success', '=', true]
        ])->firstOrFail();

        $payment_data = Payment::findOrFail($this->orderId);

        $data = [
            'orderId' => $this->orderId,
            'name' => $workshop_reg->user->name,
            'email' => $workshop_reg->user->email,
            'mobileNumber' => $workshop_reg->user->mobile_number,
            'event' => $workshop_reg->workshop->name,
            'paid' => $payment_data->TXNAMOUNT,
        ];

        return $this->subject('Transaction Successfull')->view('mail.trans_success')->with($data);
    }
}
