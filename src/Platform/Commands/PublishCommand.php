<?php

declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'meubleo:publish')]
class PublishCommand extends Command
{
    protected $signature = 'meubleo:publish
                            {--config    : Publish only the config file}
                            {--views     : Publish only the views}
                            {--assets    : Publish only the CSS/JS assets}
                            {--migrations: Publish only the migrations}
                            {--stubs     : Publish only the app stubs}
                            {--lang      : Publish only the translations}
                            {--force     : Overwrite existing files}';

    protected $description = 'Publish Meubleo Shop resources';

    public function handle(): void
    {
        $tags  = [];
        $flags = ['config', 'views', 'assets', 'migrations', 'stubs', 'lang'];

        foreach ($flags as $flag) {
            if ($this->option($flag)) {
                $tags[] = "meubleo-{$flag}";
            }
        }

        if (empty($tags)) {
            $tags = ['meubleo'];
        }

        $params = ['--provider' => \Meubleo\Platform\Providers\ConsoleServiceProvider::class, '--tag' => $tags];

        if ($this->option('force')) {
            $params['--force'] = true;
        }

        $this->callSilent('vendor:publish', $params);
        $this->info('✓ Meubleo assets published.');
    }
}
