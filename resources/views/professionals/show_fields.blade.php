<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $professional->name }}</p>
</div>

<!-- Position Field -->
<div class="col-sm-12">
    {!! Form::label('position_id', 'Position:') !!}
    <p>{{ $professional->position->name }}</p>
</div>

<!-- Contact Field -->
<div class="col-sm-12">
    {!! Form::label('contact', 'Contact:') !!}
    <p>{{ $professional->contact }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $professional->email }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-12">
    {!! Form::label('phone', 'Phone:') !!}
    <p>{{ $professional->phone }}</p>
</div>

<!-- Phone2 Field -->
<div class="col-sm-12">
    {!! Form::label('phone2', 'Phone2:') !!}
    <p>{{ $professional->phone2 }}</p>
</div>

<!-- Img Url Field -->
<div class="col-sm-12">
    {!! Form::label('img_url', 'Img Url:') !!}
    <p>{{ $professional->img_url }}</p>
</div>

<div class="form-group col-sm-6">
    {!! Form::label('areas', 'Areas:') !!}
    {!! Form::select('areas[]', 
        \App\Models\Area::pluck('name', 'id'), 
        isset($professional) ? $professional->areas->pluck('id')->toArray() : [], 
        [
            'class' => 'form-control select2', 
            'multiple' => 'multiple',
            'placeholder' => 'Select Areas'
        ]
    ) !!}
</div>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Select Areas',
        allowClear: true
    });
});
</script>

<!-- Expertise Field -->
<div class="col-sm-12">
    {!! Form::label('expertise', 'Expertise Level:') !!}
    <p>
        @switch($professional->expertise)
            @case(1)
                1 - Basic ★
                @break
            @case(2)
                2 - Intermediate ★★
                @break
            @case(3)
                3 - Proficient ★★★
                @break
            @case(4)
                4 - Advanced ★★★★
                @break
            @case(5)
                5 - Expert ★★★★★
                @break
            @default
                Not Specified
        @endswitch
    </p>
</div>

<!-- Location (State) Field -->
<div class="col-sm-12">
    {!! Form::label('location_id', 'State:') !!}
    <p>{{ $professional->location->name }}</p>
</div>

<!-- Line Families Field -->
<div class="col-sm-12">
    {!! Form::label('line_families', 'Line Families:') !!}
    <p>
        @if($professional->professionalLineFamilies->count() > 0)
            {{ $professional->professionalLineFamilies->pluck('lineFamily.name')->implode(', ') }}
        @else
            No Line Families
        @endif
    </p>
</div>

<!-- Certifications Field -->
<div class="col-sm-12">
    {!! Form::label('certifications', 'Certifications:') !!}
    <p>
        @if($professional->professionalCertifications->count() > 0)
            {{ $professional->professionalCertifications->pluck('certification.name')->implode(', ') }}
        @else
            No Certifications
        @endif
    </p>
</div>
