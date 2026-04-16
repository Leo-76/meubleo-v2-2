<?php

declare(strict_types=1);

namespace Meubleo\Platform\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

abstract class BaseGeneratorCommand extends GeneratorCommand
{
    /**
     * Replace DummyNamespace and DummyClass in the stub.
     */
    protected function buildClass($name): string
    {
        $stub = parent::buildClass($name);

        return str_replace(
            ['DummyNamespace', 'DummyClass'],
            [$this->getNamespace($name), class_basename($name)],
            $stub
        );
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\\Meubleo\\' . $this->getSubNamespace();
    }

    abstract protected function getSubNamespace(): string;
}
