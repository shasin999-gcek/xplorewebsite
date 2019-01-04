<?php

namespace App\Http\Middleware;

use Closure;

class NoCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        return $response->header("Pragma", "no-cache, must-revalidate")
                        ->header("Cache-Control", "no-cache")
                        ->header("Expires", "0");
    }
}
