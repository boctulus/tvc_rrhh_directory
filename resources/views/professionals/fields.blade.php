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
    {!! Form::text('contact', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
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
                <!-- Ajax Upload Section -->
                <div class="form-group col-sm-6">
                    <label>Subir imagen:</label>
                    <div class="input-group">
                        <input type="file" 
                               class="form-control" 
                               id="ajaxImageUpload" 
                               accept="image/*">
                        <button type="button" 
                                class="btn btn-primary" 
                                id="uploadBtn">
                            <i class="fas fa-upload"></i> Subir
                        </button>
                    </div>
                    <small class="text-muted">Formatos permitidos: JPEG, PNG, GIF, WEBP. Máx 5MB</small>
                    <div id="uploadStatus" class="mt-2"></div>
                </div>

                <!-- Image URL Field -->
                <div class="form-group col-sm-6">
                    {!! Form::label('img_url', 'O usar URL de imagen:') !!}
                    {!! Form::text('img_url', null, [
                        'class' => 'form-control',
                        'id' => 'imageUrl',
                        'placeholder' => 'https://example.com/image.jpg'
                    ]) !!}
                    @error('img_url')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Preview Sections -->
            <div class="row mt-3">
                <div class="col-sm-12">
                    <div id="ajaxPreviewContainer" style="display:none;">
                        <label>Previsualización:</label><br>
                        <img id="ajaxImagePreview" 
                             src="#" 
                             alt="Preview" 
                             class="img-fluid" 
                             style="max-height: 200px;">
                    </div>
                    
                    @if(isset($professional))
                        <div id="currentImageContainer">
                            <label>Imagen Actual:</label><br>
                            @if($professional->avatar_storage)
                                <img src="{{ Storage::url($professional->avatar_storage) }}" 
                                     alt="Current Image" 
                                     class="img-fluid" 
                                     style="max-height: 200px;">
                            @elseif($professional->img_url)
                                <img src="{{ $professional->img_url }}" 
                                     alt="Current Image" 
                                     class="img-fluid" 
                                     style="max-height: 200px;">
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Hidden field for final URL -->
            <input type="hidden" name="final_image_url" id="finalImageUrl">
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


@push('page_scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ajaxUpload = document.getElementById('ajaxImageUpload');
    const uploadBtn = document.getElementById('uploadBtn');
    const statusDiv = document.getElementById('uploadStatus');
    const previewImg = document.getElementById('ajaxImagePreview');
    const previewContainer = document.getElementById('ajaxPreviewContainer');
    const imageUrlInput = document.getElementById('imageUrl');
    const finalImageUrl = document.getElementById('finalImageUrl');

    function showPreview(url) {
        previewImg.src = url;
        previewContainer.style.display = 'block';
        if(document.getElementById('currentImageContainer')) {
            document.getElementById('currentImageContainer').style.display = 'none';
        }
    }

    ajaxUpload.addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            // Preview local
            const reader = new FileReader();
            reader.onload = function(e) {
                showPreview(e.target.result);
            }
            reader.readAsDataURL(file);
        }
    });

    uploadBtn.addEventListener('click', async function() {
        const file = ajaxUpload.files[0];
        if (!file) {
            statusDiv.innerHTML = '<div class="alert alert-warning">Selecciona una imagen primero</div>';
            return;
        }

        if (file.size > 5242880) {
            statusDiv.innerHTML = '<div class="alert alert-danger">El archivo excede 5MB</div>';
            return;
        }

        uploadBtn.disabled = true;
        statusDiv.innerHTML = '<div class="text-info">Subiendo...</div>';

        try {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', '{{ csrf_token() }}');

            const response = await fetch('{{ route("image.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            const data = await response.json();
            
            if (data.success) {
                imageUrlInput.value = data.url;
                finalImageUrl.value = data.url;
                showPreview(data.url);
                statusDiv.innerHTML = '<div class="alert alert-success">Imagen subida exitosamente</div>';
            } else {
                throw new Error(data.message);
            }
        } catch (error) {
            statusDiv.innerHTML = `<div class="alert alert-danger">Error: ${error.message}</div>`;
        } finally {
            uploadBtn.disabled = false;
        }
    });

    imageUrlInput.addEventListener('input', function() {
        if (this.value) {
            previewContainer.style.display = 'block';
            previewImg.src = this.value;
            finalImageUrl.value = this.value;
        }
    });
});
</script>
@endpush

@push('page_scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageUpload = document.getElementById('image');
        const imageUrl = document.getElementById('imageUrl');

        function toggleFields(uploadEnabled) {
            if (uploadEnabled) {
                imageUrl.value = '';
                imageUrl.disabled = true;
            } else {
                imageUrl.disabled = false;
            }
        }

        function toggleUpload(urlEnabled) {
            if (urlEnabled) {
                imageUpload.value = '';
                imageUpload.disabled = true;
            } else {
                imageUpload.disabled = false;
            }
        }

        imageUpload.addEventListener('change', function() {
            toggleFields(this.files.length > 0);
        });

        imageUrl.addEventListener('input', function() {
            toggleUpload(this.value.trim() !== '');
        });

        // Check initial state
        if (imageUrl.value.trim() !== '') {
            toggleUpload(true);
        }
    });
</script>
@endpush