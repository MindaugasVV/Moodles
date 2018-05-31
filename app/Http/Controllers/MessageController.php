<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupUser;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages/messages', [
            'messages' => Message::with('Group')->with('MessageSender')->with('MessageRecipient')->get(),
            'activeTab' => 'messages'
        ]);
    }

    public function create()
    {
        return view('messages/messageAdd', [
            'groups' => Group::all(),
            'recipients' => User::where('type', 1)->get(),
            'activeTab' => 'messages'
        ]);
    }

    public function store(Request $request)
    {
        $messages = [
            'group_id.not_in' => 'The group field must be selected.',
            'group_id.required' => 'The group field is required.',
            'message_text.required' => 'The message field is required.',
            'message_text.min' => 'The message must be at least 10 characters.'
        ];

        $rules = [
            'group_id' => 'required|not_in:0',
            'message_text' => 'required|min:10'
        ];

        $this->validate($request, $rules, $messages);

        $message = new Message();
        $message->group_id = $request->group_id;
        $message->sender_id = Auth::user()->id;
        $message->recipient_id = $request->recipient_id;
        $message->message_text = $request->message_text;
        $message->created_at = now();
        $message->save();
        return redirect()->route('messages.index');
    }

    public function show(Message $message)
    {
        //
    }

    public function edit(Message $message)
    {
        return view('messages/messageEdit', [
            'groups' => Group::all(),
            'recipients' => User::where('type', 1)->get(),
            'message_id' => $message->id,
            'activeTab' => 'messages'
        ]);
    }

    public function update(Request $request, Message $message)
    {
        $messages = [
            'group_id.not_in' => 'The group field must be selected.',
            'group_id.required' => 'The group field is required.',
            'message_text.required' => 'The message field is required.',
            'message_text.min' => 'The message must be at least 10 characters.'
        ];

        $rules = [
            'group_id' => 'required|not_in:0',
            'message_text' => 'required|min:10'
        ];

        $this->validate($request, $rules, $messages);

        $message->group_id = $request->group_id;
        $message->recipient_id = $request->recipient_id;
        $message->message_text = $request->message_text;
        $message->save();
        return redirect()->route('messages.index');
    }

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('messages.index');
    }

    public function showMessages()
    {
        return view('messages/messages', [
            'messages' => Message::GetStudentMessages($all = true),
            'groups' => User::find(Auth::user()->id)->Groups,
            'side_messages' => Message::GetStudentMessages(),
            'activeTab' => 'showMessages'
        ]);
    }

    public function showMessage($id)
    {
        return view('messages/messageShow', [
            'message' => Message::with('Group')->with('MessageSender')->with('MessageRecipient')->find($id),
            'groups' => User::find(Auth::user()->id)->Groups,
            'side_messages' => Message::GetStudentMessages(),
            'activeTab' => $id
        ]);
    }
}
