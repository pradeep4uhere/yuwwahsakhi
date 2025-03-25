<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';


    

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')  // Optional: Use the 'web' middleware group for session-based authentication
                ->prefix('admin')  // Optional: You can use 'admin' as a prefix for all admin routes
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php')); 

            Route::middleware('web')  // Optional: Use the 'web' middleware group for session-based authentication
                ->prefix('partner')  // Optional: You can use 'admin' as a prefix for all admin routes
                ->namespace($this->namespace)
                ->group(base_path('routes/partner.php')); 

            Route::middleware('web')  // Optional: Use the 'web' middleware group for session-based authentication
                ->prefix('partnercenter')  // Optional: You can use 'admin' as a prefix for all admin routes
                ->namespace($this->namespace)
                ->group(base_path('routes/partnercenter.php')); 
        });

        // Admin routes (for admin authentication and other admin-specific routes)
       // Load the admin.php route file
    }
}
