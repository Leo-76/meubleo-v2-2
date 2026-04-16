<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Screens;

use Meubleo\Platform\Models\Order;
use Meubleo\Platform\Models\Product;
use Meubleo\Screen\Screen;

class DashboardScreen extends Screen
{
    public ?string $name        = 'Dashboard';
    public ?string $description = 'Meubleo Shop overview';

    public function query(): iterable
    {
        return [
            'total_orders'    => Order::count(),
            'pending_orders'  => Order::where('status', 'pending')->count(),
            'total_products'  => Product::count(),
            'revenue'         => Order::whereIn('status', ['paid','processing','shipped','delivered'])->sum('total'),
            'recent_orders'   => Order::with('user')->latest()->take(10)->get(),
        ];
    }

    public function commandBar(): iterable
    {
        return [];
    }

    public function layout(): iterable
    {
        return [
            'meubleo::admin.dashboard',
        ];
    }
}
