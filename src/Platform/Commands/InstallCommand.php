<?php

declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Illuminate\Console\Command;
use Meubleo\Platform\Shop;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'meubleo:install')]
class InstallCommand extends Command
{
    protected $signature   = 'meubleo:install';
    protected $description = 'Install all Meubleo Shop files';

    public function handle(): void
    {
        $this->comment('Installation started. Please wait…');
        $this->info('Version: ' . Shop::version());

        $this
            ->step('vendor:publish', [
                '--provider' => \Meubleo\Platform\Providers\ConsoleServiceProvider::class,
                '--tag'      => ['meubleo-config', 'meubleo-migrations', 'meubleo-stubs', 'meubleo-assets'],
            ])
            ->step('migrate')
            ->step('storage:link');

        $this->info('✓ Completed!');
        $this->comment("Create an admin user: php artisan meubleo:admin");
        $this->line("Start the server: php artisan serve");
    }

    private function step(string $command, array $params = []): self
    {
        try {
            $result = $this->callSilent($command, $params);
        } catch (\Exception $e) {
            $result = 1;
            $this->alert($e->getMessage());
        }

        if ($result) {
            $this->alert("Command '{$command}' failed. Run it manually.");
        } else {
            $this->line("  ✓ {$command}");
        }

        return $this;
    }
}
