<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventRegExport;
use App\Exports\WorkshopRegExport;
use App\Event;
use App\Workshop;


class ReportController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateReport(Request $request)
    {
        $type = $request->type;
        $id = $request->id;
        $format = $request->format;

        if($type == 'event')
        {
            $event = Event::findOrFail($id);
            $filename = $event->slug . '.' . $format;
            return Excel::download(new EventRegExport($id), $filename);
        }

        if($type == 'workshop')
        {
            $workshop = Workshop::findOrFail($id);
            $filename = $workshop->slug . '.' . $format;
            return Excel::download(new WorkshopRegExport($id), $filename);
        }
    }

    
    public function showForm()
    {
        $data = [
            'active_menu' => 'reports'
        ];
        return view('admin.reports', $data);
    }
}
