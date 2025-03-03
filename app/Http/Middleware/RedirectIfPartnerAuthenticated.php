<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfPartnerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the partner is already authenticated using the 'partner' guard
        if (Auth::guard('partner')->check()) {
            // Redirect to the partner dashboard if they are authenticated
            return redirect()->route('partner.dashboard');
        }

        return $next($request);
    }
}
