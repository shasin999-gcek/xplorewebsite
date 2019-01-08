<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class Home extends Controller
{
    public function index() {

        $data = [
            'active_menu' => 'dashboard'
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

}
