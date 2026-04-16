<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Screens;

use Meubleo\Platform\Models\Product;
use Meubleo\Platform\Http\Layouts\ProductTableLayout;
use Meubleo\Screen\Actions\Button;
use Meubleo\Screen\Actions\Link;
use Meubleo\Screen\Screen;

class ProductListScreen extends Screen
{
    public ?string $name        = 'Products';
    public ?string $description = 'Manage your furniture catalogue';

    public function query(): iterable
    {
        return [
            'products' => Product::with('category')
                ->filters()
                ->defaultSort('created_at', 'desc')
                ->paginate(20),
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('New Product')
                ->icon('bs.plus-circle')
                ->primary()
                ->route('meubleo.admin.products.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            ProductTableLayout::class,
        ];
    }

    public function remove(Product $product): void
    {
        $product->delete();
        toast()->success('Product deleted.');
    }
}
