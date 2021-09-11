<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfAutoLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (config('auth.auto_login')) {
            Auth::loginUsingId(1);

            return redirect()->route('app.interest');
        }
        return $next($request);
    }
}
