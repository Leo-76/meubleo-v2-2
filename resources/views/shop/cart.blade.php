@extends('meubleo::layouts.shop')
@section('title', 'Mon panier — ' . config('meubleo.shop_name'))

@section('content')
<div class="container" style="padding:2.5rem 1.5rem 5rem">
    <h1 class="shop-page-title">Mon panier</h1>

    @if($items->isEmpty())
        <div class="shop-empty">
            <p>Votre panier est vide.</p>
            <a href="{{ route('meubleo.products.index') }}" class="btn-shop btn-shop--primary">
                Continuer mes achats
            </a>
        </div>
    @else
    <div class="shop-cart-grid">
        <div class="shop-cart-items">
            @foreach($items as $item)
            <div class="shop-cart-item">
                <div class="shop-cart-item__image">
                    @if($item->product->primaryImage)
                        <img src="{{ asset('storage/' . $item->product->primaryImage->path) }}"
                             alt="{{ $item->product->name }}">
                    @else
                        <div class="shop-cart-item__placeholder">🛋️</div>
                    @endif
                </div>
                <div class="shop-cart-item__info">
                    <h3><a href="{{ route('meubleo.products.show', $item->product->slug) }}">{{ $item->product->name }}</a></h3>
                    <p class="text-muted">{{ meubleo_price($item->product->current_price) }}</p>
                </div>
                <div class="shop-cart-item__actions">
                    <form action="{{ route('meubleo.cart.update', $item->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="number" name="quantity" value="{{ $item->quantity }}"
                               min="1" max="{{ $item->product->stock }}"
                               class="shop-input shop-input--qty"
                               onchange="this.form.submit()">
                    </form>
                    <span class="fw-bold">{{ meubleo_price($item->product->current_price * $item->quantity) }}</span>
                    <form action="{{ route('meubleo.cart.remove', $item->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="shop-btn-remove">✕</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="shop-cart-summary">
            <h2>Résumé</h2>
            <div class="shop-summary-line"><span>Sous-total</span><span>{{ meubleo_price($subtotal) }}</span></div>
            <div class="shop-summary-line">
                <span>Livraison</span>
                <span>{{ $shipping > 0 ? meubleo_price($shipping) : '🎉 Offerte' }}</span>
            </div>
            @if($shipping > 0)
                <p class="shop-summary-hint">
                    Plus que {{ meubleo_price(config('meubleo.free_shipping_threshold') - $subtotal) }} pour la livraison gratuite !
                </p>
            @endif
            <div class="shop-summary-line shop-summary-line--total">
                <span>Total HT</span><span>{{ meubleo_price($total) }}</span>
            </div>
            <p style="font-size:.78rem;color:#8A8070;margin-bottom:1rem">TVA 20% incluse</p>
            @auth
                <a href="{{ route('meubleo.checkout.index') }}" class="btn-shop btn-shop--primary btn-shop--full btn-shop--lg">
                    Commander
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-shop btn-shop--primary btn-shop--full btn-shop--lg">
                    Se connecter pour commander
                </a>
            @endauth
            <a href="{{ route('meubleo.products.index') }}"
               class="btn-shop btn-shop--outline btn-shop--full" style="margin-top:.5rem">
                Continuer mes achats
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
