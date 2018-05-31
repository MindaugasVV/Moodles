<?php

namespace App\Http\Controllers;

use App\File;
use App\Group;
use App\GroupUser;
use App\Lecture;
use App\Message;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{
    public function index()
    {
        return view('lectures/lectures',[
            'lectures' => Lecture::with('Group')->with('Files')->get(),
            'activeTab' => 'lectures'
        ]);
    }

    public function create()
    {
        return view('lectures/lectureAdd',[
            'groups' => Group::all(),
            'activeTab' => 'lectures'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'lecture_name' => 'required',
            'lecture_description' => 'required|min:10'
        ];

        $this->validate($request, $rules);

        $lecture = new Lecture();
        $lecture->lecture_name = $request->lecture_name;
        $lecture->lecture_description = $request->lecture_description;
        $lecture->group_id = $request->group_id;
        $lecture->start_date = $request->start_date;

        if($lecture->save()){
            File::SaveFiles($request->file('filesArray'), $lecture->id);
        }
        return redirect()->route('lectures.index');
    }

    public function show($group_id)
    {
        return view('lectures/lectures',[
            'lectures' => Lecture::where('group_id', $group_id)->with('Group')->get(),
            'activeTab' => 'lectures'
        ]);
    }

    public function edit(Lecture $lecture)
    {
        return view('lectures/lectureEdit', [
            'lecture' => Lecture::with('Group')->with('Files')->find($lecture->id),
            'groups' => Group::all(),
            'activeTab' => 'lectures'
        ]);
    }

    public function update(Request $request, Lecture $lecture)
    {
        $rules = [
            'lecture_name' => 'required',
            'lecture_description' => 'required|min:10'
        ];

        $this->validate($request, $rules);

        $lecture->lecture_name = $request->lecture_name;
        $lecture->lecture_description = $request->lecture_description;
        $lecture->group_id = $request->group_id;
        $lecture->start_date = $request->start_date;

        if($lecture->save()){
            File::SaveFiles($request->file('filesArray'), $lecture->id);
        }
        return redirect()->route('lectures.index');
    }

    public function destroy(Lecture $lecture)
    {
        $lecture->delete();
        return redirect()->route('lectures.index');
    }

    public function showLectures($id)
    {
        return view('lectures/lectures',[
            'lectures' => Lecture::where('group_id', $id)->with('Group')->with('Files')->get(),
            'groups' => User::find(Auth::user()->id)->Groups,
            'side_messages' => Message::GetStudentMessages(),
            'activeTab' => $id
        ]);
    }
}
