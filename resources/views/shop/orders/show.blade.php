@extends('meubleo::layouts.shop')
@section('title', 'Commande ' . $order->order_number)
@section('content')
<div class="container" style="padding:2.5rem 1.5rem 5rem;max-width:800px">
    <a href="{{ route('meubleo.orders.index') }}" style="color:#8A8070;font-size:.9rem">← Mes commandes</a>
    <h1 class="shop-page-title" style="margin-top:1rem">Commande {{ $order->order_number }}</h1>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            @foreach($order->items as $item)
            <div class="d-flex justify-content-between py-2 border-bottom">
                <div>
                    <p class="fw-semibold mb-0">{{ $item->product_name }}</p>
                    <p class="text-muted small mb-0">{{ meubleo_price($item->unit_price) }} × {{ $item->quantity }}</p>
                </div>
                <strong>{{ meubleo_price($item->total_price) }}</strong>
            </div>
            @endforeach
            <div class="d-flex justify-content-between pt-3 fw-bold">
                <span>Total</span><span>{{ meubleo_price($order->total) }}</span>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5>Adresse de livraison</h5>
            <p class="mb-0">{{ $order->shipping_name }}<br>
            {{ $order->shipping_address }}<br>
            {{ $order->shipping_postal_code }} {{ $order->shipping_city }}<br>
            {{ $order->shipping_country }}</p>
        </div>
    </div>
</div>
@endsection
