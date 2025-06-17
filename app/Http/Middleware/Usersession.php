<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Usersession
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Allow both 'user' and 'admin' to access user routes
        if (!in_array(Auth::user()->role, ['user', 'admin'])) {
            return redirect('/login');
        }

        return $next($request);
    }
}
