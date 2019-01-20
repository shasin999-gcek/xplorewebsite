<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkshopRegistration;
use DB;

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

        $workshop_stats = DB::table('workshops as w')
                               ->join('workshop_registrations as wr', 'w.id', '=', 'wr.workshop_id')
                               ->select(DB::raw('count(*) as count, w.name'))
                               ->where('wr.is_reg_success', true)
                               ->groupBy('w.name')
                               ->orderBy('count', 'desc')
                               ->get();

        $data = [
            'active_menu' => 'workshop_regs',
            'workshop_regs' => $workshop_regs,
            'workshop_stats' => $workshop_stats
        ];

        return view('admin.workshopregs_index', $data);
    }

}
