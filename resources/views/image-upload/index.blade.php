@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Upload de Imagen</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="image" class="form-label">Seleccionar Imagen</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <button id="uploadBtn" class="btn btn-primary" type="button">Upload</button>
                        </div>
                        <small class="text-muted">Formatos permitidos: JPEG, PNG, GIF, WEBP. Máximo 5MB</small>
                    </div>
                    
                    <div id="debugInfo" class="alert alert-info mt-2">
                        <pre id="debugText"></pre>
                    </div>

                    <div class="mt-3">
                        <h5>Vista Previa:</h5>
                        <div class="preview-container border rounded p-2" style="max-width: 200px; min-height: 200px; display: flex; align-items: center; justify-content: center;">
                            <img id="imagePreview" src="" alt="Preview" style="max-width: 100%; max-height: 200px; display: none;">
                            <span id="noImageText">No hay imagen seleccionada</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Error -->
<div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Éxito -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Éxito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="successMessage"></p>
            </div>
        </div>
    </div>
</div>


<script>

// Configurar toastr primero
document.addEventListener("DOMContentLoaded", (event) => {
    // console.log('Script iniciando');

    function debug(message, data = null) {
        console.log(message, data);
        const debugText = document.getElementById('debugText');
        if (debugText) {
            debugText.textContent += message + (data ? ': ' + JSON.stringify(data, null, 2) : '') + '\n';
        }
    }

    document.getElementById('image')?.addEventListener('change', function(e) {
        debug('Archivo seleccionado');
        const file = this.files[0];
        if (file) {
            if (file.size > 5242880) {
                toastr.error('La imagen excede el tamaño máximo permitido de 5MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = document.getElementById('imagePreview');
                const noImageText = document.getElementById('noImageText');
                if (imagePreview && noImageText) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    noImageText.style.display = 'none';
                }
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('uploadBtn')?.addEventListener('click', async function() {
        debug('Click en Upload')

        const imageInput = document.getElementById('image');
        const uploadBtn = this;

        if (!imageInput?.files[0]) {
            toastr.warning('Por favor seleccione una imagen');
            return;
        }

        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Subiendo...';

        try {
            const formData = new FormData();
            formData.append('image', imageInput.files[0]);
            formData.append('_token', '{{ csrf_token() }}');

            debug('Enviando request');

            const response = await fetch('{{ route("image.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            debug('Response recibida', response.status);

            const data = await response.json();
            debug('Data:', data);

            if (data.success) {
                const imagePreview = document.getElementById('imagePreview');
                const noImageText = document.getElementById('noImageText');
                if (imagePreview && noImageText) {
                    imagePreview.src = data.url;
                    imagePreview.style.display = 'block';
                    noImageText.style.display = 'none';
                }
                toastr.success('Imagen subida exitosamente');
            } else {
                throw new Error(data.message || 'Error en la subida');
            }
        } catch (error) {
            debug('Error:', error.message);
            toastr.error(error.message);
        } finally {
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = 'Upload';
        }
    });

    function showError(message) {
        const errorMessage = document.getElementById('errorMessage');
        if (errorMessage) {
            errorMessage.textContent = message;
            const modal = new bootstrap.Modal(document.getElementById('errorModal'));
            modal.show();
        }
    }

    function showSuccess(message) {
        const successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.textContent = message;
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();
        }
    }

    debug('Script cargado');
});

</script>
@endsection


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
