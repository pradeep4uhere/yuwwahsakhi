<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RedirectIfPartnerCenterAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the partner center is authenticated using the 'partner_center' guard
        if (Auth::guard('partner_center')->check()) {
            return redirect()->route('partnercenter.dashboard');
        }

        return $next($request);
    }
}
