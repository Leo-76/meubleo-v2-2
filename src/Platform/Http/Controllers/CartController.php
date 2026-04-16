<?php

declare(strict_types=1);

namespace Meubleo\Platform\Http\Controllers;

use Illuminate\Http\Request;
use Meubleo\Platform\Services\CartService;

class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    public function index()
    {
        return view('meubleo::shop.cart', [
            'items'    => $this->cart->items(),
            'subtotal' => $this->cart->subtotal(),
            'shipping' => $this->cart->shippingCost(),
            'total'    => $this->cart->total(),
        ]);
    }

    public function add(Request $request)
    {
        $request->validate(['product_id'=>'required|exists:meubleo_products,id','quantity'=>'integer|min:1|max:99']);
        $this->cart->add($request->product_id, $request->quantity ?? 1);
        return back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request, int $item)
    {
        $request->validate(['quantity'=>'required|integer|min:1|max:99']);
        $this->cart->update($item, $request->quantity);
        return back()->with('success', 'Panier mis à jour.');
    }

    public function remove(int $item)
    {
        $this->cart->remove($item);
        return back()->with('success', 'Article supprimé.');
    }
}
