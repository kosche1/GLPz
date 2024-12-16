<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfStudent
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isStudent()) {
            return redirect('/dashboard')->with('error', 'Access denied. Students cannot access admin areas.');
        }

        return $next($request);
    }
}
