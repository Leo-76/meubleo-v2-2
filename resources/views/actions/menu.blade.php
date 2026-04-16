<a href="{{ $attributes['href'] ?? '#' }}"
   class="meubleo-sidebar__link {{ request()->url() === ($attributes['href'] ?? '') ? 'active' : '' }}">
    @if(!empty($attributes['icon']))
        <i class="{{ $attributes['icon'] }} me-2"></i>
    @endif
    <span>{{ $attributes['name'] ?? '' }}</span>
    @if(!empty($attributes['badge']))
        <span class="badge bg-danger ms-auto">{{ $attributes['badge'] }}</span>
    @endif
</a>
