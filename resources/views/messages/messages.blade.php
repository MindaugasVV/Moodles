@extends('layouts.BaseLayout')
@section('container')

<table class="table table-bordered">
    <thead class="thead-light">
    <tr>
        <th>Group Name</th>
        <th>Sender Name</th>
        <th>Recipient Name</th>
        <th>Message Text</th>
        <th>Message Sent</th>
        @if(Auth::user()->type == 2)<th>Actions</th>@endif
    </tr>
    </thead>
    <tbody>
        @foreach($messages as $message)
            <tr>
                <td>{{ $message->Group->group_name }}</td>
                <td>{{ $message->MessageSender->name }}</td>
                <td>
                    @if($message->recipient_id == 0){{ 'To All' }}@else
                        @if($message->MessageRecipient){{ $message->MessageRecipient->name }}@else
                            {{ 'User Recipient not found' }}
                        @endif
                    @endif
                </td>
                <td>{!! $message->message_text !!}</td>
                <td>{{ Carbon\Carbon::parse($message->created_at)->format('Y-m-d') }}</td>
                @if(Auth::user()->type == 2)
                    <td>
                        <div style="display: flex; justify-content: space-evenly;">
                            <a style="margin:5px" class="btn btn-info" href="{{ route('messages.edit', $message->id) }}"><i class="fa fa-edit"></i></a>
                            <a style="margin:5px" class="btn btn-danger" href="" onclick="event.preventDefault();document.getElementById('message_{{ $message->id }}').submit();"><i class="fa fa-trash-o"></i></a>
                            <form action="{{ route('messages.destroy', $message->id) }}" method="post" style="display: none" id="message_{{ $message->id }}">@csrf @method('DELETE')</form>
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>

@if(Auth::user()->type == 2)
    <div style="display: flex; margin: 10px 0 10px 0 ">
        <a href="{{ route('messages.create') }}" class="btn btn-primary" style="">Add new message</a>
    </div>
@endif

@endsection
