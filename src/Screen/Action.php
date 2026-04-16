<?php

declare(strict_types=1);

namespace Meubleo\Screen;

use Illuminate\Contracts\View\View;

/**
 * Action — base class for commandBar buttons/links.
 */
abstract class Action
{
    protected string $view;
    protected array  $attributes = [];
    protected bool   $see = true;

    private function __construct() {}

    public static function make(?string $name = null): static
    {
        $action = new static();
        if ($name !== null) {
            $action->set('name', $name);
        }
        return $action;
    }

    public function name(string $name): static   { return $this->set('name', $name); }
    public function icon(string $icon): static   { return $this->set('icon', $icon); }
    public function class(string $class): static { return $this->set('class', $class); }
    public function canSee(bool $see): static    { $this->see = $see; return $this; }
    public function isSee(): bool                { return $this->see; }

    protected function set(string $key, mixed $value): static
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    protected function get(string $key, mixed $default = null): mixed
    {
        return $this->attributes[$key] ?? $default;
    }

    public function build(): View
    {
        return view($this->view, ['action' => $this, 'attributes' => $this->attributes]);
    }

    public function __call(string $method, array $args): static
    {
        return $this->set($method, $args[0] ?? true);
    }
}
