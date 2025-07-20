<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'admin' role
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect to homepage if not an admin
        return redirect('/');
    }
}
