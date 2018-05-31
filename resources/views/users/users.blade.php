@extends('layouts.BaseLayout')
@section('container')

<table class="table table-bordered">
    <thead class="thead-light">
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Type</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Register date</th>
        <th>Actions</th>

    </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>
                    @switch($user->type)

                    @case(0)
                    <span style="color:red">Unconfirmed</span>
                    @break

                    @case(1)
                    <span style="color:blue">Student</span>
                    @break

                    @case(2)
                    <span style="color:green">Teacher</span>
                    @break

                    @endswitch
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>
                <td>
                    <div style="display: flex; justify-content: space-evenly;">
                        <a style="margin:5px" class="btn btn-info" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
                        <a style="margin:5px" class="btn btn-danger" href="" onclick="event.preventDefault();document.getElementById('user_{{$user->id}}').submit();"><i class="fa fa-trash-o"></i></a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post" style="display: none" id="user_{{$user->id}}">@csrf @method('DELETE')</form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

    <div style="display: flex; margin: 10px 0 10px 0 ">
        <a href="{{ route('users.create') }}" class="btn btn-primary" style="">Add new user</a>
    </div>

@endsection
