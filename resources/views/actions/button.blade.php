<button type="submit"
    class="{{ $attributes['class'] ?? 'btn btn-primary' }}"
    form="meubleo-screen-form"
    formaction="{{ url()->current() }}/{{ $attributes['method'] ?? 'save' }}"
    @if(!empty($attributes['confirm']))
        onclick="return confirm('{{ $attributes['confirm'] }}')"
    @endif>
    @if(!empty($attributes['icon']))
        <i class="{{ $attributes['icon'] }}"></i>
    @endif
    {{ $attributes['name'] ?? 'Submit' }}
</button>
