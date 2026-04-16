<?php

declare(strict_types=1);

use Meubleo\Support\Toast;

if (! function_exists('toast')) {
    function toast(): Toast
    {
        return app(Toast::class);
    }
}

if (! function_exists('meubleo_price')) {
    function meubleo_price(float $amount): string
    {
        $symbol = config('meubleo.currency_symbol', '€');
        return number_format($amount, 2, ',', ' ') . ' ' . $symbol;
    }
}

if (! function_exists('meubleo_prefix')) {
    function meubleo_prefix(string $path = ''): string
    {
        return \Meubleo\Platform\Shop::prefix($path);
    }
}
