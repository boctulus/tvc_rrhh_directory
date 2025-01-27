<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="professional-line-families-table">
            <thead>
            <tr>
                <th>Professional Id</th>
                <th>Line Family Id</th>
                <th>Expertise Level</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($professionalLineFamilies as $professionalLineFamily)
                <tr>
                    <td>{{ $professionalLineFamily->professional_id }}</td>
                    <td>{{ $professionalLineFamily->line_family_id }}</td>
                    <td>{{ $professionalLineFamily->expertise_level }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['professionalLineFamilies.destroy', $professionalLineFamily->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('professionalLineFamilies.show', [$professionalLineFamily->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('professionalLineFamilies.edit', [$professionalLineFamily->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $professionalLineFamilies])
        </div>
    </div>
</div>
