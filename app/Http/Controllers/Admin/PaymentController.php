<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $payments = Payment::all();

        $success_count = Payment::where('STATUS', 'TXN_SUCCESS')->count();
        $failure_count = Payment::where('STATUS', 'TXN_FAILURE')->count();

        $data = [
            'active_menu' => 'payments',
            'payments' => $payments,
            'success_count' => $success_count,
            'failure_count' => $failure_count
        ];

        return view('admin.payments_index', $data);
    }

    public function show(Payment $payment)
    {

    }
}
