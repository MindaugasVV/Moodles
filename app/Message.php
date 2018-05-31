<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    public function Group(){
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function MessageSender(){
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function MessageRecipient(){
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    static function GetStudentMessages($all = null){
        $data=[];
        $userGroups = GroupUser::where('user_id', Auth::user()->id)->get();
        foreach ($userGroups as $userGroup){ $data[] = $userGroup->group_id; }

        if($all){
            return self::where('recipient_id', Auth::user()->id)
                ->orWhere('recipient_id', 0)
                ->whereIn('group_id', $data)
                ->with('Group')
                ->with('MessageSender')
                ->with('MessageRecipient')
                ->orderBy('created_at', 'desc')
                ->get();
        }else{
            return self::where('recipient_id', Auth::user()->id)
                ->orWhere('recipient_id', 0)
                ->whereIn('group_id', $data)
                ->with('Group')
                ->with('MessageSender')
                ->with('MessageRecipient')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

    }
}
