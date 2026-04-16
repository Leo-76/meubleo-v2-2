<div class="card shadow-sm mb-4">
    <div class="card-body">
        @foreach($fields as $field)
            {!! $field->build($repository) !!}
        @endforeach
    </div>
</div>
