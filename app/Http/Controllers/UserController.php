<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users/users', [
            'users' => User::orderBy('type', 'ASC')->get(),
            'activeTab' => 'users'
        ]);
    }

    public function create()
    {
        return view('users/userAdd', [
            'groups' => Group::all(),
            'activeTab' => 'users'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'student_name' => 'required|string|max:255',
            'student_surname' => 'required|string|max:255',
            'student_email' => 'required|string|email|max:255|unique:users',
            'student_password' => 'required|string|min:6|confirmed',
            'student_phone' => 'integer',
        ];

        $this->validate($request, $rules);

        $user = new User();
        $user->name = $request->student_name;
        $user->surname = $request->student_surname;
        $user->type = 1;
        $user->phone = $request->student_phone;
        $user->email = $request->student_email;
        $user->password = Hash::make($request->student_password);
        $user->save();

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        //
    }

    public function edit($id)
    {
        return view('users/userEdit', [
            'user' => User::with('Groups')->find($id),
            'groups' => Group::all(),
            'activeTab' => 'users'
        ]);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'student_name' => 'required|string|max:255',
            'student_surname' => 'required|string|max:255',
            'student_email' => 'required|string|email|max:255|unique:users',
            'student_password' => 'required|string|min:6|confirmed',
            'student_phone' => 'integer',
        ];

        $this->validate($request, $rules);

        $user->name = $request->student_name;
        $user->surname = $request->student_surname;
        $user->type = 1;
        $user->phone = $request->student_phone;
        $user->email = $request->student_email;
        $user->password = Hash::make($request->student_password);
        $user->save();

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
       $user->delete();
       return redirect()->route('users.index');
    }
}
