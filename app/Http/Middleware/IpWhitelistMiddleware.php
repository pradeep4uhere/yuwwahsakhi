<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpWhitelistMiddleware
{


    private $whitelistedIps;

        
    public function __construct()
    {
        $this->whitelistedIps = config('whitelist.ips');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the IP address is in the whitelist
        if (!in_array($request->ip(), $this->whitelistedIps)) {
            abort(403, 'Unauthorized access.');
        }
        return $next($request);
    }
}
