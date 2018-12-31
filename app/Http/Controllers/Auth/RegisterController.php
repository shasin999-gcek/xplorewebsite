<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserDetails;
use App\CollegeList;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Cookie;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email',
            'mobile_number' => 'required|regex:/[0-9]{10}/|unique:users,mobile_number',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $referred_by = null;
        if(Cookie::has('ref_code'))
        {
            $referred_by = explode('"', Cookie::get('ref_code'))[1];
        }
        
        // create a firebase user as well
        $firebase = app('firebase');

        $auth = $firebase->getAuth();

        $userProperties = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        $firebaseUser = $auth->createUser($userProperties);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'firebase_uid' => $firebaseUser->uid,
            'referred_by' => $referred_by,
            'password' => bcrypt($data['password']),
        ]);

    }
}
