<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Payment_Insta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function paytm()
    {
        $payments = Payment::all();

        $success_count = Payment::where('STATUS', 'TXN_SUCCESS')->count();
        $success_amount = Payment::where('STATUS', 'TXN_SUCCESS')->sum('TXNAMOUNT');

        $failure_count = Payment::where('STATUS', 'TXN_FAILURE')->count();
        $failure_amount = Payment::where('STATUS', 'TXN_FAILURE')->sum('TXNAMOUNT');

        $data = [
            'active_menu' => 'payments-paytm',
            'payments' => $payments,
            'success_count' => $success_count,
            'failure_count' => $failure_count,
            'success_amount' => $success_amount,
            'failure_amount' => $failure_amount
        ];

        return view('admin.payments_paytm', $data);
    }

    public function instamojo()
    {
        $payments = Payment_Insta::all();

        $success_count = Payment_Insta::where('status', 'Credit')->count();
        $success_amount = Payment_Insta::where('status', 'Credit')->sum('amount');

        $failure_count = Payment_Insta::where('status', 'Failed')->count();
        $failure_amount = Payment_Insta::where('status', 'Failed')->sum('amount');

        $data = [
            'active_menu' => 'payments-instamojo',
            'payments' => $payments,
            'success_count' => $success_count,
            'failure_count' => $failure_count,
            'success_amount' => $success_amount,
            'failure_amount' => $failure_amount
        ];

        return view('admin.payments_instamojo', $data);
    }
}
