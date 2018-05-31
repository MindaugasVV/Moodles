@extends('layouts.BaseLayout')
@section('container')

    <div style="display: flex; margin: 0 0 10px 0 ">
        <h3 style="margin:auto;"><b>Course Add Form</b></h3>
    </div>

    <form role="form" action="{{ route('courses.store') }}" method="post">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Course Name</label>
                                    <input name="course_name" placeholder="Course Name" class="form-control">
                                    @if($errors->has('course_name'))
                                        @foreach ($errors->get('course_name') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="submit" value="Save" name="Save" class="btn btn-success">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Course Description</label>
                                    <textarea name="course_description" class="form-control" rows="3" placeholder="Course Description"></textarea>
                                    @if($errors->has('course_description'))
                                        @foreach ($errors->get('course_description') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </form>

@endsection
