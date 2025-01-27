<!-- Footer mejorado -->
<footer class="bg-gray-800 text-white mt-auto">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Columna 1 -->
            <div>
                <h3 class="text-lg font-semibold mb-4">TVCenLínea.com</h3>
                <p class="text-gray-400">Mayorista en Soluciones de Seguridad</p>
            </div>
            <!-- Columna 2 -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Inicio</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Catálogo</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Proyectos</a></li>
                </ul>
            </div>
            <!-- Columna 3 -->
            <div>
                <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><i class="fas fa-envelope mr-2"></i> ventas@tvc.mx</li>
                    <li><i class="fas fa-phone mr-2"></i> (55) 5999-0000</li>
                    <li class="flex space-x-4 mt-4">
                        <a href="https://www.facebook.com/TVCmex" target="_blank" class="hover:text-blue-400">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://es.linkedin.com/company/tvcenl%C3%ADnea.com" target="_blank" class="hover:text-blue-400">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://www.youtube.com/@tvcenlineamx" target="_blank" class="hover:text-red-400">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400">
            <p>&copy; 2000-{{ date('Y') }} TVCenLínea.com - Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

@if(request()->has('credits'))
<div id="dev-credits" class="bg-[#00145c] text-white text-center py-5">
    <strong>Web development</strong> by <b>Pablo Bozzolo</b> &lt; boctulus@gmail.com &gt;
</div>
@endif