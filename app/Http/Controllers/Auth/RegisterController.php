<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'register_name' => 'required|string|max:255|min:10',
            'register_surname' => 'required|string|max:255',
            'register_email' => 'required|string|email|max:255',
            'register_password' => 'required|string|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['register_name'],
            'surname' => $data['register_surname'],
            'phone' => $data['register_phone'],
            'email' => $data['register_email'],
            'password' => Hash::make($data['register_password']),
        ]);
    }
}
