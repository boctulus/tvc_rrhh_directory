<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="positions-table">
            <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($positions as $position)
                <tr>
                    <td>{{ $position->name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['positions.destroy', $position->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('positions.show', [$position->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('positions.edit', [$position->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $positions])
        </div>
    </div>
</div>
