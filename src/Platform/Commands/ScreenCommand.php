<?php

declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Meubleo\Platform\Shop;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'meubleo:screen')]
class ScreenCommand extends BaseGeneratorCommand
{
    protected $name        = 'meubleo:screen';
    protected $description = 'Create a new Meubleo Screen class';
    protected $type        = 'Screen';

    protected function getStub(): string
    {
        return Shop::path('stubs/screen.stub');
    }

    protected function getSubNamespace(): string
    {
        return 'Screens';
    }
}
