@extends('layouts.BaseLayout')
@section('container')
    <div style="display: flex; margin: 0 0 10px 0 ">
        <h3 style="margin:auto;"><b>User Add Form</b></h3>
    </div>
    <form role="form" action="{{ route('users.update', $user->id) }}" method="post">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Student Name</label>
                                    <input name="student_name" placeholder="Student Name" class="form-control" value="{{$user->name}}">
                                    @if($errors->has('student_name'))
                                        @foreach ($errors->get('student_name') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Student Surname</label>
                                    <input name="student_surname" placeholder="Student Surname" class="form-control" value="{{$user->surname}}">
                                    @if($errors->has('student_surname'))
                                        @foreach ($errors->get('student_surname') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Student Email</label>
                                    <input name="student_email" placeholder="Student Email" class="form-control" value="{{$user->email}}">
                                    @if($errors->has('student_email'))
                                        @foreach ($errors->get('student_email') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <input type="submit" value="Save" name="Save" class="btn btn-success" style="margin-top: 25px;min-width: 100px;">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Student Phone</label>
                                    <input type="number" name="student_phone" placeholder="Student Phone" class="form-control" value="{{$user->phone}}">
                                    @if($errors->has('student_phone'))
                                        @foreach ($errors->get('student_phone') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Student Password</label>
                                    <input type="password" name="student_password" placeholder="Student Password" class="form-control">
                                    @if($errors->has('student_password'))
                                        @foreach ($errors->get('student_password') as $error)
                                            <p class="help-block text-danger">{{ $error }}</p>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Student Password Confirmation</label>
                                    <input type="password" name="student_password_confirmation" placeholder="Student Password" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
