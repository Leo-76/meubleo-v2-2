<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Layouts;

use Meubleo\Platform\Models\Product;
use Meubleo\Screen\Actions\Button;
use Meubleo\Screen\Actions\Link;
use Meubleo\Screen\Layouts\Table;
use Meubleo\Screen\TD;

class ProductTableLayout extends Table
{
    protected string $target = 'products';

    protected function columns(): iterable
    {
        return [
            TD::make('id', '#')
                ->width('60px')
                ->sort()
                ->alignCenter(),

            TD::make('name', 'Product')
                ->sort()
                ->render(fn (Product $p) =>
                    '<a href="' . route('meubleo.admin.products.edit', $p) . '">' . e($p->name) . '</a>'
                ),

            TD::make('category.name', 'Category'),

            TD::make('price', 'Price')
                ->sort()
                ->alignRight()
                ->render(fn (Product $p) =>
                    $p->is_on_sale
                        ? '<del class="text-muted">' . number_format($p->price, 2) . ' €</del> '
                          . '<strong class="text-danger">' . number_format($p->sale_price, 2) . ' €</strong>'
                        : number_format($p->price, 2) . ' €'
                ),

            TD::make('stock', 'Stock')
                ->sort()
                ->alignCenter()
                ->render(fn (Product $p) =>
                    $p->stock > 0
                        ? '<span class="badge bg-success">' . $p->stock . '</span>'
                        : '<span class="badge bg-danger">Out of stock</span>'
                ),

            TD::make('is_featured', 'Featured')
                ->alignCenter()
                ->render(fn (Product $p) =>
                    $p->is_featured ? '★' : '—'
                ),

            TD::make('created_at', 'Created')
                ->sort()
                ->render(fn (Product $p) => $p->created_at->format('d/m/Y')),

            TD::make('actions', '')
                ->alignRight()
                ->render(fn (Product $p) =>
                    Link::make('Edit')
                        ->icon('bs.pencil')
                        ->route('meubleo.admin.products.edit', $p)
                        ->build()
                ),
        ];
    }
}
