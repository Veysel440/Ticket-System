<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->is_active) {
            return response()->json(['message' => 'Hesabınız pasif durumda!'], 403);
        }
        return $next($request);
    }
}
