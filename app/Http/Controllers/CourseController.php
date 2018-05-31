<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses/courses', [
            'courses' => Course::all(),
            'activeTab' => 'courses'
        ]);
    }

    public function create()
    {
        return view('courses/courseAdd', [
            'activeTab' => 'courses'
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'course_name' => 'required',
            'course_description' => 'required|min:10'
        ];

        $this->validate($request, $rules);

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->course_description = $request->course_description;
        $course->save();
        return redirect()->route('courses.index');
    }

    public function show(Course $course)
    {

    }

    public function edit(Course $course)
    {
        return view('courses/courseEdit', [
            'course' => $course,
            'activeTab' => 'courses'
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $rules = [
            'course_name' => 'required',
            'course_description' => 'required|min:10'
        ];

        $this->validate($request, $rules);

        $course->course_name = $request->course_name;
        $course->course_description = $request->course_description;
        $course->save();
        return redirect()->route('courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index');
    }
}
