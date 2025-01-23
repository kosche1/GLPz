<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'superadmin') {
            return $next($request);
        }

        return redirect('/'); // Redirect to a different page if not authorized
    }
}
