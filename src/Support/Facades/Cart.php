<?php declare(strict_types=1);

namespace Meubleo\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Illuminate\Support\Collection items()
 * @method static \Meubleo\Platform\Models\CartItem add(int $productId, int $quantity = 1)
 * @method static void update(int $itemId, int $quantity)
 * @method static void remove(int $itemId)
 * @method static void clear()
 * @method static int   count()
 * @method static float subtotal()
 * @method static float shippingCost()
 * @method static float total()
 *
 * @see \Meubleo\Platform\Services\CartService
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Meubleo\Platform\Services\CartService::class;
    }
}
