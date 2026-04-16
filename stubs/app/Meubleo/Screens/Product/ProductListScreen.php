<?php

namespace App\Meubleo\Screens\Product;

use Meubleo\Platform\Models\Product;
use Meubleo\Screen\Actions\Link;
use Meubleo\Screen\Screen;
use App\Meubleo\Layouts\Product\ProductTableLayout;

class ProductListScreen extends Screen
{
    public ?string $name        = 'Products';
    public ?string $description = 'Manage your furniture catalogue';

    public function query(): iterable
    {
        return [
            'products' => Product::with('category')->latest()->paginate(20),
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
}
