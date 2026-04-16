<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Screens;

use Illuminate\Http\Request;
use Meubleo\Platform\Models\Category;
use Meubleo\Platform\Models\Product;
use Meubleo\Platform\Http\Layouts\ProductFormLayout;
use Meubleo\Screen\Actions\Button;
use Meubleo\Screen\Actions\Link;
use Meubleo\Screen\Screen;

class ProductEditScreen extends Screen
{
    public ?Product $product = null;

    public function name(): ?string
    {
        return $this->product?->exists
            ? 'Edit: ' . $this->product->name
            : 'New Product';
    }

    public function description(): ?string
    {
        return $this->product?->exists
            ? 'SKU: ' . $this->product->sku
            : 'Fill in the product details below';
    }

    public function query(Product $product): iterable
    {
        $this->product = $product;

        return [
            'product'    => $product,
            'categories' => Category::pluck('name', 'id'),
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make('Back to list')
                ->icon('bs.arrow-left')
                ->route('meubleo.admin.products'),

            Button::make('Save')
                ->icon('bs.save')
                ->method('save'),

            Button::make('Delete')
                ->icon('bs.trash')
                ->danger()
                ->confirm('Are you sure you want to delete this product?')
                ->method('remove')
                ->canSee((bool) $this->product?->exists),
        ];
    }

    public function layout(): iterable
    {
        return [
            ProductFormLayout::class,
        ];
    }

    public function save(Product $product, Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'product.name'        => 'required|string|max:255',
            'product.category_id' => 'required|exists:meubleo_categories,id',
            'product.price'       => 'required|numeric|min:0',
            'product.stock'       => 'required|integer|min:0',
            'product.sku'         => 'required|string',
            'product.description' => 'required|string',
        ]);

        $product->fill($request->input('product'))->save();

        toast()->success('Product saved successfully.');

        return redirect()->route('meubleo.admin.products');
    }

    public function remove(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();

        toast()->success('Product deleted.');

        return redirect()->route('meubleo.admin.products');
    }
}
