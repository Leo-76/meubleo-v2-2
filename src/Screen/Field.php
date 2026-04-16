<?php

declare(strict_types=1);

namespace Meubleo\Screen;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Traits\Macroable;

/**
 * Field — base class for all form fields.
 *
 * Usage: Input::make('name')->title('Name')->required()->placeholder('Enter name')
 */
abstract class Field
{
    use Macroable;

    protected string $view;

    protected array $attributes = [
        'class' => 'form-control',
    ];

    protected array $inlineAttributes = [];

    protected bool $see = true;

    /** @var Closure[] */
    protected array $beforeRender = [];

    private function __construct() {}

    public static function make(string $name): static
    {
        $field = new static();
        $field->set('name', $name);
        return $field;
    }

    // ─── Fluent setters ───────────────────────────────────────────────────────

    public function title(string|Htmlable $title): static
    {
        return $this->set('title', $title);
    }

    public function help(string|Htmlable $help): static
    {
        return $this->set('help', $help);
    }

    public function placeholder(string $placeholder): static
    {
        return $this->set('placeholder', $placeholder);
    }

    public function value(mixed $value): static
    {
        return $this->set('value', $value);
    }

    public function required(bool $required = true): static
    {
        return $this->set('required', $required);
    }

    public function disabled(bool $disabled = true): static
    {
        return $this->set('disabled', $disabled);
    }

    public function readonly(bool $readonly = true): static
    {
        return $this->set('readonly', $readonly);
    }

    public function horizontal(bool $horizontal = true): static
    {
        return $this->set('horizontal', $horizontal);
    }

    public function canSee(bool $see): static
    {
        $this->see = $see;
        return $this;
    }

    // ─── Attribute management ─────────────────────────────────────────────────

    public function set(string $key, mixed $value): static
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->attributes[$key] ?? $default;
    }

    protected function addBeforeRender(Closure $closure): static
    {
        $this->beforeRender[] = $closure;
        return $this;
    }

    public function isSee(): bool
    {
        return $this->see;
    }

    // ─── Rendering ────────────────────────────────────────────────────────────

    public function build(Repository $repository): string
    {
        foreach ($this->beforeRender as $closure) {
            $closure->call($this);
        }

        $name  = $this->get('name');
        $value = $repository->get($name, $this->get('value'));

        return view($this->view, [
            'field'      => $this,
            'attributes' => $this->buildAttributes(),
            'value'      => $value,
            'title'      => $this->get('title'),
            'help'       => $this->get('help'),
            'horizontal' => $this->get('horizontal', false),
        ])->render();
    }

    protected function buildAttributes(): array
    {
        return collect($this->attributes)
            ->only(array_merge(['name', 'class', 'id'], $this->inlineAttributes))
            ->filter(fn ($v) => $v !== null && $v !== false)
            ->toArray();
    }

    // ─── Magic __call for dynamic attribute setters ───────────────────────────

    public function __call(string $method, array $arguments): static
    {
        return $this->set($method, $arguments[0] ?? true);
    }
}
