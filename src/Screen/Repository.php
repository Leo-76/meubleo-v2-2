<?php

declare(strict_types=1);

namespace Meubleo\Screen;

use Illuminate\Support\Arr;

/**
 * Repository — wraps the Screen's query() data and provides dot-notation access.
 */
class Repository
{
    public function __construct(private readonly iterable $data) {}

    public function get(string $key, mixed $default = null): mixed
    {
        return Arr::get((array) $this->data, $key, $default);
    }

    public function getContent(string $key): mixed
    {
        return $this->get($key);
    }

    public function toArray(): array
    {
        return (array) $this->data;
    }
}
