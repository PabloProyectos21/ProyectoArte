<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->user_permission_level === 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
    }
}
