<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Position Field -->
<div class="form-group col-sm-6">
    {!! Form::label('position_id', 'Position:') !!}
    {!! Form::select('position_id', \App\Models\Position::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Position', 'required']) !!}
</div>

<!-- Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact', 'Contact:') !!}
    {!! Form::text('contact', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Phone2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone2', 'Phone2:') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Img Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('img_url', 'Img Url:') !!}
    {!! Form::text('img_url', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Expertise Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expertise', 'Expertise Level:') !!}
    {!! Form::select('expertise', [
        1 => '1 - Basic ★',
        2 => '2 - Intermediate ★★',
        3 => '3 - Proficient ★★★',
        4 => '4 - Advanced ★★★★',
        5 => '5 - Expert ★★★★★'
    ], null, ['class' => 'form-control', 'placeholder' => 'Select Expertise Level']) !!}
</div>

<!-- Line Families Field -->
<div class="form-group col-sm-12">
    {!! Form::label('line_families', 'Line Families:') !!}
    {!! Form::select('line_families[]', 
        \App\Models\LinesFamily::pluck('name', 'id'), 
        isset($professional) ? $professional->professionalLineFamilies->pluck('line_family_id')->toArray() : null, 
        ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
</div>

<!-- Certifications Field -->
<div class="form-group col-sm-12">
    {!! Form::label('certifications', 'Certifications:') !!}
    {!! Form::select('certifications[]', 
        \App\Models\Certification::pluck('name', 'id'), 
        isset($professional) ? $professional->professionalCertifications->pluck('certification_id')->toArray() : null, 
        ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
</div>

<!-- States Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'State:') !!}
    {!! Form::select('location_id', \App\Models\State::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select State', 'required']) !!}
</div>

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endpush