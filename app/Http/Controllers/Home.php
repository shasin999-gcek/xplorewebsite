<?php

namespace App\Http\Controllers;

use App\Event;
use App\Workshop;
use Illuminate\Http\Request;
use App\Category;

class Home extends Controller
{
    public function index() {

        $event_posters = Event::pluck('poster_image')->take(5);
        $workshop_posters = Workshop::pluck('poster_image');
        $slides = $event_posters->concat($workshop_posters);

        $data = [
            'active_menu' => 'dashboard',
            'slides' => $slides
        ];
        return view('welcome',$data);
    }

    public function about() {

        $data = [
            'active_menu' => 'about'
        ];

        return view('about', $data);
    }

    public function contact() {

        $data = [
            'active_menu' => 'contact'
        ];


        return view('contact',$data);
    }

    public function technical() {

        $data = [
            'active_menu' => 'technical'
        ];
        return view('technical', $data);
    }

    public function cultural() {

        $cultural_event = Category::with('events')->where('short_name', 'cultural')->firstOrFail();
        $data = [
            'cultural_event' => $cultural_event,
            'active_menu' => 'cultural'
        ];
        
        return view('cultural',$data);
    }

    public function management() {
        $management_event = Category::with('events')->where('short_name', 'management')->firstOrFail();
        $data = [
            'management_event' => $management_event,
            'active_menu' => 'management'
        ];
        return view('management',$data);
    }

    public function sponsors() {

        $data = [
            'active_menu' => 'sponsors'
        ];

        return view('sponsors', $data);
    }

}
