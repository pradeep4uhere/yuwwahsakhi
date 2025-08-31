<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sms'; // This should match the binding name in AppServiceProvider
    }
}
