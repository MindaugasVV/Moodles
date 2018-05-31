@extends('layouts.BaseLayout')
@section('container')

<table class="table table-bordered">
    <thead class="thead-light">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Created</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->course_name }}</td>
                <td>{!! $course->course_description !!}</td>
                <td>{{ Carbon\Carbon::parse($course->created_at)->format('Y-m-d') }}</td>
                <td>
                    <div style="display: flex; justify-content: space-evenly;">
                        <a style="margin:5px" class="btn btn-success" href="{{ route('groups.show', $course->id) }}"><i class="fa fa-search-plus"></i></a>
                        <a style="margin:5px" class="btn btn-info" href="{{ route('courses.edit', $course->id) }}"><i class="fa fa-edit"></i></a>
                        <a style="margin:5px" class="btn btn-danger" href="" onclick="event.preventDefault();document.getElementById('course_{{ $course->id }}').submit();"><i class="fa fa-trash-o"></i></a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="post" style="display: none" id="course_{{ $course->id }}">@csrf @method('DELETE')</form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div style="display: flex; margin: 10px 0 10px 0 ">
    <a href="{{ route('courses.create') }}" class="btn btn-primary" style="">Add new course</a>
</div>

@endsection
