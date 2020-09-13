<?php

namespace App\Http\Middleware;

use Closure;

class Login
{
    public function handle($request, Closure $next)
    {
       if (isset($_COOKIE['auth']))
       if (\App\User::where('token', $_COOKIE['auth'])->count() != 0) return redirect()->route('offer.list');
       return $next($request);
    }
}
