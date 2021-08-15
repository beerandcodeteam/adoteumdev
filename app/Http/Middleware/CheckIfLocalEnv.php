<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfLocalEnv
{
    public function handle(Request $request, Closure $next)
    {
        if (config('app.env') === 'local') {
            Auth::loginUsingId(1);

            return redirect()->route('app.interest');
        }
        return $next($request);
    }
}
