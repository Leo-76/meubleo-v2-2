<div class="meubleo-table-wrap card shadow-sm mb-4">
    @if($title)
        <div class="card-header fw-semibold">{{ $title }}</div>
    @endif
    <div class="table-responsive">
        <table class="table mb-0 {{ $striped ? 'table-striped' : '' }} {{ $hoverable ? 'table-hover' : '' }} {{ $compact ? 'table-sm' : '' }}">
            <thead class="table-light">
                <tr>
                    @foreach($columns as $column)
                        <th class="{{ $column->getAlign() }}"
                            @if($column->getWidth()) style="width:{{ $column->getWidth() }}" @endif>
                            {{ $column->getTitle() }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($rows as $row)
                    <tr>
                        @foreach($columns as $column)
                            <td class="{{ $column->getAlign() }}">
                                {!! $column->getValue($row) !!}
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $columns->count() }}" class="text-center text-muted py-5">
                            No records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($rows, 'links'))
        <div class="card-footer">{{ $rows->links() }}</div>
    @endif
</div>
