<?php

declare(strict_types=1);

namespace Meubleo\Platform\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Meubleo\Platform\Models\Order;
use Meubleo\Platform\Models\OrderItem;

class OrderService
{
    public function __construct(private CartService $cart) {}

    public function createFromCart(array $shipping, string $paymentId): Order
    {
        return DB::transaction(function () use ($shipping, $paymentId) {
            $subtotal = $this->cart->subtotal();
            $shippingCost = $this->cart->shippingCost();
            $tax   = round($subtotal * config('meubleo.tax_rate', 0.20), 2);
            $total = $subtotal + $shippingCost + $tax;

            $order = Order::create([
                'user_id'              => Auth::id(),
                'status'               => 'paid',
                'subtotal'             => $subtotal,
                'shipping'             => $shippingCost,
                'tax'                  => $tax,
                'total'                => $total,
                'payment_method'       => 'stripe',
                'payment_id'           => $paymentId,
                'shipping_name'        => $shipping['name'],
                'shipping_address'     => $shipping['address'],
                'shipping_city'        => $shipping['city'],
                'shipping_postal_code' => $shipping['postal_code'],
                'shipping_country'     => $shipping['country'] ?? 'France',
                'shipping_phone'       => $shipping['phone'] ?? null,
                'notes'                => $shipping['notes'] ?? null,
            ]);

            foreach ($this->cart->items() as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item->product_id,
                    'product_name' => $item->product->name,
                    'quantity'     => $item->quantity,
                    'unit_price'   => $item->product->current_price,
                    'total_price'  => $item->product->current_price * $item->quantity,
                ]);
                $item->product->decrement('stock', $item->quantity);
            }

            $this->cart->clear();
            return $order;
        });
    }
}
