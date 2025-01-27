<!-- Navbar -->
<nav class="text-white shadow-lg sticky top-0 z-50" style="background-color: #00145c;">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">            
            <a href="/" class="text-xl font-bold"><img class="h-12 w-12 ml-5" src="{{ asset('images/logos/logotvc2020white-mini.png') }}"/></a>
            <div class="relative">
                <button id="menu-toggle" class="p-2 hover:bg-blue-700 rounded">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <!-- Menú desplegable -->
                <div id="menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 text-gray-700">
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Inicio</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Cursos</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Contactar</a>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Login</a>
                </div>
            </div>
        </div>
    </div>
</nav> 