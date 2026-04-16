@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3 {{ $horizontal ? 'row' : '' }}">
    @if($title)
        <label for="{{ $id }}" class="form-label {{ $horizontal ? 'col-sm-3 col-form-label' : '' }}">
            {{ $title }}
            @if(!empty($attributes['required'])) <span class="text-danger">*</span> @endif
        </label>
    @endif

    <div class="{{ $horizontal ? 'col-sm-9' : '' }}">
        <input id="{{ $id }}"
            @foreach($attributes as $key => $val)
                @if(!is_bool($val)) {{ $key }}="{{ $val }}"
                @elseif($val) {{ $key }}
                @endif
            @endforeach
            value="{{ old($attributes['name'], $value) }}">

        @if($help)
            <div class="form-text text-muted">{{ $help }}</div>
        @endif
    </div>
</div>
