<?php declare(strict_types=1);

namespace Meubleo\Screen\Actions;

use Meubleo\Screen\Action;

/**
 * Menu — sidebar navigation item.
 *
 * Usage:
 * Menu::make('Products')
 *     ->icon('bs.box-seam')
 *     ->route('meubleo.admin.products')
 *     ->permission('meubleo.products')
 */
class Menu extends Action
{
    protected string $view = 'meubleo::actions.menu';

    protected array $attributes = [
        'class' => 'nav-link',
    ];

    protected array $children = [];

    public function route(string $name, mixed ...$params): static
    {
        return $this->set('href', route($name, ...$params));
    }

    public function href(string $url): static
    {
        return $this->set('href', $url);
    }

    public function permission(string $permission): static
    {
        return $this->set('permission', $permission);
    }

    public function badge(int|string $value): static
    {
        return $this->set('badge', $value);
    }

    public function list(array $children): static
    {
        $this->children = $children;
        return $this;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function hasChildren(): bool
    {
        return !empty($this->children);
    }
}
