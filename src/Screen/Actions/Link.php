<?php declare(strict_types=1);

namespace Meubleo\Screen\Actions;

use Meubleo\Screen\Action;

/**
 * Link — a navigation link in the commandBar.
 *
 * Usage: Link::make('New Product')->route('meubleo.admin.products.create')->icon('bs.plus')
 */
class Link extends Action
{
    protected string $view = 'meubleo::actions.link';

    protected array $attributes = [
        'class'  => 'btn btn-outline-secondary',
        'target' => '_self',
    ];

    public function href(string $url): static
    {
        return $this->set('href', $url);
    }

    public function route(string $name, mixed ...$parameters): static
    {
        return $this->set('href', route($name, ...$parameters));
    }

    public function blank(): static
    {
        return $this->set('target', '_blank');
    }

    public function primary(): static
    {
        return $this->set('class', 'btn btn-primary');
    }
}
