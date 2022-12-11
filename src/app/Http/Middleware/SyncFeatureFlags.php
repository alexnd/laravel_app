<?php

namespace App\Http\Middleware;

use Closure;

class SyncFeatureFlags
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        ff_sync_default();
        return $next($request);
    }
}


