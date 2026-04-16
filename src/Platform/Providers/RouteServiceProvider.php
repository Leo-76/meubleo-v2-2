<?php

declare(strict_types=1);

namespace Meubleo\Platform\Providers;

use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Meubleo\Platform\Shop;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app instanceof CachesRoutes && $this->app->routesAreCached()) {
            return;
        }

        Route::domain((string) config('meubleo.domain', ''))
            ->prefix(Shop::prefix('/'))
            ->middleware(config('meubleo.middleware.private', ['web', 'auth']))
            ->group(Shop::path('routes/dashboard.php'));

        Route::middleware(config('meubleo.middleware.public', ['web']))
            ->group(Shop::path('routes/shop.php'));
    }
}
