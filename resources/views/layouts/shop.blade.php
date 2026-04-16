<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('meubleo.shop_name', 'Meubleo'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/meubleo/css/shop.css') }}">
    @stack('styles')
</head>
<body>

<nav class="shop-nav">
    <div class="container shop-nav__inner">
        <a href="{{ route('meubleo.home') }}" class="shop-nav__logo">
            {{ config('meubleo.shop_name', 'Meubleo') }}
        </a>
        <ul class="shop-nav__links">
            <li><a href="{{ route('meubleo.products.index') }}">Boutique</a></li>
        </ul>
        <div class="shop-nav__actions">
            @auth
                <a href="{{ route('meubleo.orders.index') }}" title="Mes commandes">⊡</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" title="Déconnexion" style="background:none;border:none;cursor:pointer;font-size:1.1rem">↪</button>
                </form>
            @else
                <a href="{{ route('login') }}" title="Connexion">⊙</a>
            @endauth
            <a href="{{ route('meubleo.cart.index') }}" class="shop-nav__cart">
                ◻
                @php $count = app(\Meubleo\Platform\Services\CartService::class)->count() @endphp
                @if($count > 0)
                    <span class="shop-nav__badge">{{ $count }}</span>
                @endif
            </a>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="shop-flash shop-flash--success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="shop-flash shop-flash--error">{{ session('error') }}</div>
@endif

<main>@yield('content')</main>

<footer class="shop-footer">
    <div class="container shop-footer__inner">
        <div>
            <h3 class="shop-footer__brand">{{ config('meubleo.shop_name', 'Meubleo') }}</h3>
            <p>Mobilier d'exception,<br>livré chez vous.</p>
        </div>
        <div>
            <h4>Boutique</h4>
            <ul>
                <li><a href="{{ route('meubleo.products.index') }}">Tous les produits</a></li>
            </ul>
        </div>
        <div>
            <h4>Aide</h4>
            <ul>
                <li><a href="#">Livraison</a></li>
                <li><a href="#">Retours</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </div>
    <div class="shop-footer__bottom">
        <p>© {{ date('Y') }} {{ config('meubleo.shop_name') }}. Tous droits réservés.</p>
    </div>
</footer>

<script src="{{ asset('vendor/meubleo/js/shop.js') }}"></script>
@stack('scripts')
</body>
</html>
