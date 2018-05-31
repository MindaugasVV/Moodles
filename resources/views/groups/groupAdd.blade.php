@extends('layouts.BaseLayout')
@section('container')

    <div style="display: flex; margin: 0 0 10px 0 ">
        <h3 style="margin:auto;"><b>Group Add Form</b></h3>
    </div>

    <form role="form" action="{{ route('groups.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Group name</label>
                                    <input name="group_name" placeholder="Group Name" class="form-control">
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
                                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Teacher name</label>
                                    <select name="teacher_id" class="form-control">
                                        <option value="0">None</option>
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Start date</label>
                                    <input name="start_date" class="form-control" type="date" value="{{ now()->format('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label>End date</label>
                                    <input name="end_date" class="form-control" type="date" value="{{ now()->format('Y-m-d') }}">
                                </div>
                                <input type="submit" value="Save" name="Save" class="btn btn-success" style="margin-top: 25px;min-width: 100px;">
                            </div>
                            <div class="col-lg-6">
                                <label>Add students to group</label>
                                <div class="form-group">
                                    <select name="users[]" multiple="multiple" size="10" class="form-control">
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ "alert('ss')" }}>{{ $student->name }}</option>
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
