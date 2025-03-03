<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session; 
use Log;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         // Language logic
         $language = $request->header('Accept-Language', 'en'); // Set the default language to 'en'
         app()->setLocale($language);
         // Log the language being set for debugging purposes (instead of echo)
        Log::info('Locale set to in setLanguage file: ' . app()->getLocale());
 
        return $next($request);
    }
}
