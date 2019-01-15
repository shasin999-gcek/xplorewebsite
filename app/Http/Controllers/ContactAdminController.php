<?php

namespace App\Http\Controllers;

use App\Mail\ContactAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactAdminController extends Controller
{
    //

    public function sendMail(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|regex:/[0-9]{10}/',
            'subject' => 'required|string|max:50',
            'message' => 'required|string|max:200'
        ]);

        Mail::to('xplore19gcek@gmail.com')->send(new ContactAdmin($validatedData));

        return redirect('contact')->with('status', 'Thankyou for contacting us');
    }
}
