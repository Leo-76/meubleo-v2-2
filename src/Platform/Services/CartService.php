<?php

declare(strict_types=1);

namespace Meubleo\Platform\Services;

use Meubleo\Platform\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    private function identifier(): array
    {
        return Auth::check()
            ? ['user_id' => Auth::id()]
            : ['session_id' => Session::getId()];
    }

    public function items()
    {
        return CartItem::where($this->identifier())
            ->with('product.primaryImage')
            ->get();
    }

    public function add(int $productId, int $quantity = 1): CartItem
    {
        $item = CartItem::firstOrNew(
            array_merge($this->identifier(), ['product_id' => $productId])
        );
        $item->quantity = ($item->quantity ?? 0) + $quantity;
        $item->save();
        return $item;
    }

    public function update(int $itemId, int $quantity): void
    {
        CartItem::where($this->identifier())->findOrFail($itemId)
            ->update(['quantity' => $quantity]);
    }

    public function remove(int $itemId): void
    {
        CartItem::where($this->identifier())->findOrFail($itemId)->delete();
    }

    public function clear(): void
    {
        CartItem::where($this->identifier())->delete();
    }

    public function count(): int
    {
        return CartItem::where($this->identifier())->sum('quantity');
    }

    public function subtotal(): float
    {
        return (float) $this->items()
            ->sum(fn ($item) => $item->product->current_price * $item->quantity);
    }

    public function shippingCost(): float
    {
        $subtotal = $this->subtotal();
        if ($subtotal === 0.0) return 0.0;
        return $subtotal >= config('meubleo.free_shipping_threshold', 500)
            ? 0.0
            : (float) config('meubleo.shipping_cost', 29.90);
    }

    public function total(): float
    {
        return $this->subtotal() + $this->shippingCost();
    }

    public function mergeSessionCart(): void
    {
        if (! Auth::check()) return;
        $sessionItems = CartItem::where('session_id', Session::getId())->get();
        foreach ($sessionItems as $item) {
            $this->add($item->product_id, $item->quantity);
            $item->delete();
        }
    }
}
