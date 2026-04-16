<article class="shop-product-card">
    <a href="{{ route('meubleo.products.show', $product->slug) }}" class="shop-product-card__image-link">
        <div class="shop-product-card__image">
            @if($product->primaryImage)
                <img src="{{ asset('storage/' . $product->primaryImage->path) }}"
                     alt="{{ $product->name }}" loading="lazy">
            @else
                <div class="shop-product-card__placeholder">🛋️</div>
            @endif
            @if($product->is_on_sale)
                <span class="shop-product-card__badge">Promo</span>
            @endif
        </div>
    </a>
    <div class="shop-product-card__body">
        <span class="shop-product-card__category">{{ $product->category->name ?? '' }}</span>
        <h3 class="shop-product-card__name">
            <a href="{{ route('meubleo.products.show', $product->slug) }}">{{ $product->name }}</a>
        </h3>
        <div class="shop-product-card__price">
            @if($product->is_on_sale)
                <span class="shop-price shop-price--sale">{{ meubleo_price($product->sale_price) }}</span>
                <span class="shop-price shop-price--old">{{ meubleo_price($product->price) }}</span>
            @else
                <span class="shop-price">{{ meubleo_price($product->price) }}</span>
            @endif
        </div>
        <form action="{{ route('meubleo.cart.add') }}" method="POST" class="shop-product-card__action">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn-shop btn-shop--primary btn-shop--sm"
                    {{ $product->stock === 0 ? 'disabled' : '' }}>
                {{ $product->stock === 0 ? 'Rupture' : 'Ajouter au panier' }}
            </button>
        </form>
    </div>
</article>
