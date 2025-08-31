<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SMSService
{
    protected $apiKey;
    protected $senderId;
    protected $route;

    public function __construct()
    {
        $this->apiKey   = config('services.sms.api_key');
        $this->senderId = config('services.sms.sender_id');
        $this->route    = config('services.sms.route', 1);
    }



    public function register()
    {
        $this->app->singleton('sms', function ($app) {
            return new SMSService();
        });
    }
   


    public function sendSMS($number, $message)
    {
        $url = "https://www.smsgatewayhub.com/api/mt/SendSMS";

        $response = Http::withoutVerifying()->get($url, [
            'APIKey'   => $this->apiKey,
            'senderid' => $this->senderId,
            'channel'  => 2,
            'DCS'      => 0,
            'flashsms' => 0,
            'number'   => $number,
            'text'     => $message,
            'route'    => $this->route,
        ]);

        return $response->json();
    }
}
