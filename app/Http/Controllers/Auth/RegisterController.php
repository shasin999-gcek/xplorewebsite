<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserDetails;
use App\CollegeList;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_number' => 'required|numeric|min:10|max:10|unique:user_details,mobile_number',
            'college_id' => 'required|numeric',
            'branch' => 'required|string',
            'semester' => 'required|string|min:2',
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user_details = new UserDetails();
        $user_details->mobile_number = $data['mobile_number'];
        $user_details->branch = $data['branch'];
        $user_details->semester = $data['semester'];

        // associate given college to the user, (auto populate college_id)
        $college = CollegeList::find($data['college_id']);
        $user_details->college()->associate($college);

        // auto populate user_id of user_details and save to database
        $user->details()->save($user_details);

        return $user;
    }
}
