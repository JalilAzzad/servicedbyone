<?php

namespace App\Http\Controllers\Auth;

use Cookie;
use App\Models\User;
use App\Models\Referral;
use App\Http\Controllers\Controller;
use App\Rules\Phone;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/dashboard';

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
            'user_name' => 'required|string|max:255|unique:users',
            'phone' => ['required', new Phone()],
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
            'user_name' => $data['user_name'],
            'slug' => str_replace(' ', '-', $data['user_name']),
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        if(Cookie::get('referrer')){
            Referral::create([
                'referee_id' => $user->id,
                'referrer_id' => Cookie::get('referrer'),
            ]);     
        }

        $user->syncRoles([User::USER]);

        $user->sendEmailVerificationNotification();

        return $user;
    }
}
