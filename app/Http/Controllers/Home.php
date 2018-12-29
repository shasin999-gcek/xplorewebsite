<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function index() {

        $data = [
            'active_menu' => 'dashboard'
        ];
        return view('welcome',$data);
    }

    public function about() {

        return view('about');
    }

    public function contact() {
        return view('contact');
    }

    public function technical() {

        $data = [
            'active_menu' => 'technical'
        ];
        return view('technical', $data);
    }

    public function cultural() {
        return view('cultural');
    }

    public function management() {
        return view('management');
    }

}
