@extends('layouts.BaseLayout')
@section('container')

<table class="table table-bordered">
    <thead class="thead-light">
        <tr>
            <th>Group</th>
            <th>Course</th>
            <th>Teacher</th>
            <th>Starts</th>
            <th>Ends</th>
            <th>Created</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

    @foreach($groups as $group)
        <tr>
            <td>{{ $group->group_name }}</td>
            <td>{!! $group->course ? $group->course->course_name : '<span style="color:red;">No course yet</span>' !!}</td>
            <td>{!! $group->teacher ? $group->teacher->name : '<span style="color:red;">No teacher yet</span>' !!}</td>
            <td>{{ Carbon\Carbon::parse($group->start_date)->format('Y-m-d') }}</td>
            <td>{{ Carbon\Carbon::parse($group->end_date)->format('Y-m-d') }}</td>
            <td>{{ Carbon\Carbon::parse($group->created_at)->format('Y-m-d') }}</td>
            <td>
                <div style="display: flex; justify-content: space-evenly;">
                    <a style="margin:5px" class="btn btn-success" href="{{ route('lectures.show', $group->id) }}"><i class="fa fa-search-plus"></i></a>
                    <a style="margin:5px" class="btn btn-info" href="{{ route('groups.edit', $group->id) }}"><i class="fa fa-edit"></i></a>
                    <a style="margin:5px" class="btn btn-danger" href="" onclick="event.preventDefault();document.getElementById('group_{{ $group->id }}').submit();"><i class="fa fa-trash-o"></i></a>
                    <form action="{{ route('groups.destroy', $group->id) }}" method="post" style="display: none" id="group_{{ $group->id }}">@csrf @method('DELETE')</form>
                </div>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>

<div style="display: flex; margin: 10px 0 10px 0 ">
    <a href="{{ route('groups.create') }}" class="btn btn-primary" style="">Add new group</a>
</div>

@endsection
