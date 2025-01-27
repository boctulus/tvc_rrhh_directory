<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="professional-brands-table">
            <thead>
            <tr>
                <th>Professional Id</th>
                <th>Brand Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($professionalBrands as $professionalBrand)
                <tr>
                    <td>{{ $professionalBrand->professional_id }}</td>
                    <td>{{ $professionalBrand->brand_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['professional-brands.destroy', $professionalBrand->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('professional-brands.show', [$professionalBrand->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('professional-brands.edit', [$professionalBrand->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $professionalBrands])
        </div>
    </div>
</div>
