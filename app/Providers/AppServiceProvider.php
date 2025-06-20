<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Carbon::class, CustomCarbon::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale('en');
    }
}
