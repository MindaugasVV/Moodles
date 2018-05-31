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
    </tr>
    </thead>
    <tbody>
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
        </tr>
    </tbody>
</table>

@endsection
