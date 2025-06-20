<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session; 
use App\Http\Controllers\Auth\Http;
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
        //$language = $request->header('Accept-Language', 'en'); // Set the default language to 'en'
         //app()->setLocale($language);
         // Log the language being set for debugging purposes (instead of echo)
        Log::info('Locale set to in setLanguage file: ' . app()->getLocale());


        // Get Accept-Language header, fallback to 'en'
        $acceptLanguage = $request->header('Accept-Language', 'en');

        // Extract the first valid locale from the comma-separated list
        $language = explode(',', $acceptLanguage)[0]; // 'en_GB' from 'en_GB,en_US;q=0.9,en;q=0.8'

        // Optional: Validate against allowed locales
        $allowedLocales = ['en', 'en_US', 'en_GB', 'hi', 'fr']; // Add more if needed
        if (!in_array($language, $allowedLocales)) {
            $language = 'en';
        }

        // Set locale
        app()->setLocale($language);

        // Log for debug
        \Log::info('Locale set to: ' . app()->getLocale());
 
        return $next($request);
    }
}
