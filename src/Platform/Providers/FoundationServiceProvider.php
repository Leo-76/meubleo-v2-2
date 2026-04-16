<?php

declare(strict_types=1);

namespace Meubleo\Platform\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Meubleo\Platform\Shop;

/**
 * FoundationServiceProvider
 *
 * Main entry point — auto-discovered by Laravel.
 * After update run: php artisan vendor:publish --provider="Meubleo\Platform\Providers\FoundationServiceProvider"
 */
class FoundationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this
            ->registerViews()
            ->registerTranslations()
            ->registerProviders();
    }

    public function register(): void
    {
        $this->app->singleton(Shop::class, static fn () => new Shop());

        $this
            ->registerScreenMacro()
            ->mergeConfigFrom(Shop::path('config/meubleo.php'), 'meubleo');
    }

    protected function registerViews(): self
    {
        $this->loadViewsFrom(Shop::path('resources/views'), 'meubleo');
        return $this;
    }

    protected function registerTranslations(): self
    {
        $this->loadJsonTranslationsFrom(Shop::path('resources/lang/'));
        return $this;
    }

    protected function registerProviders(): self
    {
        foreach ($this->provides() as $provider) {
            $this->app->register($provider);
        }

        if ($this->app->runningInConsole()) {
            $this->app->register(ConsoleServiceProvider::class);
        }

        return $this;
    }

    /**
     * Register the 'screen' route macro — same pattern as Orchid.
     */
    protected function registerScreenMacro(): self
    {
        if (Route::hasMacro('meubleoScreen')) {
            return $this;
        }

        Route::macro('meubleoScreen', function (string $url, string $screen) {
            return Route::match(['GET', 'HEAD', 'POST'], $url . '/{method?}', $screen)
                ->where('method', $screen::getAvailableMethods()->implode('|'));
        });

        return $this;
    }

    public function provides(): array
    {
        return [
            RouteServiceProvider::class,
            PlatformServiceProvider::class,
        ];
    }
}
