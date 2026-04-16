<?php

declare(strict_types=1);

namespace Meubleo\Screen;

use Illuminate\Contracts\View\View;

/**
 * Layout — abstract base for all screen layout components.
 */
abstract class Layout
{
    protected string $template = '';

    /** @var Layout[] */
    protected array $layouts = [];

    protected ?Repository $query = null;

    abstract public function build(Repository $repository): View|string|null;

    public function isSee(): bool
    {
        return true;
    }

    protected function getSlug(): string
    {
        return md5(static::class);
    }

    /**
     * Build all child layouts and return their rendered HTML.
     */
    protected function buildLayouts(Repository $repository): string
    {
        return collect($this->layouts)
            ->map(fn (Layout $layout) => $layout->build($repository))
            ->filter()
            ->implode('');
    }
}
