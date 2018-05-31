@extends('layouts.BaseLayout')
@section('container')

    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th>Lecture</th>
            <th>Description</th>
            <th>Files</th>
            <th>Group</th>
            <th>Starts</th>
            <th>Created</th>
            @if(Auth::user()->type == 2)<th>Actions</th>@endif
        </tr>
        </thead>
        <tbody>
        @foreach($lectures as $lecture)
            <tr>
                <td>{{ $lecture->lecture_name }}</td>
                <td>{!! $lecture->lecture_description !!}</td>
                <td>
                    @foreach($lecture->files as $file)
                        <a href="{{ asset("storage/$file->file_url") }}" download>{!! $file->file_name !!}</a><br/>
                    @endforeach
                </td>
                <td>{{ $lecture->group->group_name }}</td>
                <td>{{ Carbon\Carbon::parse($lecture->start_date)->format('Y-m-d') }}</td>
                <td>{{ Carbon\Carbon::parse($lecture->created_at)->format('Y-m-d') }}</td>
                @if(Auth::user()->type == 2)
                <td>
                    <div style="display: flex; justify-content: space-evenly;">
                        <a style="margin:5px" class="btn btn-info" href="{{ route('lectures.edit', $lecture->id) }}"><i class="fa fa-edit"></i></a>
                        <a style="margin:5px" class="btn btn-danger" href="" onclick="event.preventDefault();document.getElementById('lecture_{{ $lecture->id }}').submit();"><i class="fa fa-trash-o"></i></a>
                        <form action="{{ route('lectures.destroy', $lecture->id) }}" method="post" style="display: none" id="lecture_{{ $lecture->id }}">@csrf @method('DELETE')</form>
                    </div>
                </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

    @if(Auth::user()->type == 2)
        <div style="display: flex; margin: 10px 0 10px 0 ">
            <a href="{{ route('lectures.create') }}" class="btn btn-primary" style="">Add new lecture</a>
        </div>
    @endif

@endsection
