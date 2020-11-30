<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\UserAccount;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * 03/04/2020, Jongil, Add the valiator of parameter
     * 
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'uEmail' => ['required', 'string', 'email', 'max:250', 'unique:UserAccount'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            'uFirstName' => ['required', 'string', 'max:250'],
            'uLastName' => ['required', 'string', 'max:250'],
        ],
        [
            'uEmail.unique' => 'The email has already been taken.'
        ]);
    
        return $validator;
    }

    /**
     * 03/04/2020, Jongil, Store to DB
     * 
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\UserAccount
     */
    protected function create(array $data)
    {
        return UserAccount::create([
            'uEmail' => $data['uEmail'],
            'password' => Hash::make($data['›password']),
            'uFirstName' => $data['uFirstName'],
            'uLastName' => $data['uLastName'],
            'contactNum' => $data['contactNum'],
            'joinDate' => now()
        ]);
    }
}
