@extends('meubleo::layouts.shop')
@section('title', 'Commande confirmée — ' . config('meubleo.shop_name'))

@section('content')
<div class="container" style="max-width:640px;text-align:center;padding:5rem 1.5rem">
    <div style="font-size:3.5rem;margin-bottom:1rem">✓</div>
    <h1 style="font-family:'Cormorant Garamond',serif;font-size:2.2rem;font-weight:400;color:#5C4A32">
        Merci pour votre commande !
    </h1>
    <p style="font-size:1.1rem;margin:.75rem 0">
        Commande <strong>{{ $order->order_number }}</strong>
    </p>
    <p style="color:#8A8070">
        Vous recevrez un email de confirmation. Votre commande sera préparée sous 48h.
    </p>

    <div class="card shadow-sm" style="margin:2rem auto;text-align:left;max-width:480px">
        <div class="card-body">
            @foreach($order->items as $item)
            <div class="d-flex justify-content-between py-1">
                <span>{{ $item->product_name }} × {{ $item->quantity }}</span>
                <span>{{ meubleo_price($item->total_price) }}</span>
            </div>
            @endforeach
            <hr>
            <div class="d-flex justify-content-between fw-bold">
                <span>Total payé</span>
                <span>{{ meubleo_price($order->total) }}</span>
            </div>
        </div>
    </div>

    <div style="display:flex;gap:1rem;justify-content:center;margin-top:2rem">
        <a href="{{ route('meubleo.orders.show', $order) }}" class="btn-shop btn-shop--outline">
            Voir ma commande
        </a>
        <a href="{{ route('meubleo.home') }}" class="btn-shop btn-shop--primary">
            Retour à l'accueil
        </a>
    </div>
</div>
@endsection
