<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class CustomRateLimiter
{
    public function handle(Request $request, Closure $next)
    {
        $key = 'user:' . $request->user()->id . ':tickets';
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return response()->json(['message' => 'Çok fazla istek. Lütfen sonra tekrar deneyin.'], 429);
        }
        RateLimiter::hit($key, 60);
        return $next($request);
    }
}
