<?php

namespace App\Meubleo;

use Meubleo\Platform\MeubleoServiceProvider as ServiceProvider;
use Meubleo\Screen\Actions\Menu;
use Illuminate\Routing\Router;

class MeubleoServiceProvider extends ServiceProvider
{
    /**
     * Register sidebar menu items for the admin panel.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Dashboard')
                ->icon('bs.house')
                ->route('meubleo.admin.dashboard'),

            Menu::make('Products')
                ->icon('bs.box-seam')
                ->route('meubleo.admin.products'),

            Menu::make('Orders')
                ->icon('bs.bag-check')
                ->route('meubleo.admin.orders'),

            Menu::make('Categories')
                ->icon('bs.folder2')
                ->route('meubleo.admin.categories'),
        ];
    }

    /**
     * Register additional routes inside the admin prefix.
     */
    public function routes(Router $router): void
    {
        // Add your custom admin routes here.
    }
}
