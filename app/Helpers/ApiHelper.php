<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth; 

class ApiHelper
{
    public static function makeApiRequest($method, $url, $queryParams = [], $headers = [], $body = [])
    {
        try {
            // Base URL for the API
            $baseUrl = env('API_BASE_URL', 'http://127.0.0.1:8000/api/');

            // Construct full URL with query parameters
            $fullUrl = $baseUrl . $url . '?' . http_build_query($queryParams);

            // Retrieve token from session
            $token = session('api_token');
             if (!$token) {
                 return [
                     'error' => true,
                     'message' => 'Authentication required.',
                 ];
             }
 
             // Default headers with dynamic token
             $defaultHeaders = [
                 'Authorization' => 'Bearer ' . $token,
                 'Accept' => 'application/json',
             ];

            // Merge default and custom headers
            $headers = array_merge($defaultHeaders, $headers);
            //dd($headers );
            // Make the request using Laravel's HTTP Client
            $response = Http::withHeaders($headers)
            ->timeout(30) // Set a 10-second timeout
            ->$method($fullUrl, $body);
            dd($response);

            // Return response as an array
            return $response->json();

        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }
}
