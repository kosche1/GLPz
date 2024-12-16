<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        if (Auth::user()->role !== 'superadmin') {
            return redirect()->route('dashboard')->with('error', 'Access denied. Super Admin privileges required.');
        }

        return $next($request);
    }
}
