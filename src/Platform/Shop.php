<?php

declare(strict_types=1);

namespace Meubleo\Platform;

use Illuminate\Support\Collection;

/**
 * Shop — central singleton registry (equivalent to Orchid's Dashboard).
 */
class Shop
{
    public const VERSION = '1.0.0';

    /** @var array<string, mixed> */
    private array $resources = [
        'stylesheets' => [],
        'scripts'     => [],
        'menu'        => [],
        'search'      => [],
    ];

    // ─── Static helpers ───────────────────────────────────────────────────────

    public static function version(): string
    {
        return static::VERSION;
    }

    /**
     * Return absolute path inside the package.
     */
    public static function path(string $path = ''): string
    {
        return realpath(__DIR__ . '/../../') . ($path ? DIRECTORY_SEPARATOR . ltrim($path, '/') : '');
    }

    /**
     * Return the URL prefix for the admin panel.
     */
    public static function prefix(string $path = ''): string
    {
        $prefix = config('meubleo.prefix', 'admin');
        return trim($prefix . $path, '/');
    }

    // ─── Resource registration ────────────────────────────────────────────────

    public function registerResource(string $type, string|array|null $resource): self
    {
        if ($resource === null) {
            return $this;
        }

        $this->resources[$type] = array_merge(
            $this->resources[$type] ?? [],
            (array) $resource
        );

        return $this;
    }

    public function getResource(string $type): array
    {
        return $this->resources[$type] ?? [];
    }

    public function registerSearch(array $models): self
    {
        $this->resources['search'] = array_unique(
            array_merge($this->resources['search'], $models)
        );
        return $this;
    }

    public function registerMenu(array $items): self
    {
        $this->resources['menu'] = array_merge($this->resources['menu'], $items);
        return $this;
    }

    public function getMenu(): array
    {
        return $this->resources['menu'];
    }

    public function flushState(): void
    {
        $this->resources = [
            'stylesheets' => [],
            'scripts'     => [],
            'menu'        => [],
            'search'      => [],
        ];
    }
}
