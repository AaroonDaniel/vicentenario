@extends('layouts.principal')

@section('content')
<section class="content" style="padding: 15px;">
    <div class="container mx-auto px-4 py-6">

        <!-- Encabezado y Botón de Filtros -->
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-3xl font-bold">Calendario de Eventos del Bicentenario 🇧🇴</h1>
            <button id="openFilters" class="bg-teal-950 text-white font-bold px-4 py-2 rounded hover:bg-teal-700 transition">
                Filtros
            </button>
        </div>

        <!-- Navegador de Meses -->
        <div class="flex justify-center space-x-2 mb-6">
            @foreach(range(1,12) as $m)
                @php
                    $nombreMes = \Carbon\Carbon::createFromDate(null, $m, null)
                                ->locale('es')
                                ->isoFormat('MMMM');
                @endphp
                <a href="{{ route('agendaEventos', array_merge(request()->except('page'), ['mes' => $m])) }}"
                    class="px-4 py-2 rounded-full 
                        {{ $mes == $m ? 'bg-teal-950 text-white' : 'bg-gray-200' }}
                        hover:bg-teal-900 hover:bg-opacity-80
                        transition transform hover:scale-105 duration-300">
                    {{ ucfirst($nombreMes) }}
                </a>
            @endforeach
        </div>

        <!-- Grid de Tarjetas de Eventos -->
        

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($agendas as $agenda)
            <div class="bg-zinc-900 bg-opacity-10 shadow-md rounded-lg overflow-hidden border-2 border-teal-500 transform hover:scale-105 transition duration-300 hover:shadow-black hover:shadow-2xl">

                    <!-- Imagen con efecto hover -->
                    <div class="relative h-48 overflow-hidden">
                        <!-- Imagen de fondo -->
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 hover:scale-110"
                            style="background-image: url('{{ optional($agenda->evento)->imagen_ruta ? Storage::url($agenda->evento->imagen_ruta) : asset('images/default-event.jpg') }}')">
                        </div>

                        <!-- Capa negra semitransparente -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <h2 class="text-lg font-bold text-white text-center px-4">{{ $agenda->titulo }}</h2>
                        </div>
                    </div>

                    <!-- Cuerpo de la tarjeta -->
                    <div class="p-4">
                        <p class="text-sm text-black mb-2">{{ $agenda->descripcion ?? 'Sin descripción disponible' }}</p>
                        <p class="text-xs text-black mt-2">
                            <i class="bi bi-calendar2-date text-teal-700 mr-1"></i>
                            {{ \Carbon\Carbon::parse($agenda->fecha_inicio)->format('d M, H:i') }}
                        </p>

                        <p class="text-xs text-black mt-1">
                            <i class="bi bi-geo-alt text-teal-700 mr-1"></i>

                            {{ $agenda->ubicacion ?? 'Ubicación pendiente' }}
                        </p>



                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-700">
                    No hay eventos programados para este mes.
                </div>
            @endforelse
        </div>

    </div>

    <!-- Modal de Filtros -->
    <div id="filterModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg w-full max-w-lg overflow-y-auto max-h-[90vh]">
            <form method="GET" action="{{ route('agendaEventos') }}">
                <input type="hidden" name="mes" value="{{ $mes }}">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Filtrar Categorías</h2>
                    <button type="button" id="closeFilters" class="text-gray-500 text-2xl">&times;</button>
                </div>

                <div class="mb-4">
                    <a href="{{ route('agendaEventos', ['mes' => $mes]) }}" class="text-teal-500 underline">Restablecer filtros</a>
                </div>

                <div class="mb-6">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" id="selectAll" class="form-checkbox">
                        <span>Todos las categorías</span>
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="font-bold text-teal-900 mb-2">Cultura</h3>
                        <div class="flex flex-col space-y-2">
                            <label><input type="checkbox" name="tipos[]" value="Musica" class="category-checkbox"> Musica</label>
                            <label><input type="checkbox" name="tipos[]" value="Danza" class="category-checkbox"> Danza</label>
                            <label><input type="checkbox" name="tipos[]" value="Teatro" class="category-checkbox"> Teatro</label>
                            <label><input type="checkbox" name="tipos[]" value="Gastronomia" class="category-checkbox"> Gastronomía</label>
                            <label><input type="checkbox" name="tipos[]" value="Arte" class="category-checkbox"> Arte</label>
                        </div>
                    </div>

                    <div>
                        <h3 class="font-bold text-teal-900 mb-2">Historia</h3>
                        <div class="flex flex-col space-y-2">
                            <label><input type="checkbox" name="tipos[]" value="Batallas" class="category-checkbox"> Batallas</label>
                            <label><input type="checkbox" name="tipos[]" value="Personajes históricos" class="category-checkbox"> Personajes históricos</label>
                            <label><input type="checkbox" name="tipos[]" value="Movimientos" class="category-checkbox"> Movimientos</label>
                            <label><input type="checkbox" name="tipos[]" value="Fechas importantes" class="category-checkbox"> Fechas importantes</label>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <h3 class="font-bold text-teal-900 mb-2">Otros</h3>
                        <div class="flex flex-col space-y-2">
                            <label><input type="checkbox" name="tipos[]" value="Ferias" class="category-checkbox"> Ferias</label>
                            <label><input type="checkbox" name="tipos[]" value="Conferencias" class="category-checkbox"> Conferencias</label>
                            <label><input type="checkbox" name="tipos[]" value="Talleres" class="category-checkbox"> Talleres</label>
                            <label><input type="checkbox" name="tipos[]" value="Infantil" class="category-checkbox"> Infantil</label>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-teal-950 text-white py-2 rounded hover:bg-teal-700 transition">
                        Mostrar eventos
                    </button>
                </div>
            </form>
        </div>
    </div>

</section>

<!-- Script para Modal -->
<script>
    const openFilters = document.getElementById('openFilters');
    const closeFilters = document.getElementById('closeFilters');
    const filterModal = document.getElementById('filterModal');
    const selectAll = document.getElementById('selectAll');
    const categoryCheckboxes = document.querySelectorAll('.category-checkbox');

    openFilters.addEventListener('click', () => {
        filterModal.classList.remove('hidden');
    });

    closeFilters.addEventListener('click', () => {
        filterModal.classList.add('hidden');
    });

    selectAll.addEventListener('change', (e) => {
        categoryCheckboxes.forEach(cb => cb.checked = e.target.checked);
    });
</script>
@endsection
