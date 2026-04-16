@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3">
    @if($title)<label for="{{ $id }}" class="form-label">{{ $title }}</label>@endif
    @if($value)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $value) }}" alt="Current image"
                 style="max-height:120px;border-radius:6px;border:1px solid #dee2e6">
        </div>
    @endif
    <input id="{{ $id }}" type="file" name="{{ $attributes['name'] }}"
        class="form-control" accept="{{ $attributes['accept'] ?? 'image/*' }}"
        @if(!empty($attributes['required']) && !$value) required @endif>
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
