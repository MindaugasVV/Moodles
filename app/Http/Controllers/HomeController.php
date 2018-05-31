<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use App\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::check() && Auth::user()->type == 1){
            return view('home',[
                'groups' => User::find(Auth::user()->id)->Groups,
                'side_messages' => Message::GetStudentMessages()
                ]);
        }else{
            return view('home');
        }
    }
}
