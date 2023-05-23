<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (in_array(Auth::user()->role, $roles)){
            return $next($request);
        }
        return redirect()->route('403');
    }
}
