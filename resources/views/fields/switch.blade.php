@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="{{ $id }}"
            name="{{ $attributes['name'] }}" value="1"
            {{ old($attributes['name'], $value) ? 'checked' : '' }}
            @if(!empty($attributes['disabled'])) disabled @endif>
        @if($title)
            <label class="form-check-label" for="{{ $id }}">{{ $title }}</label>
        @endif
    </div>
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
