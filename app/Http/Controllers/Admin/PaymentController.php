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
        $data = [
            'active_menu' => 'payments',
            'payments' => $payments
        ];
        return view('admin.payments_index', $data);
    }

    public function show(Payment $payment)
    {

    }
}
