@extends('meubleo::layouts.shop')
@section('title', 'Mes commandes')
@section('content')
<div class="container" style="padding:2.5rem 1.5rem 5rem">
    <h1 class="shop-page-title">Mes commandes</h1>
    @if($orders->isEmpty())
        <div class="shop-empty"><p>Aucune commande pour l'instant.</p></div>
    @else
    <div class="card shadow-sm">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>Commande</th><th>Date</th><th>Statut</th><th class="text-end">Total</th><th></th></tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td><code>{{ $order->order_number }}</code></td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td><span class="badge bg-{{ $order->status_badge }}">{{ $order->status_label }}</span></td>
                    <td class="text-end fw-bold">{{ meubleo_price($order->total) }}</td>
                    <td><a href="{{ route('meubleo.orders.show', $order) }}">Détail →</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer">{{ $orders->links() }}</div>
    </div>
    @endif
</div>
@endsection
