<?php declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Meubleo\Platform\Shop;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'meubleo:table')]
class TableCommand extends BaseGeneratorCommand
{
    protected $name        = 'meubleo:table';
    protected $description = 'Create a new Meubleo Table Layout class';
    protected $type        = 'Table';

    protected function getStub(): string { return Shop::path('stubs/table.stub'); }
    protected function getSubNamespace(): string { return 'Layouts'; }
}
