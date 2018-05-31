<?php

namespace App\Http\Middleware;

use App\Lecture;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class LecturesMiddleware
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
        $data = [];
        $userGroups = User::find(Auth::user()->id)->Groups;
        foreach ($userGroups as $userGroup){ $data[] = $userGroup->id; }
        if(!(in_array($request->route('id'), $data))) return redirect()->route('home');

        return $next($request);
    }
}
