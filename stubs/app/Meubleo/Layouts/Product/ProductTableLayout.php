<?php

namespace App\Meubleo\Layouts\Product;

use Meubleo\Platform\Models\Product;
use Meubleo\Screen\Actions\Link;
use Meubleo\Screen\Layouts\Table;
use Meubleo\Screen\TD;

class ProductTableLayout extends Table
{
    protected string $target = 'products';

    protected function columns(): iterable
    {
        return [
            TD::make('id', '#')->width('60px')->sort()->alignCenter(),

            TD::make('name', 'Product')
                ->sort()
                ->render(fn (Product $p) =>
                    '<a href="' . route('meubleo.admin.products.edit', $p) . '">' . e($p->name) . '</a>'
                ),

            TD::make('category.name', 'Category'),

            TD::make('price', 'Price')
                ->alignRight()
                ->render(fn (Product $p) => meubleo_price($p->current_price)),

            TD::make('stock', 'Stock')
                ->alignCenter()
                ->render(fn (Product $p) =>
                    '<span class="badge bg-' . ($p->stock > 0 ? 'success' : 'danger') . '">'
                    . $p->stock . '</span>'
                ),

            TD::make('is_active', 'Active')
                ->alignCenter()
                ->render(fn (Product $p) => $p->is_active ? '✓' : '—'),
        ];
    }
}
