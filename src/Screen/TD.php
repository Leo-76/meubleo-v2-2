<?php

declare(strict_types=1);

namespace Meubleo\Screen;

use Closure;
use Illuminate\Support\Traits\Macroable;

/**
 * TD — Table column definition with fluent API.
 *
 * Usage: TD::make('name', 'Product name')->sort()->width('200px')
 */
class TD
{
    use Macroable;

    protected string $column;
    protected ?string $title;
    protected bool $sort   = false;
    protected bool $see    = true;
    protected ?string $width = null;
    protected ?string $align = null;
    protected ?Closure $render = null;

    private function __construct(string $column, ?string $title = null)
    {
        $this->column = $column;
        $this->title  = $title ?? $column;
    }

    public static function make(string $column, ?string $title = null): static
    {
        return new static($column, $title);
    }

    public function sort(bool $sort = true): static
    {
        $this->sort = $sort;
        return $this;
    }

    public function width(string $width): static
    {
        $this->width = $width;
        return $this;
    }

    public function alignLeft(): static   { $this->align = 'text-start'; return $this; }
    public function alignCenter(): static { $this->align = 'text-center'; return $this; }
    public function alignRight(): static  { $this->align = 'text-end'; return $this; }

    public function cantHide(): static { return $this; }

    public function render(Closure $closure): static
    {
        $this->render = $closure;
        return $this;
    }

    public function isSee(): bool { return $this->see; }
    public function canHide(): bool { return true; }

    public function getTitle(): string   { return $this->title ?? $this->column; }
    public function getColumn(): string  { return $this->column; }
    public function getWidth(): ?string  { return $this->width; }
    public function getAlign(): ?string  { return $this->align; }
    public function isSort(): bool       { return $this->sort; }

    public function getValue(mixed $model): mixed
    {
        if ($this->render !== null) {
            return ($this->render)($model);
        }

        return data_get($model, $this->column);
    }
}
