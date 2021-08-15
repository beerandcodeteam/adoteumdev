<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfLocalEnv
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment('local')) {
            Auth::loginUsingId(1);

            return redirect()->route('app.interest');
        }
        return $next($request);
    }
}
