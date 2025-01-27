<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="professionals-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position Id</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Phone2</th>
                <th>Img Url</th>
                <th>Expertise</th>
                <th>Location Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($professionals as $professional)
                <tr>
                    <td>{{ $professional->name }}</td>
                    <td>{{ $professional->position_id }}</td>
                    <td>{{ $professional->contact }}</td>
                    <td>{{ $professional->email }}</td>
                    <td>{{ $professional->phone }}</td>
                    <td>{{ $professional->phone2 }}</td>
                    <td>{{ $professional->img_url }}</td>
                    <td>{{ $professional->expertise }}</td>
                    <td>{{ $professional->location_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['professionals.destroy', $professional->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('professionals.show', [$professional->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('professionals.edit', [$professional->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $professionals])
        </div>
    </div>
</div>
