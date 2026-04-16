<?php declare(strict_types=1);

namespace Meubleo\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Meubleo\Platform\Shop
 */
class Shop extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Meubleo\Platform\Shop::class;
    }
}
