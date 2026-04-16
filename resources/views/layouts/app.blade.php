<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('meubleo.shop_name', 'Meubleo') . ' — Admin')</title>
    <link rel="stylesheet" href="{{ asset('vendor/meubleo/css/app.css') }}">
    @stack('styles')
</head>
<body class="meubleo-admin">

<div class="d-flex" style="min-height:100vh">

    {{-- ─── Sidebar ──────────────────────────────────────────────────────── --}}
    <nav class="meubleo-sidebar d-flex flex-column" style="width:240px;flex-shrink:0">
        <div class="meubleo-sidebar__brand">
            <a href="{{ route('meubleo.admin.dashboard') }}">
                {{ config('meubleo.shop_name', 'Meubleo') }}
            </a>
        </div>

        <div class="meubleo-sidebar__nav flex-grow-1">
            @foreach(app(\Meubleo\Platform\Shop::class)->getMenu() as $item)
                <a href="{{ $item->get('href', '#') }}"
                   class="meubleo-sidebar__link {{ request()->url() === $item->get('href') ? 'active' : '' }}">
                    <span class="meubleo-sidebar__icon">{{ $item->get('icon', '•') }}</span>
                    {{ $item->get('name') }}
                    @if($badge = $item->get('badge'))
                        <span class="badge bg-danger ms-auto">{{ $badge }}</span>
                    @endif
                </a>
            @endforeach
        </div>

        <div class="meubleo-sidebar__footer">
            <span>{{ auth()->user()?->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="meubleo-sidebar__logout">Sign out</button>
            </form>
        </div>
    </nav>

    {{-- ─── Main ─────────────────────────────────────────────────────────── --}}
    <div class="flex-grow-1 d-flex flex-column">

        {{-- Toast --}}
        @if(session('meubleo_toast'))
            @php $t = session('meubleo_toast') @endphp
            <div class="alert alert-{{ $t['type'] }} alert-dismissible m-3 mb-0" role="alert">
                {{ $t['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')

    </div>
</div>

<script src="{{ asset('vendor/meubleo/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
