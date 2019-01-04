<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventRegistration;

class EventRegistrationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $event_regs = EventRegistration::with('event', 'user')
                        ->where('is_reg_success', true)->get();
        $data = [
          'active_menu' => 'event_regs',
          'event_regs' => $event_regs
        ];
        return view('admin.eventregs_index', $data);
    }

}
