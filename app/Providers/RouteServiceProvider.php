<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            $this->registerApiRoutes();
            $this->registerWebRoutes();
        });
    }

    private function registerApiRoutes(): void
    {
        $paths = glob(base_path('routes/API/*.php'));

        foreach ($paths as $path) {
            $file = Arr::last(explode('/', $path));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/API/' . $file));
        }
    }

    private function registerWebRoutes(): void
    {
        $paths = glob(base_path('routes/web/*.php'));

        foreach ($paths as $path) {
            $file = Arr::last(explode('/', $path));

            Route::middleware('web')
                ->group(base_path('routes/web/' . $file));
        }
    }
}
