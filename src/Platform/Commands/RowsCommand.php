<?php declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Meubleo\Platform\Shop;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'meubleo:rows')]
class RowsCommand extends BaseGeneratorCommand
{
    protected $name        = 'meubleo:rows';
    protected $description = 'Create a new Meubleo Rows Layout class (form fields)';
    protected $type        = 'Rows';

    protected function getStub(): string { return Shop::path('stubs/rows.stub'); }
    protected function getSubNamespace(): string { return 'Layouts'; }
}
