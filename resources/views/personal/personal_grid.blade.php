@extends('layouts.layout')

@section('content')
{{-- Incluir el archivo del Web Component --}}
@include('personal.card_v4_tailwind')

<script>
    const avatar_default = "{{ asset('images/default-avatar.jpg') }}";
</script>

{{-- Container para el modal --}}
<div id="modalContainer" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white p-4 rounded-lg max-w-4xl w-full max-h-90vh overflow-y-auto">
        <div class="flex justify-end">
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="modalContent" class="p-2"></div>
    </div>
</div>

<div class="container mx-auto px-4">
    {{-- Header y contenedor principal --}}
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">DIRECTORIO DE INGENIERÍA</h1>            
        </div>

        {{-- Buscador y filtros --}}
        <div class="mb-8">
            {{-- Buscador mejorado --}}
            <div class="relative mb-4">
                <input type="text"
                    class="w-full p-4 pl-6 pr-12 text-lg bg-white border-2 border-yellow-400 rounded-full shadow-lg focus:outline-none focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all"
                    placeholder="Buscar..." id="searchInput" onkeyup="handleSearch()">
                <button class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 p-2"
                    onclick="clearSearch()" id="clearButton" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            {{-- Grid de checkboxes para filtros --}}
            <div class="bg-white p-4 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-3">Filtrar por:</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400" value="brands"
                            checked>
                        <span>Marca</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400" value="name">
                        <span>Nombre</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400" value="position">
                        <span>Puesto</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400" value="location">
                        <span>Ubicación</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400"
                            value="certifications">
                        <span>Certificaciones</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400" value="expertise">
                        <span>Expertise</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400" value="contact">
                        <span>Correo</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="search-field form-checkbox text-yellow-400" value="phone">
                        <span>Teléfono</span>
                    </label>
                </div>
            </div>
        </div>


        {{-- Iteración por áreas --}}
        @foreach ($areas as $area)
            <div class="mb-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">
                    {{ $area }}
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-8">
                    @foreach ($personal as $pro)
                        @if(in_array($area, $pro['areas']))
                            <div class="engineer-card relative"
                                data-instructor="{{ json_encode($pro) }}">
                                {{-- Botón de vista en la esquina superior derecha --}}
                                <button onclick="showModal({{ json_encode($pro) }})"
                                    class="absolute top-2 right-2 z-10 text-blue-500 hover:text-blue-700 bg-white rounded-full p-1 shadow-md">
                                    <i class="fas fa-eye"></i>
                                </button>

                                @include('personal.instructor-card', ['instructor' => $pro])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    function filterByBrand(searchTerm) {
        searchTerm = searchTerm.toLowerCase();
        const cards = document.querySelectorAll('.engineer-card');
        const clearButton = document.getElementById('clearButton');
        clearButton.style.display = searchTerm ? 'block' : 'none';

        cards.forEach(card => {
            const brands = card.dataset.brands;
            if (brands.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function clearSearch() {
        const searchInput = document.getElementById('searchByBrand');
        searchInput.value = '';
        filterByBrand('');
    }

    function handleSearch() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.engineer-card');
    const clearButton = document.getElementById('clearButton');
    const selectedFields = Array.from(document.querySelectorAll('.search-field:checked')).map(cb => cb.value);

    clearButton.style.display = searchTerm ? 'block' : 'none';

    cards.forEach(card => {
        const instructorData = JSON.parse(card.dataset.instructor || '{}');
        let matches = false;

        // Buscar en todos los campos seleccionados
        for (const field of selectedFields) {
            let fieldValue = '';

            switch (field) {
                case 'brands':
                    // Convertir el array de brands a string para búsqueda
                    fieldValue = Array.isArray(instructorData.brands) 
                        ? instructorData.brands.join(' ').toLowerCase()
                        : String(instructorData.brands || '').toLowerCase();
                    break;
                case 'name':
                    fieldValue = String(instructorData.name || '').toLowerCase();
                    break;
                case 'position':
                    fieldValue = String(instructorData.position || '').toLowerCase();
                    break;
                case 'location':
                    fieldValue = String(instructorData.location || '').toLowerCase();
                    break;
                case 'certifications':
                    fieldValue = String(instructorData.certifications || '').toLowerCase();
                    break;
                case 'expertise':
                    fieldValue = String(instructorData.expertise || '').toLowerCase();
                    break;
                case 'contact':
                    fieldValue = String(instructorData.email || '').toLowerCase(); // Cambiado de contact a email
                    break;
                case 'phone':
                    fieldValue = String(instructorData.phone || '').toLowerCase();
                    break;
            }

            if (fieldValue.includes(searchTerm)) {
                matches = true;
                break;
            }
        }

        card.style.display = matches || !searchTerm ? 'block' : 'none';
    });
}

    function clearSearch() {
        document.getElementById('searchInput').value = '';
        handleSearch();
    }

    function showModal(instructorData) {
        console.log(instructorData); //
        
        // Convertir las marcas a array si es string
        const brands = typeof instructorData.brands === 'string'
            ? instructorData.brands.split(',')
            : instructorData.brands;

        // Ensure lines_families are correctly displayed
        const lineNames = instructorData.lines_families.map(lf => lf.name);

        const linesFamilies = instructorData.lines_families;

        // Crear el componente con los datos formateados
        const profileCard = `
            <profile-card
                image-url="${instructorData.img_url || avatar_default}"
                short-name="${instructorData.name.split(' ').slice(0, 2).join(' ')}"
                full-name="${instructorData.name}"
                phone="${instructorData.phone}"
                specialty="${instructorData.position}"
                position="${instructorData.position}"
                rating="${instructorData.expertise}.0"
                email="${instructorData.email}"
                country="México"
                province="${instructorData.location}"
                brands='${JSON.stringify(brands)}'
                certifications='${JSON.stringify(parseCertifications(instructorData.certifications))}'
                skills='${JSON.stringify({ lines_families: linesFamilies })}'>
            </profile-card>
        `;

        document.getElementById('modalContent').innerHTML = profileCard;
        document.getElementById('modalContainer').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalContainer').classList.add('hidden');
    }

    function parseCertifications(certString) {
        // Dividir el string de certificaciones por espacios y crear array
        return certString.split(' ').filter(cert => cert.length > 0);
    }
</script>
@endsection