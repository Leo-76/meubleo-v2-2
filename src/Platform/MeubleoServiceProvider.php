<?php

declare(strict_types=1);

namespace Meubleo\Platform;

use Illuminate\Contracts\Foundation\CachesRoutes;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Meubleo\Screen\Actions\Menu;

/**
 * MeubleoServiceProvider
 *
 * Extend this class in your application to register menus, permissions and routes
 * for the Meubleo admin panel.
 *
 * Example: app/Meubleo/MeubleoServiceProvider.php
 */
abstract class MeubleoServiceProvider extends ServiceProvider
{
    protected ?Shop $shop;

    public function boot(Shop $shop): void
    {
        $this->shop = $shop;

        $this
            ->defineRoutes()
            ->defineMenu();
    }

    // ─── Override these in your app ───────────────────────────────────────────

    /**
     * Return menu items for the admin sidebar.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [];
    }

    /**
     * Define additional routes inside the admin prefix.
     */
    public function routes(Router $router): void
    {
        // Define your routes here.
    }

    // ─── Internals ────────────────────────────────────────────────────────────

    private function defineRoutes(): static
    {
        if ($this->app instanceof CachesRoutes && $this->app->routesAreCached()) {
            return $this;
        }

        Route::prefix(Shop::prefix('/'))
            ->middleware(config('meubleo.middleware.private', ['web', 'auth', 'meubleo.admin']))
            ->group(function (Router $router) {
                $this->routes($router);
            });

        return $this;
    }

    private function defineMenu(): static
    {
        View::composer('meubleo::layouts.app', function () {
            foreach ($this->menu() as $item) {
                $this->shop?->registerMenu([$item]);
            }
        });

        return $this;
    }
}
