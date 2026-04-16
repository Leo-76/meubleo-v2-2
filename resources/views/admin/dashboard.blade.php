@extends('meubleo::layouts.app')
@section('title', 'Dashboard — ' . config('meubleo.shop_name'))

@section('content')
<div class="meubleo-screen">
    <div class="meubleo-screen__header">
        <div>
            <h1 class="meubleo-screen__title">Dashboard</h1>
            <p class="meubleo-screen__description">{{ config('meubleo.shop_name') }} — Overview</p>
        </div>
    </div>

    <div class="meubleo-screen__body">

        {{-- Stats --}}
        <div class="row g-3 mb-4">
            @foreach([
                ['label' => 'Total Orders',   'value' => $repository->get('total_orders'),   'color' => 'primary',  'icon' => '📦'],
                ['label' => 'Pending Orders',  'value' => $repository->get('pending_orders'),  'color' => 'warning',  'icon' => '⏳'],
                ['label' => 'Products',        'value' => $repository->get('total_products'),  'color' => 'info',     'icon' => '🛋️'],
                ['label' => 'Revenue',         'value' => meubleo_price($repository->get('revenue', 0)), 'color' => 'success', 'icon' => '💶'],
            ] as $stat)
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div style="font-size:2rem">{{ $stat['icon'] }}</div>
                        <div>
                            <div class="text-muted small">{{ $stat['label'] }}</div>
                            <div class="fw-bold fs-4 text-{{ $stat['color'] }}">{{ $stat['value'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Recent orders --}}
        <div class="card shadow-sm">
            <div class="card-header fw-semibold">Recent Orders</div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th><th>Order</th><th>Customer</th>
                            <th>Status</th><th class="text-end">Total</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($repository->get('recent_orders', []) as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td><code>{{ $order->order_number }}</code></td>
                            <td>{{ $order->user?->name }}</td>
                            <td>
                                <span class="badge bg-{{ $order->status_badge }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="text-end fw-semibold">{{ meubleo_price($order->total) }}</td>
                            <td class="text-muted small">{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No orders yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
