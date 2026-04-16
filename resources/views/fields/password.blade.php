@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3">
    @if($title)<label for="{{ $id }}" class="form-label">{{ $title }}</label>@endif
    <input id="{{ $id }}" type="password" name="{{ $attributes['name'] }}"
        class="{{ $attributes['class'] ?? 'form-control' }}"
        @if(!empty($attributes['placeholder'])) placeholder="{{ $attributes['placeholder'] }}" @endif
        @if(!empty($attributes['required'])) required @endif
        @if(!empty($attributes['autocomplete'])) autocomplete="{{ $attributes['autocomplete'] }}" @endif>
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
