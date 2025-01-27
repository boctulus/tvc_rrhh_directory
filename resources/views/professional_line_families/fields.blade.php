<!-- Professional Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('professional_id', 'Professional Id:') !!}
    {!! Form::number('professional_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Line Family Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('line_family_id', 'Line Family Id:') !!}
    {!! Form::number('line_family_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Expertise Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expertise_level', 'Expertise Level:') !!}
    {!! Form::number('expertise_level', null, ['class' => 'form-control']) !!}
</div>