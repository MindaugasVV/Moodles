<?php

namespace App\Http\Middleware;

use App\Message;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class MessagesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $data=[];
        $userGroups = User::find(Auth::user()->id)->Groups;
        if(!($message = Message::find($request->route('id')))) return redirect()->route('home');
        foreach ($userGroups as $userGroup){ $data[] = $userGroup->id; }

        if(!(in_array($message->group_id, $data) && ($message->recipient_id == Auth::user()->id || $message->recipient_id == 0))){
            return redirect()->route('home');
        }

        return $next($request);
    }
}
