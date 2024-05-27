<?php

namespace App\Http\Middleware;

use Closure, Session, DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SessionValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {        
        if (Session::get('status_login')) {
            return $next($request);
        }
        else {
            Session::forget('status_login');
            // Session::flash('message', 'error|Sorry you dont have permission to this page');
            return redirect('/login');
        }
    }
}
