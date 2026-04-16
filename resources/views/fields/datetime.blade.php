@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3">
    @if($title)<label for="{{ $id }}" class="form-label">{{ $title }}</label>@endif
    <input id="{{ $id }}" type="datetime-local"
        name="{{ $attributes['name'] }}"
        class="{{ $attributes['class'] ?? 'form-control' }}"
        value="{{ old($attributes['name'], $value ? \Carbon\Carbon::parse($value)->format('Y-m-d\TH:i') : '') }}"
        @if(!empty($attributes['required'])) required @endif
        @if(!empty($attributes['disabled'])) disabled @endif
        @if(!empty($attributes['min'])) min="{{ $attributes['min'] }}" @endif
        @if(!empty($attributes['max'])) max="{{ $attributes['max'] }}" @endif>
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
