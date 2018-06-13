<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/';

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
//            'ico' => 'required|max:8|min:8|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'iamHuman' => 'required|integer|between:5,5',
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
        if($user_exists = User::whereIco($data['ico'])->first()) {

            $user = User::create([
                'company' => $user_exists->company,
                'owner_id' => $user_exists->owner_id,
                'email' => $data['email'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'slug' => str_slug($data['first_name']. '-' .$data['last_name']),
                'password' => bcrypt($data['password']),
                'confirmed' => 1,
            ]);

            $user->roles()->attach(Role::whereId(2)->first());

        } else {

            $user = User::create([
                'ico' => $data['ico'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'slug' => str_slug($data['first_name']. '-' .$data['last_name']),
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'confirmed' => 1,
                'admin' => 1,
            ]);
            $user->update([
                'owner_id' => $user->id
            ]);

            $user->roles()->attach(Role::whereId(1)->first());
        }

        \Toastr::success('Ste zaregistrovaný!', 'Vitajte ' , ["positionClass" => "toast-bottom-right"]);


        return $user;
    }



//    public function redirectPath()
//    {
//        if (method_exists($this, 'redirectTo')) {
//            return $this->redirectTo();
//        }
//
//
//
//        return '/';
//
//    }

}
