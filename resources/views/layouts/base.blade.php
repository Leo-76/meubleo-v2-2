@extends('meubleo::layouts.app')

@section('title', $screen->name() . ' — ' . config('meubleo.shop_name', 'Meubleo'))

@section('content')
<div class="meubleo-screen">

    {{-- ─── Header ───────────────────────────────────────────────────────── --}}
    <div class="meubleo-screen__header">
        <div>
            <h1 class="meubleo-screen__title">{{ $screen->name() }}</h1>
            @if($screen->description())
                <p class="meubleo-screen__description">{{ $screen->description() }}</p>
            @endif
        </div>

        <div class="meubleo-screen__actions">
            @foreach($screen->commandBar() as $action)
                @if($action->isSee())
                    {!! $action->build() !!}
                @endif
            @endforeach
        </div>
    </div>

    {{-- ─── Body ─────────────────────────────────────────────────────────── --}}
    <div class="meubleo-screen__body">
        @foreach($layouts as $layout)
            @if(is_string($layout))
                @include($layout, ['repository' => $repository])
            @else
                {!! (new $layout)->build($repository) !!}
            @endif
        @endforeach
    </div>

</div>
@endsection
