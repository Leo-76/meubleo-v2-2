<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Layouts;

use Meubleo\Screen\Fields\Input;
use Meubleo\Screen\Fields\Select;
use Meubleo\Screen\Fields\Switcher;
use Meubleo\Screen\Fields\TextArea;
use Meubleo\Screen\Layouts\Rows;

class ProductFormLayout extends Rows
{
    protected function fields(): iterable
    {
        return [
            Select::make('product.category_id')
                ->title('Category')
                ->fromModel(\Meubleo\Platform\Models\Category::class, 'name')
                ->empty('— Select a category —')
                ->required(),

            Input::make('product.name')
                ->title('Product name')
                ->placeholder('e.g. Canapé Haussmann 3 places')
                ->required(),

            Input::make('product.sku')
                ->title('SKU')
                ->placeholder('e.g. CNP-001')
                ->required(),

            Input::make('product.price')
                ->title('Price (€)')
                ->type('number')
                ->min(0)
                ->step('0.01')
                ->required(),

            Input::make('product.sale_price')
                ->title('Sale price (€) — leave empty if no discount')
                ->type('number')
                ->min(0)
                ->step('0.01'),

            Input::make('product.stock')
                ->title('Stock quantity')
                ->type('number')
                ->min(0)
                ->required(),

            Input::make('product.material')
                ->title('Material')
                ->placeholder('e.g. Velours, Chêne massif'),

            Input::make('product.dimensions')
                ->title('Dimensions')
                ->placeholder('e.g. 220x90x80 cm'),

            Input::make('product.color')
                ->title('Color')
                ->placeholder('e.g. Vert forêt'),

            TextArea::make('product.description')
                ->title('Description')
                ->rows(4)
                ->required(),

            TextArea::make('product.details')
                ->title('Details & bullet points')
                ->rows(4)
                ->placeholder("• Made in Europe\n• 2-year warranty"),

            Switcher::make('product.is_featured')
                ->title('Featured product')
                ->sendTrueOrFalse(),

            Switcher::make('product.is_active')
                ->title('Active (visible in shop)')
                ->sendTrueOrFalse(),
        ];
    }
}
