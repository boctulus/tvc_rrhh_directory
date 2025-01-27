<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="professional-areas-table">
            <thead>
            <tr>
                <th>Professional Id</th>
                <th>Area Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($professionalAreas as $professionalArea)
                <tr>
                    <td>{{ $professionalArea->professional_id }}</td>
                    <td>{{ $professionalArea->area_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['professionalAreas.destroy', $professionalArea->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('professionalAreas.show', [$professionalArea->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('professionalAreas.edit', [$professionalArea->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $professionalAreas])
        </div>
    </div>
</div>
