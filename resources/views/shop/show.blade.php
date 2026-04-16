@extends('meubleo::layouts.shop')
@section('title', $product->name . ' — ' . config('meubleo.shop_name'))

@section('content')
<div class="container shop-product-detail">
    <div class="shop-product-detail__gallery">
        <div class="shop-gallery__main">
            @if($product->images->count())
                <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                     alt="{{ $product->name }}" id="main-img">
            @else
                <div class="shop-gallery__placeholder">🛋️</div>
            @endif
        </div>
        @if($product->images->count() > 1)
        <div class="shop-gallery__thumbs">
            @foreach($product->images as $img)
            <img src="{{ asset('storage/' . $img->path) }}" alt="Vue {{ $loop->iteration }}"
                 class="shop-gallery__thumb {{ $loop->first ? 'active' : '' }}"
                 onclick="document.getElementById('main-img').src=this.src;
                          document.querySelectorAll('.shop-gallery__thumb').forEach(t=>t.classList.remove('active'));
                          this.classList.add('active')">
            @endforeach
        </div>
        @endif
    </div>

    <div class="shop-product-detail__info">
        <span class="shop-product-detail__category">
            <a href="{{ route('meubleo.products.index', ['category' => $product->category->slug]) }}">
                {{ $product->category->name }}
            </a>
        </span>

        <h1 class="shop-product-detail__name">{{ $product->name }}</h1>

        <div class="shop-product-detail__price">
            @if($product->is_on_sale)
                <span class="shop-price shop-price--sale shop-price--lg">{{ meubleo_price($product->sale_price) }}</span>
                <span class="shop-price shop-price--old">{{ meubleo_price($product->price) }}</span>
                <span class="shop-badge shop-badge--promo">
                    -{{ round((1 - $product->sale_price / $product->price) * 100) }}%
                </span>
            @else
                <span class="shop-price shop-price--lg">{{ meubleo_price($product->price) }}</span>
            @endif
        </div>

        <p class="shop-product-detail__stock {{ $product->stock > 0 ? 'in-stock' : 'out-stock' }}">
            {{ $product->stock > 0 ? "✓ En stock ({$product->stock} disponibles)" : "✗ Rupture de stock" }}
        </p>

        @if($product->stock > 0)
        <form action="{{ route('meubleo.cart.add') }}" method="POST" class="shop-product-detail__form">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="shop-qty-wrap">
                <label>Quantité</label>
                <input type="number" name="quantity" value="1" min="1"
                       max="{{ $product->stock }}" class="shop-input shop-input--qty">
            </div>
            <button type="submit" class="btn-shop btn-shop--primary btn-shop--lg btn-shop--full">
                Ajouter au panier
            </button>
        </form>
        @endif

        <div class="shop-product-specs">
            @if($product->material)  <div><strong>Matière :</strong> {{ $product->material }}</div> @endif
            @if($product->color)     <div><strong>Couleur :</strong> {{ $product->color }}</div> @endif
            @if($product->dimensions)<div><strong>Dimensions :</strong> {{ $product->dimensions }}</div> @endif
            <div><strong>Référence :</strong> {{ $product->sku }}</div>
        </div>

        <div class="shop-product-description">
            <h2>Description</h2>
            <p>{{ $product->description }}</p>
            @if($product->details)
                <pre class="shop-product-details-text">{{ $product->details }}</pre>
            @endif
        </div>
    </div>
</div>

@if($related->count())
<section class="shop-section shop-section--alt">
    <div class="container">
        <h2 class="shop-section__title">Vous aimerez aussi</h2>
        <div class="shop-products-grid">
            @foreach($related as $product)
                @include('meubleo::shop.partials.product-card', compact('product'))
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
