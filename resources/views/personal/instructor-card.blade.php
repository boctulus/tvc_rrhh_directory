<div class="relative flex flex-col p-6 text-gray-400 shadow-lg bg-white rounded-lg">
    <!-- Eye icon -->
    <a href="#" onclick="javascript:alert({{ $pro['id'] }})" class="absolute top-2 right-2 text-orange-500 hover:text-orange-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </a>
    
    <!-- Imagen -->       
    <div class="w-24 h-24 mx-auto overflow-hidden rounded-full cursor-pointer" 
        onclick="showModal({{ json_encode($instructor) }})">
        <img src="{{ $instructor['img_url'] ?: ($instructor['avatar_storage'] ? Storage::url($instructor['avatar_storage']) : 'javascript:void(0)') }}" 
            onerror="this.src=avatar_default"
            alt="{{ $instructor['name'] }}" 
            class="w-full h-full object-cover">
    </div>

    <!-- Contenido de texto -->
    <div class="flex-1 mt-4">
        <h2 class="text-2xl font-bold text-gray-900">{{ $instructor['name'] }}</h2>
        <p class="text-sm text-blue-900 font-semibold">{{ $instructor['position'] }}</p>
        <p class="text-sm text-gray-400 mt-1">{{ count($instructor['lines_families']) }} Lines/Products</p>
        <span class="inline-block bg-yellow-500 text-white text-sm font-semibold px-2 py-1 rounded mt-2">
            ⭐ {{ $pro['expertise'] }} Expertise
        </span>

        @if (!empty($pro['social_media']))
            <div class="flex space-x-2 mt-4">
                @if (!empty($pro['social_media']['facebook']))
                    <a href="{{ $pro['social_media']['facebook'] }}" class="w-8 h-8 bg-white border-2 border-gray-300 rounded-full flex items-center justify-center hover:bg-gray-200 transition-colors">
                        <i class="fab fa-facebook-f text-gray-500 hover:text-blue-900"></i>
                    </a>
                @endif
                <!-- Resto de iconos sociales -->
            </div>
        @endif
    </div>
</div>