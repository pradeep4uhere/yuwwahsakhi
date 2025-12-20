<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PowerBiApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-POWERBI-KEY');
        if ($apiKey !== config('app.powerbi_api_key')) {
            return response()->json([
                'message' => 'Unauthorized - Invalid Power BI key'
            ], 401);
        }

        return $next($request);
    }
}
