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


}
