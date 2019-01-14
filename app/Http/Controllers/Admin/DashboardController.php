<?php
/**
 * Created by PhpStorm.
 * User: shasin
 * Date: 24/12/18
 * Time: 12:31 AM
 */

namespace App\Http\Controllers\Admin;
use App\EventRegistration;
use App\User;
use App\Event;
use App\Workshop;
use App\Http\Controllers\Controller;
use App\WorkshopRegistration;

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

        $event_reg_count = EventRegistration::where('is_reg_success', true)->count();
        $workshop_reg_count = WorkshopRegistration::where('is_reg_success', true)->count();

        $data = [
            'users' => $users,
            'users_count' => $users_count,
            'events_count' => $events_count,
            'workshops_count' => $workshops_count,
            'event_reg_count' => $event_reg_count,
            'workshop_reg_count' => $workshop_reg_count,
            'active_menu' => 'dashboard'
        ];

       return view('admin.dashboard', $data);
    }
}