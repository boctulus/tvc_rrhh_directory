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

<!-- Areas Field -->
<div class="form-group col-sm-6">
    {!! Form::label('areas', 'Areas:') !!}
    {!! Form::select('areas[]', 
        $areas ?? \App\Models\Area::pluck('name', 'id'), 
        isset($professional) ? $professional->areas->pluck('id')->toArray() : [], 
        [
            'class' => 'form-control select2', 
            'multiple' => 'multiple',
            'placeholder' => 'Select Areas'
        ]
    ) !!}
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

<!-- Image Upload Section -->
<div class="form-group col-sm-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Professional Image</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- File Upload Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('img_file', 'Upload Image:') !!}
                    {!! Form::file('img_file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
                </div>

                <!-- Image URL Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('img_url', 'Or Enter Image URL:') !!}
                    {!! Form::text('img_url', null, ['class' => 'form-control', 'placeholder' => 'https://example.com/image.jpg']) !!}
                </div>
            </div>
            
            <!-- Preview Image (if exists) -->
            @if(isset($professional) && $professional->img_url)
            <div class="row mt-3">
                <div class="col-sm-12">
                    <img src="{{ $professional->img_url }}" alt="Professional Image" class="img-fluid" style="max-height: 200px;">
                </div>
            </div>
            @endif
        </div>
    </div>
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
    {!! Form::label('lines_families', 'Line Families:') !!}
    <div id="line-families-container">
        <!-- Los elementos dinámicos se agregarán aquí -->
    </div>
    <button type="button" class="btn btn-primary btn-sm mt-2" id="add-line-family">
        <i class="fas fa-plus"></i> Add Line Family
    </button>
</div>

<!-- Template para nuevas líneas (oculto) -->
<template id="line-family-template">
    <div class="line-family-row d-flex align-items-center mb-2">
        <div class="col-sm-6 pl-0">
            <select name="lines_families[@index][line_family_id]" class="form-control">
                <option value="">Select Line Family</option>
                @foreach(\App\Models\LinesFamily::pluck('name', 'id') as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
            <select name="lines_families[@index][expertise_level]" class="form-control">
                <option value="">Select Level</option>
                <option value="1">1 - Basic ★</option>
                <option value="2">2 - Intermediate ★★</option>
                <option value="3">3 - Proficient ★★★</option>
                <option value="4">4 - Advanced ★★★★</option>
                <option value="5">5 - Expert ★★★★★</option>
            </select>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-danger btn-sm remove-line-family">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</template>

<!-- Certifications Field -->
<div class="form-group col-sm-12">
    {!! Form::label('certifications', 'Certifications:') !!}
    {!! Form::select('certifications[]', 
        \App\Models\Certification::pluck('name', 'id'), 
        isset($professional) ? $professional->professionalCertifications->pluck('certification_id')->toArray() : null, 
        ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
</div>

<!-- Locations Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Location:') !!}
    {!! Form::select('location_id', \App\Models\Location::pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Location', 'required']) !!}
</div>

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
    // Custom file input label
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endpush

@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let lineFamilyIndex = 0;
        const container = document.getElementById('line-families-container');
        const template = document.getElementById('line-family-template');
        const addButton = document.getElementById('add-line-family');

        function addLineFamilyRow(lineFamily = null, expertiseLevel = null) {
            const content = template.innerHTML.replace(/@index/g, lineFamilyIndex);
            const div = document.createElement('div');
            div.innerHTML = content;
            const newRow = div.firstElementChild;
            
            if (lineFamily) {
                newRow.querySelector('select[name$="[line_family_id]"]').value = lineFamily;
                newRow.querySelector('select[name$="[expertise_level]"]').value = expertiseLevel;
            }

            container.appendChild(newRow);
            lineFamilyIndex++;
        }

        addButton.addEventListener('click', () => addLineFamilyRow());

        container.addEventListener('click', (e) => {
            if (e.target.closest('.remove-line-family')) {
                e.target.closest('.line-family-row').remove();
            }
        });

        // Cargar datos existentes si estamos en modo edición
        @if(isset($professional))
            @foreach($professional->professionalLineFamilies as $plf)
                addLineFamilyRow('{{ $plf->line_family_id }}', '{{ $plf->expertise_level }}');
            @endforeach
        @endif

        // Si no hay líneas existentes, agregar una vacía
        if (container.children.length === 0) {
            addLineFamilyRow();
        }
    });
</script>
@endpush