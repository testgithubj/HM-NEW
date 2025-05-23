<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    protected $namespace = 'App\\Http\\Controllers';
    protected $frontend = 'App\\Http\\Controllers\\frontend';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            if (File::exists(base_path('routes/backend.php'))){
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/backend.php'));
            }

            if (File::exists(base_path('routes/frontend.php'))){
                Route::middleware('web')
                    ->namespace($this->frontend)
                    ->group(base_path('routes/frontend.php'));
            }

            if (File::exists(base_path('routes/ecommerce.php'))){
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/ecommerce.php'));
            }

            if (File::exists(base_path('routes/hrm.php'))){
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/hrm.php'));
            }

            if (File::exists(base_path('routes/account.php'))){
                Route::middleware('web')
                    ->namespace($this->namespace)
                    ->group(base_path('routes/account.php'));
            }
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
