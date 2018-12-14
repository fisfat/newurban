<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isActive
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
        if(Auth::check() && Auth::user()->active == false){
           return redirect('/')->withErrors('Your account has been restricted by a moderator because you must have violated some rules. Contact an admin');
        }
        return $next($request);
    }
}
