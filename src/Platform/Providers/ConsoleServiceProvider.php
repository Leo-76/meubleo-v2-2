<?php

declare(strict_types=1);

namespace Meubleo\Platform\Providers;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;
use Meubleo\Platform\Commands\InstallCommand;
use Meubleo\Platform\Commands\AdminCommand;
use Meubleo\Platform\Commands\ScreenCommand;
use Meubleo\Platform\Commands\TableCommand;
use Meubleo\Platform\Commands\RowsCommand;
use Meubleo\Platform\Commands\FilterCommand;
use Meubleo\Platform\Commands\PublishCommand;
use Meubleo\Platform\Shop;

class ConsoleServiceProvider extends ServiceProvider
{
    protected array $commands = [
        InstallCommand::class,
        AdminCommand::class,
        ScreenCommand::class,
        TableCommand::class,
        RowsCommand::class,
        FilterCommand::class,
        PublishCommand::class,
    ];

    public function boot(): void
    {
        AboutCommand::add('Meubleo Shop', fn () => [
            'Version' => Shop::version(),
            'Prefix'  => config('meubleo.prefix'),
        ]);

        $this
            ->registerMigrationsPublisher()
            ->registerConfigPublisher()
            ->registerViewsPublisher()
            ->registerAssetsPublisher()
            ->registerStubsPublisher()
            ->registerLangPublisher()
            ->commands($this->commands);
    }

    protected function registerMigrationsPublisher(): self
    {
        $this->publishes([
            Shop::path('database/migrations') => database_path('migrations'),
        ], 'meubleo-migrations');
        return $this;
    }

    protected function registerConfigPublisher(): self
    {
        $this->publishes([
            Shop::path('config/meubleo.php') => config_path('meubleo.php'),
        ], 'meubleo-config');
        return $this;
    }

    protected function registerViewsPublisher(): self
    {
        $this->publishes([
            Shop::path('resources/views') => resource_path('views/vendor/meubleo'),
        ], 'meubleo-views');
        return $this;
    }

    protected function registerAssetsPublisher(): self
    {
        $this->publishes([
            Shop::path('public') => public_path('vendor/meubleo'),
        ], ['meubleo-assets', 'laravel-assets']);
        return $this;
    }

    protected function registerStubsPublisher(): self
    {
        $this->publishes([
            Shop::path('stubs/app/routes/')    => base_path('routes'),
            Shop::path('stubs/app/Meubleo/')   => app_path('Meubleo'),
        ], 'meubleo-stubs');
        return $this;
    }

    protected function registerLangPublisher(): self
    {
        $this->publishes([
            Shop::path('resources/lang') => lang_path('vendor/meubleo'),
        ], 'meubleo-lang');
        return $this;
    }
}
