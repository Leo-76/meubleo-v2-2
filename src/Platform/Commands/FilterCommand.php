<?php declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Meubleo\Platform\Shop;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'meubleo:filter')]
class FilterCommand extends BaseGeneratorCommand
{
    protected $name        = 'meubleo:filter';
    protected $description = 'Create a new Meubleo HTTP Filter class';
    protected $type        = 'Filter';

    protected function getStub(): string { return Shop::path('stubs/filter.stub'); }
    protected function getSubNamespace(): string { return 'Filters'; }
}
