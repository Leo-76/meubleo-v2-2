<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Meubleo\Platform\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('meubleo::shop.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        $order->load('items.product');
        return view('meubleo::shop.orders.show', compact('order'));
    }

    public function confirmation(Order $order)
    {
        abort_if($order->user_id !== Auth::id(), 403);
        $order->load('items');
        return view('meubleo::shop.orders.confirmation', compact('order'));
    }
}
