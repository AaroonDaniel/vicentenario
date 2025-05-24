<footer class="bg-cover bg-center text-white" style="background-image: url('{{ asset('images/foot.png') }}');">

    <div class="bg-black/70 w-full h-full">
        <div class="max-w-7xl mx-auto px-6 py-10 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Columna izquierda -->
            <div class="items-center">
                <h2 class="text-2xl font-bold mb-3 items-center">Bicentenario de Bolivia 1825 – 2025</h2>
                <p class="text-sm text-gray-300 mb-4 items-center">
                    Celebramos 200 años de historia, libertad y diversidad. El Bicentenario impulsa el desarrollo, la inclusión y la memoria viva de nuestros pueblos.
                </p>
                <ul class="space-y-2 text-sm items-center">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt hover:text-yellow-400 transition-colors"></i>
                        Plaza Murillo, La Paz, Bolivia
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone hover:text-yellow-400 transition-colors"></i>
                        +591 70000000
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope hover:text-yellow-400 transition-colors"></i>
                        contacto@bicentenariobolivia.bo
                    </li>
                </ul>
            </div>

            <!-- Columna derecha -->
            <div class="flex flex-col items-start md:items-end space-y-3 items-center">
                <div class="space-y-1 text-bold ">
                    <a href="{{ 'agendaEventos' }}" class="text-gray-300 hover:underline hover:text-teal-400">Agenda de eventos</a>
                    <a href="{{ 'eventos' }}" class=" text-gray-300 hover:underline hover:text-teal-400">Eventos</a>
                    <a href="{{ 'historias' }}" class=" text-gray-300 hover:underline hover:text-teal-400">Historias</a>
                    <a href="{{ 'culturas' }}" class="text-gray-300 hover:underline hover:text-teal-400">Culturas</a>
                </div>
                <div class="flex gap-4 mt-4">
                    <a href="#" class="text-blue-500 hover:text-teal-400 transition-colors"><i class="fab fa-facebook-f "></i></a>
                    <a href="#" class="text-pink-500 hover:text-pink-400 transition-colors"><i class="fab fa-instagram "></i></a>
                    <a href="#" class="text-purple-500 hover:text-blue-400 transition-colors"><i class="fab fa-twitter "></i></a>
                    <a href="#" class="text-red-400 hover:text-amber-700 transition-colors"><i class="fab fa-youtube "></i></a>
                </div>
            </div>
        </div>

        <!-- Línea inferior -->
        <div class="bg-black/80 text-center py-3 text-xs text-gray-300">
            &copy; {{ date('Y') }} Gobierno del Estado Plurinacional de Bolivia — Comisión del Bicentenario. Todos los derechos reservados.
        </div>
    </div>


</footer>
