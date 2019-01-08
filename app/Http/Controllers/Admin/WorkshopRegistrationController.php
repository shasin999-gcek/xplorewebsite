<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkshopRegistration;

class WorkshopRegistrationController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $workshop_regs = WorkshopRegistration::with('workshop', 'user')
                        ->where('is_reg_success', true)->get();
        $data = [
          'active_menu' => 'workshop_regs',
          'workshop_regs' => $workshop_regs
        ];
        return view('admin.workshopregs_index', $data);
    }

}
