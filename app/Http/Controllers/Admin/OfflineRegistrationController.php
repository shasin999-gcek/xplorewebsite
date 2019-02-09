<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\EventRegistration;
use App\WorkshopRegistration;
use App\User;

class OfflineRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $offlineERegs = EventRegistration::with('user', 'event')
                            ->where('type', '!=', 'ONLINE')
                            ->get();

        $offlineWRegs = WorkshopRegistration::with('user', 'workshop')
                            ->where('type', '!=', 'ONLINE')
                            ->get();                    


        $gcekERegs = EventRegistration::where('type', 'GCEK')
                            ->count();

        $gcekWRegs = WorkshopRegistration::where('type', 'GCEK')
                            ->count();                    

        $totalGcekCount =  $gcekERegs + $gcekWRegs;

        $offlineRegs = $offlineERegs->concat($offlineWRegs);

        $e_amount = DB::table('events as e')
                            ->join('event_registrations as er', 'e.id', '=', 'er.event_id')
                            ->select(DB::raw('sum(reg_fee) as total'))
                            ->where([['er.is_reg_success', true], ['er.type', 'OFFLINE']])
                            ->first();

        $w_amount = DB::table('workshops as w')
                            ->join('workshop_registrations as wr', 'w.id', '=', 'wr.workshop_id')
                            ->select(DB::raw('sum(reg_fee) as total'))
                            ->where([['wr.is_reg_success', true], ['wr.type', 'OFFLINE']])
                            ->first();                    
        $data = [
            'active_menu' => 'offline-regs',
            'offlineERegs' => $offlineERegs,
            'offlineWRegs' => $offlineWRegs,
            'e_amount' => $e_amount,
            'w_amount' => $w_amount,
            'gcek_count' => $totalGcekCount,
        ];
        
        return view('admin.offline_reg_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::get(['id', 'email']);

        $data = [
            'active_menu' => 'offline-regs',
            'users' => $users
        ];

        return view('admin.offline_reg_create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'e_w_id' => 'required',
            'type' => 'required',
            'category' => 'required'
        ]);

        if($validatedData['type'] == 'W')
        {
            $isAlreadyRegistered = WorkshopRegistration::where([
                        ['user_id', $validatedData['user_id']],
                        ['workshop_id', $validatedData['e_w_id']],
                        ['is_reg_success', true]
                    ])->exists();

            if($isAlreadyRegistered) {
                return back()->with('failure', 'Already Registered. Carefull !!');
            }   

            $order_id = 'XPLR' . uniqid();
            WorkshopRegistration::create([
                'user_id' => $validatedData['user_id'],
                'workshop_id' => $validatedData['e_w_id'],
                'order_id' => $order_id,
                'is_reg_success' => true,
                'type' => $validatedData['category']
            ]);
        }

        if($validatedData['type'] == 'E')
        {
            $isAlreadyRegistered = EventRegistration::where([
                ['user_id', $validatedData['user_id']],
                ['event_id', $validatedData['e_w_id']],
                ['is_reg_success', true]
            ])->exists();

            if($isAlreadyRegistered) {
                return back()->with('failure', 'Already Registered. Carefull !!');
            }  

            $order_id = 'XPLR' . uniqid();
            EventRegistration::create([
                'user_id' => $validatedData['user_id'],
                'event_id' => $validatedData['e_w_id'],
                'order_id' => $order_id,
                'is_reg_success' => true,
                'type' => $validatedData['category']
            ]);
        }

        return redirect()->route('admin.offline-regs.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id)
    {
        //
        EventRegistration::where('order_id', $order_id)->delete();
        WorkshopRegistration::where('order_id', $order_id)->delete();

        return redirect()->route('admin.offline-regs.index');
    }
}
