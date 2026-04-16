<a href="{{ $attributes['href'] ?? '#' }}"
   class="{{ $attributes['class'] ?? 'btn btn-outline-secondary' }}"
   target="{{ $attributes['target'] ?? '_self' }}">
    @if(!empty($attributes['icon']))
        <i class="{{ $attributes['icon'] }}"></i>
    @endif
    {{ $attributes['name'] ?? 'Link' }}
</a>
