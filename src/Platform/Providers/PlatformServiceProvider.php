<?php

declare(strict_types=1);

namespace Meubleo\Platform\Providers;

use App\Meubleo\MeubleoServiceProvider;
use Illuminate\Support\ServiceProvider;
use Meubleo\Platform\Shop;

class PlatformServiceProvider extends ServiceProvider
{
    public function boot(Shop $shop): void
    {
        $this->app->booted(function () use ($shop) {
            $shop->registerSearch(config('meubleo.search', []));
        });
    }

    public function register(): void
    {
        $provider = config('meubleo.provider', MeubleoServiceProvider::class);

        if ($provider !== null && class_exists($provider)) {
            $this->app->register($provider);
        }
    }
}
