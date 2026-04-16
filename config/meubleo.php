<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Meubleo Shop — Configuration
    |--------------------------------------------------------------------------
    */

    // Admin panel URL prefix (e.g. "admin" → /admin)
    'prefix' => env('MEUBLEO_PREFIX', 'admin'),

    // Domain for the admin panel (null = same domain)
    'domain' => env('MEUBLEO_DOMAIN', null),

    // App-level service provider (register menus, permissions, routes)
    'provider' => \App\Meubleo\MeubleoServiceProvider::class,

    // User model
    'user_model' => env('MEUBLEO_USER_MODEL', \App\Models\User::class),

    // Middleware
    'middleware' => [
        'public'  => ['web'],
        'private' => ['web', 'auth', 'meubleo.admin'],
    ],

    // Shop settings
    'shop_name'               => env('MEUBLEO_SHOP_NAME', 'Meubleo'),
    'currency_symbol'         => env('MEUBLEO_CURRENCY_SYMBOL', '€'),
    'tax_rate'                => env('MEUBLEO_TAX_RATE', 0.20),
    'free_shipping_threshold' => env('MEUBLEO_FREE_SHIPPING', 500),
    'shipping_cost'           => env('MEUBLEO_SHIPPING_COST', 29.90),
    'products_per_page'       => env('MEUBLEO_PER_PAGE', 12),

    // Stripe
    'stripe' => [
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    // Searchable models (for admin global search)
    'search' => [
        \Meubleo\Platform\Models\Product::class,
        \Meubleo\Platform\Models\Order::class,
    ],

    // CSS/JS resources injected in the admin layout
    'resource' => [
        'stylesheets' => null,
        'scripts'     => null,
    ],

    // Feature flags
    'features' => [
        'reviews'  => true,
        'wishlist' => true,
    ],

];
