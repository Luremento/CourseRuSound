<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user() and  Auth::user()->is_admin == 1) {
            return $next($request);
        }

        return redirect()->back();
    }
}
