<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventRegistration;
use DB;

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

        $event_stats = DB::table('events as e')
                            ->join('event_registrations as er', 'e.id', '=', 'er.event_id')
                            ->select(DB::raw('count(*) as count, sum(e.reg_fee) as online_t_amount, e.name'))
                            ->where([['er.is_reg_success', true], ['er.type', 'ONLINE']])
                            ->groupBy('e.name')
                            ->orderBy('count', 'desc')
                            ->get();

        $event_total =  DB::table('events as e')
                            ->join('event_registrations as er', 'e.id', '=', 'er.event_id')
                            ->select(DB::raw('sum(e.reg_fee) as amount'))
                            ->where([['er.is_reg_success', true], ['er.type', 'ONLINE']])
                            ->first();    

        $data = [
            'active_menu' => 'event_regs',
            'event_regs' => $event_regs,
            'event_stats' => $event_stats,
            'event_total' => $event_total
        ];

        return view('admin.eventregs_index', $data);
    }

}
