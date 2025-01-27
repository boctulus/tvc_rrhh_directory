<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="certifications-table">
            <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($certifications as $certification)
                <tr>
                    <td>{{ $certification->name }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['certifications.destroy', $certification->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('certifications.show', [$certification->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('certifications.edit', [$certification->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $certifications])
        </div>
    </div>
</div>
