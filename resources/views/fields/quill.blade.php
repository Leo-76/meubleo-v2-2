@php $id = 'field-' . $attributes['name'] @endphp
<div class="mb-3">
    @if($title)<label class="form-label">{{ $title }}</label>@endif
    <div id="quill-{{ $id }}" style="min-height:200px;border:1px solid #dee2e6;border-radius:6px">
        {!! old($attributes['name'], $value) !!}
    </div>
    <input type="hidden" name="{{ $attributes['name'] }}" id="{{ $id }}-input"
           value="{{ old($attributes['name'], $value) }}">
    @if($help)<div class="form-text">{{ $help }}</div>@endif
</div>
@push('scripts')
<script>
(function(){
    var quill = new Quill('#quill-{{ $id }}', { theme: 'snow' });
    quill.on('text-change', function() {
        document.getElementById('{{ $id }}-input').value = quill.root.innerHTML;
    });
})();
</script>
@endpush
