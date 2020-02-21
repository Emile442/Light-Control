<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class NotSuspend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->suspend)
            return redirect()->route('guest')->with('error', 'Votre compte a été suspendu, merci de prendre avec l\'ADM');
        return $next($request);
    }
}