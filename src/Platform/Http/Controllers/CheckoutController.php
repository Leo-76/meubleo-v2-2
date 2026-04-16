<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Meubleo\Platform\Services\CartService;
use Meubleo\Platform\Services\OrderService;

class CheckoutController extends Controller
{
    public function __construct(private CartService $cart, private OrderService $orders) {}

    public function index()
    {
        if ($this->cart->count() === 0) {
            return redirect()->route('meubleo.cart.index')->with('error', 'Votre panier est vide.');
        }
        return view('meubleo::shop.checkout', [
            'items'    => $this->cart->items(),
            'subtotal' => $this->cart->subtotal(),
            'shipping' => $this->cart->shippingCost(),
            'total'    => $this->cart->total(),
            'user'     => Auth::user(),
        ]);
    }

    public function process(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'address'     => 'required|string|max:255',
            'city'        => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'payment_id'  => 'required|string',
        ]);

        $order = $this->orders->createFromCart(
            $request->only('name','address','city','postal_code','country','phone','notes'),
            $request->payment_id
        );

        return redirect()->route('meubleo.orders.confirmation', $order)
            ->with('success', 'Commande confirmée !');
    }
}
