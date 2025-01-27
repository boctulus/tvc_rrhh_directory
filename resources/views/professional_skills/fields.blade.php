<!-- Professional Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('professional_id', 'Professional Id:') !!}
    {!! Form::number('professional_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Skill Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('skill_id', 'Skill Id:') !!}
    {!! Form::number('skill_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Expertise Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expertise_level', 'Expertise Level:') !!}
    {!! Form::number('expertise_level', null, ['class' => 'form-control']) !!}
</div>