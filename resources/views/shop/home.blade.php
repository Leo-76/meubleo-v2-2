@extends('meubleo::layouts.shop')
@section('title', config('meubleo.shop_name') . ' — Mobilier d\'exception')

@section('content')
<section class="shop-hero">
    <div class="shop-hero__content">
        <span class="shop-hero__eyebrow">Nouvelle collection</span>
        <h1 class="shop-hero__title">L'art de<br><em>vivre chez soi</em></h1>
        <p class="shop-hero__subtitle">Des meubles conçus pour durer, imaginés pour enchanter.</p>
        <a href="{{ route('meubleo.products.index') }}" class="btn-shop btn-shop--primary btn-shop--lg">
            Découvrir la collection
        </a>
    </div>
</section>

<section class="shop-section">
    <div class="container">
        <h2 class="shop-section__title">Nos univers</h2>
        <div class="shop-categories">
            @foreach($categories as $cat)
            <a href="{{ route('meubleo.products.index', ['category' => $cat->slug]) }}" class="shop-category-card">
                <span class="shop-category-card__name">{{ $cat->name }}</span>
                <span class="shop-category-card__count">{{ $cat->products_count }} produits</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<section class="shop-section shop-section--alt">
    <div class="container">
        <div class="shop-section__header">
            <h2 class="shop-section__title">Coups de cœur</h2>
            <a href="{{ route('meubleo.products.index') }}" class="shop-link-arrow">Tout voir →</a>
        </div>
        <div class="shop-products-grid">
            @foreach($featured as $product)
                @include('meubleo::shop.partials.product-card', compact('product'))
            @endforeach
        </div>
    </div>
</section>

<section class="shop-banner">
    <div class="container shop-banner__inner">
        @foreach([
            ['icon'=>'🚚','title'=>'Livraison offerte','sub'=>'Dès ' . meubleo_price(config('meubleo.free_shipping_threshold'))],
            ['icon'=>'🔨','title'=>'Montage inclus','sub'=>'Par nos équipes'],
            ['icon'=>'↩','title'=>'Retours 30 jours','sub'=>'Satisfait ou remboursé'],
            ['icon'=>'🛡','title'=>'Garantie 2 ans','sub'=>'Sur tous nos produits'],
        ] as $item)
        <div class="shop-banner__item">
            <span class="shop-banner__icon">{{ $item['icon'] }}</span>
            <div>
                <strong>{{ $item['title'] }}</strong>
                <p>{{ $item['sub'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="shop-section">
    <div class="container">
        <div class="shop-section__header">
            <h2 class="shop-section__title">Dernières arrivées</h2>
            <a href="{{ route('meubleo.products.index', ['sort' => 'newest']) }}" class="shop-link-arrow">Voir tout →</a>
        </div>
        <div class="shop-products-grid">
            @foreach($newArrivals as $product)
                @include('meubleo::shop.partials.product-card', compact('product'))
            @endforeach
        </div>
    </div>
</section>
@endsection
