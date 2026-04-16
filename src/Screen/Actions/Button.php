<?php declare(strict_types=1);

namespace Meubleo\Screen\Actions;

use Meubleo\Screen\Action;

/**
 * Button — submits a form action to the screen method.
 *
 * Usage: Button::make('Save')->method('save')->icon('bs.save')
 */
class Button extends Action
{
    protected string $view = 'meubleo::actions.button';

    protected array $attributes = [
        'class'  => 'btn btn-primary',
        'type'   => 'submit',
        'method' => 'save',
    ];

    public function method(string $method): static
    {
        return $this->set('method', $method);
    }

    public function confirm(string $message): static
    {
        return $this->set('confirm', $message);
    }

    public function danger(): static
    {
        return $this->set('class', 'btn btn-danger');
    }

    public function warning(): static
    {
        return $this->set('class', 'btn btn-warning');
    }

    public function outline(): static
    {
        return $this->set('class', 'btn btn-outline-primary');
    }
}
