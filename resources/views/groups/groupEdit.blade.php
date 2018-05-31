@extends('layouts.BaseLayout')
@section('container')

    <div style="display: flex; margin: 0 0 10px 0 ">
        <h3 style="margin:auto;"><b>Group Edit Form</b></h3>
    </div>

    <form role="form" action="{{ route('groups.update', $group->id) }}" method="post">
        @csrf @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Group name</label>
                                    <input name="group_name" placeholder="Group Name" class="form-control" value="{{ $group->group_name }}">
                                    @if($errors->has('group_name'))
                                        @foreach ($errors->get('group_name') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Course name</label>
                                    <select name="course_id" class="form-control">
                                        <option value="0">None</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" @if($group->course) @if($course->id == $group->course->id){{'selected'}}@endif @endif>{{ $course->course_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Teacher name</label>
                                    <select name="teacher_id" class="form-control">
                                        <option value="0">None</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" @if($group->teacher) @if($teacher->id == $group->teacher->id){{'selected'}}@endif @endif>{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Start date</label>
                                    <input name="start_date" class="form-control" type="date" value="{{ Carbon\Carbon::parse($group->start_date)->format('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label>End date</label>
                                    <input name="end_date" class="form-control" type="date" value="{{ Carbon\Carbon::parse($group->end_date)->format('Y-m-d') }}">
                                </div>
                                <input type="submit" value="Save" name="Save" class="btn btn-success" style="margin-top: 25px;min-width: 100px;">
                            </div>
                            <div class="col-lg-6">
                                <label>Add students to group</label>
                                <div class="form-group">
                                    <select name="users_add[]" multiple="multiple" size="10" class="form-control">
                                        @foreach($students as $student)
                                            @if(!in_array($student->id, $usersArray))
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <label>Remove students from group</label>
                                <div class="form-group">
                                    <select name="users_remove[]" multiple="multiple" size="10" class="form-control">
                                        @foreach($group->users as $student)
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
