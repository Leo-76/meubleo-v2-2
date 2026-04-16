@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3">
    @if($title)
        <label for="{{ $id }}" class="form-label">{{ $title }}</label>
    @endif
    <textarea id="{{ $id }}"
        @foreach($attributes as $key => $val)
            @if(!is_bool($val)) {{ $key }}="{{ $val }}"
            @elseif($val) {{ $key }}
            @endif
        @endforeach>{{ old($attributes['name'], $value) }}</textarea>
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
