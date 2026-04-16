@extends('meubleo::layouts.shop')
@section('title', 'Boutique — ' . config('meubleo.shop_name'))

@section('content')
<div class="container shop-layout">

    <aside class="shop-sidebar">
        <h2 class="shop-sidebar__title">Filtres</h2>
        <form method="GET" action="{{ route('meubleo.products.index') }}">
            <div class="shop-filter-group">
                <h3>Catégorie</h3>
                <ul>
                    <li><a href="{{ route('meubleo.products.index') }}" class="{{ !request('category') ? 'active' : '' }}">Toutes</a></li>
                    @foreach($categories as $cat)
                    <li>
                        <a href="?category={{ $cat->slug }}"
                           class="{{ request('category') === $cat->slug ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="shop-filter-group">
                <h3>Prix</h3>
                <div class="shop-price-range">
                    <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="shop-input">
                    <span>—</span>
                    <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="shop-input">
                </div>
                <button type="submit" class="btn-shop btn-shop--outline btn-shop--sm" style="margin-top:.75rem;width:100%">Appliquer</button>
            </div>
        </form>
    </aside>

    <section class="shop-main">
        <div class="shop-toolbar">
            <p class="shop-count">{{ $products->total() }} produits</p>
            <form method="GET">
                @foreach(request()->except('sort') as $k => $v)
                    <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                @endforeach
                <select name="sort" onchange="this.form.submit()" class="shop-select">
                    <option value="name"       {{ request('sort')==='name'       ? 'selected':'' }}>Nom A–Z</option>
                    <option value="price_asc"  {{ request('sort')==='price_asc'  ? 'selected':'' }}>Prix ↑</option>
                    <option value="price_desc" {{ request('sort')==='price_desc' ? 'selected':'' }}>Prix ↓</option>
                    <option value="newest"     {{ request('sort')==='newest'     ? 'selected':'' }}>Nouveautés</option>
                </select>
            </form>
        </div>

        @if($products->isEmpty())
            <div class="shop-empty">
                <p>Aucun produit trouvé.</p>
                <a href="{{ route('meubleo.products.index') }}" class="btn-shop btn-shop--outline">Réinitialiser</a>
            </div>
        @else
            <div class="shop-products-grid">
                @foreach($products as $product)
                    @include('meubleo::shop.partials.product-card', compact('product'))
                @endforeach
            </div>
            <div class="shop-pagination">{{ $products->links() }}</div>
        @endif
    </section>
</div>
@endsection
