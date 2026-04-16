@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3">
    @if($title)<label for="{{ $id }}" class="form-label">{{ $title }}</label>@endif
    <select id="{{ $id }}" name="{{ $attributes['name'] }}" class="{{ $attributes['class'] ?? 'form-select' }}"
        @if(!empty($attributes['required'])) required @endif
        @if(!empty($attributes['disabled'])) disabled @endif
        @if(!empty($attributes['multiple'])) multiple @endif>
        @foreach($field->get('options', []) as $optVal => $optLabel)
            <option value="{{ $optVal }}" {{ (string)old($attributes['name'], $value) === (string)$optVal ? 'selected' : '' }}>
                {{ $optLabel }}
            </option>
        @endforeach
    </select>
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
