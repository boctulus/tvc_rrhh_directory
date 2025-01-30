<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio de Servicios</title>
    <script src="<?= asset('third_party/tailwind/3.4/tailwind-3.4.16.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="flex flex-col min-h-screen bg-white">
    @include('layouts.partials.header')

    <!-- Contenido principal -->
    <main class="container mx-auto px-4 py-6 flex-grow">        
        @yield('content')
    </main>
    
    @include('layouts.partials.footer')

    <!-- Script para el menú responsive -->
    <script>
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        
        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Cerrar el menú cuando se hace clic fuera de él
        document.addEventListener('click', (event) => {
            if (!menuToggle.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>