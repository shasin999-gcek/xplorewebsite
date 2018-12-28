<?php
/**
 * Created by PhpStorm.
 * User: shasin
 * Date: 24/12/18
 * Time: 12:31 AM
 */

namespace App\Http\Controllers\Admin;
use App\User;
use App\Event;
use App\Workshop;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }


    public function index()
    {
        $builder = User::where('is_admin', false);
        $users_count = $builder->count();
        $users = $builder->get();

        $events_count = Event::count();
        $workshops_count = Workshop::count();

        $data = [
            'users' => $users,
            'users_count' => $users_count,
            'events_count' => $events_count,
            'workshops_count' => $workshops_count,
            'active_menu' => 'dashboard'
        ];

       return view('admin.dashboard', $data);
    }
}