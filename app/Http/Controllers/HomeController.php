<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->isAdmin()) {
           return redirect()->route('admin.dashboard');
       }

       $user = Auth::user();

       $registered_events = $user->s_events;
       $registered_workshops = $user->s_workshops;


       return view('home', [
           'registered_events' => $registered_events,
           'registered_workshops' => $registered_workshops,
           'currentUser' => $user,
           'fail' => false
       ]);

    }
}
