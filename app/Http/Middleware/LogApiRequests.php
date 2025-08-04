<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogApiRequests
{
    public function handle(Request $request, Closure $next)
    {
        Log::channel('api')->info('API Request', [
            'user_id' => auth()->id(),
            'route'   => $request->route()->getName(),
            'ip'      => $request->ip(),
            'payload' => $request->except(['password', 'token']),
        ]);
        return $next($request);
    }
}
