<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\GroupUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GroupController extends Controller
{
    public function index()
    {
        return view('groups/groups', [
            'groups' => Group::with('Course')->with('Teacher')->get(),
            'activeTab' => 'groups'
        ]);
    }

    public function create()
    {
        return view('groups/groupAdd', [
            'courses' => Course::all(),
            'teachers' => User::where('type', 2)->get(),
            'students' => User::where('type', 1)->get(),
            'activeTab' => 'groups'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'group_name' => 'required'
        ];

        $this->validate($request, $rules);

        $group = new Group();
        $group->group_name = $request->group_name;
        $group->course_id = $request->course_id;
        $group->teacher_id = $request->teacher_id;
        $group->start_date = $request->start_date;
        $group->end_date = $request->end_date;
        $group->save();

        foreach ($request->users as $student_id){
            $data[] = array('group_id' => $group->id, 'user_id' => $student_id);
        }

        GroupUser::insert($data);
        return redirect()->route('groups.index');
    }

    public function show($course_id)
    {
        return view('groups/groups', [
            'groups' => Group::where('course_id', $course_id)->with('Course')->with('Teacher')->get(),
            'activeTab' => 'groups'
        ]);
    }

    public function edit(Group $group)
    {
        $data = [];
        $group = Group::with('Course')->with('Teacher')->find($group->id);
        foreach($group->users as $user){ $data[] = $user->id; }

        return view('groups/groupEdit', [
            'group' => $group,
            'usersArray' => $data,
            'courses' => Course::all(),
            'teachers' => User::where('type', 2)->get(),
            'students' => User::where('type', 1)->get(),
            'activeTab' => 'groups'
        ]);
    }

    public function update(Request $request, Group $group)
    {
        $rules = [
            'group_name' => 'required'
        ];

        $this->validate($request, $rules);

        $group->group_name = $request->group_name;
        $group->course_id = $request->course_id;
        $group->teacher_id = $request->teacher_id;
        $group->start_date = $request->start_date;
        $group->end_date = $request->end_date;
        $group->save();

        if($request->users_add){
            foreach ($request->users_add as $student_id){ $data[] = array('group_id' => $group->id, 'user_id' => $student_id); }
            if($data) GroupUser::insert($data);
        }
        if($request->users_remove) GroupUser::where('group_id', $group->id)->whereIn('user_id', ($request->users_remove))->delete();

        return redirect()->route('groups.index');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index');
    }

    public function getStudentsByGroup($id){
        return Group::find($id)->users;
    }
}
