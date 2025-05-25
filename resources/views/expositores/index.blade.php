@extends('layouts.principal')
@section('title', 'Vicentenario Bolivia')

@section('content')
    <section class="content">
        {{-- CARRUSEL DE EXPOSITORES --}}
        <!--<div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6 px-6 py-10">
            @foreach ($eventos as $evento)
                <div class="break-inside-avoid bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition">
                    <img src="{{ Storage::url($evento->imagen_ruta) }}" class="w-full object-cover h-48">
                    <div class="p-4">
                        <h3 class="font-bold text-lg">{{ $evento->nombre }}</h3>
                        <p class="text-sm text-gray-600">{{ $evento->descripcion }}</p>
                        <p class="mt-2 text-xs text-gray-400">
                            <i class="fas fa-calendar-alt"></i> {{ $evento->fecha->format('Y-m-d') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>-->

        <div class="relative border-l border-gray-200 mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-items-center">
            @foreach ($expositores as $expositor)
                <div onclick="verExpositorNuevo({{ $expositor->id_expositor }})"
                    class="w-72 h-[500px] rounded-xl overflow-hidden shadow-lg relative group cursor-pointer transform transition hover:scale-105 bg-white flex flex-col">

                    <!-- Imagen del expositor -->
                    <div class="w-full h-full overflow-hidden">
                        <img src="{{ $expositor->imagen_perfil ? Storage::url($expositor->imagen_perfil) : 'https://via.placeholder.com/350x500.png?text=Expositor' }}"
                            alt="{{ $expositor->nombre }}"
                            class="w-full h-full object-cover object-center">
                    </div>

                    <!-- Encabezado con especialidad y ubicación -->
                    <div
                        class="absolute top-0 left-0 w-full flex justify-between items-center bg-gradient-to-r from-teal-900 to-lime-200 text-white p-2 text-sm font-bold z-10">
                        <span>{{ $expositor->especialidad ?? 'Especialista' }}</span>
                        <span class="bg-teal-700 px-2 py-1 rounded text-xs">{{ $expositor->institucion ?? 'Institución' }}</span>
                    </div>

                    <!-- Contenido inferior -->
                    <div class="p-4 space-y-1 flex-1 flex flex-col justify-end">
                        <p class="text-indigo-600 font-medium text-sm">Perfil Profesional</p>
                        <p class="text-xs text-gray-600">Conferencista de
                            <span class="text-green-600 font-semibold">{{ $expositor->especialidad ?? 'N/A' }}</span>
                        </p>
                        <h3 class="text-lg font-bold text-black">{{ $expositor->nombre }}</h3>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- TABLA DE EXPOSITORES --}}
        <div>
            <!-- Vista de las tablas -->
            <div class="p-4 sm:p-6 max-w-full overflow-x-auto">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-2">
                    <h1 class="text-2xl font-bold text-gray-800">Listado de Expositores</h1>
                    <button onclick="abrirModal('modalNuevoExpositor')"
                        class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded w-full sm:w-auto">
                        + Nuevo
                    </button>
                </div>

                <div class="overflow-x-auto w-full">
                    <table id="funcionesTable"
                        class="min-w-[1000px] w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Foto de Perfil</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Especialidad</th>
                                <th class="px-4 py-3 max-w-[200px]">Institución</th>
                                <th class="px-4 py-3">Contacto</th>
                                <th class="px-4 py-3 max-w-[200px]">Tema</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expositores as $expositor)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $expositor->id_expositor }}</td>

                                    {{-- Foto de Perfil --}}
                                    <td class="px-4 py-2">
                                        @if ($expositor->imagen_perfil)
                                            <img src="{{ Storage::url($expositor->imagen_perfil) }}"
                                                alt="{{ $expositor->nombre }}" class="h-10 w-10 object-cover">
                                        @else
                                            <span class="text-gray-400 text-sm">Sin imagen</span>
                                        @endif
                                    </td>

                                    {{-- Nombre --}}
                                    <td class="px-4 py-2">{{ $expositor->nombre }}</td>

                                    {{-- Especialidad --}}
                                    <td class="px-4 py-2">{{ $expositor->especialidad }}</td>

                                    {{-- Institución --}}
                                    <td class="px-4 py-2 truncate max-w-[200px]">{{ $expositor->institucion }}</td>

                                    {{-- Contacto --}}
                                    <td class="px-4 py-2">{{ $expositor->contacto }}</td>

                                    {{-- Temas por evento --}}
                                    <td class="px-4 py-2 truncate max-w-[200px]">
                                        @if ($expositor->eventos->isNotEmpty())
                                            <ul class="list-disc pl-4 space-y-1">
                                                @foreach ($expositor->eventos as $evento)
                                                    <li>
                                                        <strong>{{ $evento->nombre }}</strong>: {{ $evento->pivot->tema }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-gray-400">Ninguno</span>
                                        @endif
                                    </td>


                                    {{-- Acciones --}}
                                    <td class="px-4 py-2 flex space-x-2">
                                        {{-- Ver --}}
                                        <button onclick="verExpositor({{ $expositor->id_expositor }})"
                                            class="text-blue-500 hover:text-blue-700" title="Ver expositor">
                                            <i class="fas fa-eye"></i>
                                        </button>


                                        <button onclick="cargarDatosExpositor({{ $expositor->id_expositor }})"
                                            class="text-yellow-500 hover:text-yellow-700" title="Editar expositor">
                                            <i class="fas fa-edit"></i>
                                        </button>




                                        {{-- Eliminar --}}
                                        <button
                                            onclick="confirmarEliminarExpositor({{ $expositor->id_expositor }}, '{{ addslashes($expositor->nombre) }}')"
                                            class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal crear -->
            <div id="modalNuevoExpositor"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden p-4">
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <button onclick="cerrarModal('modalNuevoExpositor')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-4">Registrar nuevo expositor</h2>

                    <form id="formularioExpositor" action="{{ route('expositores.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                            @error('nombre')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Especialidad</label>
                            <input type="text" name="especialidad" value="{{ old('especialidad') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                            @error('especialidad')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Institución</label>
                            <input type="text" name="institucion" value="{{ old('institucion') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                            @error('institucion')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Contacto</label>
                            <input type="text" name="contacto" value="{{ old('contacto') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                            @error('contacto')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="eventos-temas-container" class="mb-4">
                            <label class="block font-semibold mb-2">Eventos y Temas</label>

                            <div class="evento-tema flex gap-4 mb-2">
                                <select name="eventos[0][id_evento]"
                                    class="w-1/2 border border-gray-300 rounded px-3 py-2" required>
                                    <option value="">Seleccionar evento</option>
                                    @foreach ($eventos as $evento)
                                        <option value="{{ $evento->id_evento }}">{{ $evento->nombre }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="eventos[0][tema]"
                                    class="w-1/2 border border-gray-300 rounded px-3 py-2"
                                    placeholder="Tema del expositor en este evento" required>
                            </div>
                        </div>

                        <button type="button" onclick="agregarEventoTema()"
                            class="mb-4 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            + Añadir otro evento
                        </button>


                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Foto de Perfil</label>
                            <input type="file" name="imagen_perfil" accept="image/*"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                            @error('imagen_perfil')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                            <div id="preview" class="mt-2"></div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                            <button type="button" onclick="cerrarModal('modalNuevoExpositor')"
                                class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal EDITAR EXPOSITOR -->
            <div id="modalEditarExpositor"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden p-4">
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <button onclick="cerrarModal('modalEditarExpositor')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-4">Editar expositor</h2>

                    <form id="formularioEditarExpositor" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="edit_id">

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Nombre</label>
                            <input type="text" name="nombre" id="edit_nombre"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Especialidad</label>
                            <input type="text" name="especialidad" id="edit_especialidad"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Institución</label>
                            <input type="text" name="institucion" id="edit_institucion"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Contacto</label>
                            <input type="text" name="contacto" id="edit_contacto"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div id="edit-eventos-temas-container" class="mb-4">
                            <label class="block font-semibold mb-2">Eventos y Temas</label>
                            <!-- Aquí se inyectarán los eventos y temas con JS -->
                        </div>

                        <button type="button" onclick="agregarEventoTemaEdit()"
                            class="mb-4 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            + Añadir otro evento
                        </button>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Cambiar imagen</label>
                            <input type="file" name="imagen_perfil" id="imagen_perfil_edit" accept="image/*"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                            <div id="imagen_preview" class="mt-2 hidden"></div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                            <button type="button" onclick="cerrarModal('modalEditarExpositor')"
                                class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal VER EXPOSITOR -->
            <div id="modalVerExpositor"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden p-4">
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative space-y-4">
                    <button onclick="cerrarModal('modalVerExpositor')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-4">Ver expositor</h2>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Nombre</label>
                        <p id="ver_nombre" class="text-gray-800"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Especialidad</label>
                        <p id="ver_especialidad" class="text-gray-800"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Institución</label>
                        <p id="ver_institucion" class="text-gray-800"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Contacto</label>
                        <p id="ver_contacto" class="text-gray-800"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-2">Eventos y Temas</label>
                        <div id="ver-eventos-temas-container" class="space-y-2">
                            <!-- Aquí se mostrarán los eventos con temas -->
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Foto de Perfil</label>
                        <div id="ver_imagen_container" class="mt-2">
                            <!-- Imagen se inyectará aquí -->
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                        <button type="button" onclick="cerrarModal('modalVerExpositor')"
                            class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Eliminar Expositor -->
            <div id="eliminarExpositorModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 p-4">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-bold text-black-600">
                                <i class="fas fa-trash-alt"></i> Eliminar Expositor
                            </h2>
                            <button onclick="cerrarModalEliminarExpositor()"
                                class="text-gray-600 hover:text-black-600 text-lg">&times;</button>
                        </div>

                        <p class="text-gray-800 mb-4">
                            ¿Estás seguro que deseas eliminar al expositor
                            <span id="nombreExpositorEliminar" class="font-semibold text-black-600"></span>?
                        </p>

                        <form id="formEliminarExpositor" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                                <button type="button" onclick="cerrarModalEliminarExpositor()"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="bg-pink-600 hover:bg-pink-800 text-white px-4 py-2 rounded">
                                    Eliminar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para la vista de usuarios -->
            <!-- Nuevo Modal para ver expositor -->
            <div id="modalVerExpositorNuevo"
                class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden p-4">
                <div class="bg-white rounded-lg shadow-lg max-w-3xl w-full p-6 relative">
                    <button onclick="cerrarModal('modalVerExpositorNuevo')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800">&times;</button>

                    <div class="grid md:grid-cols-2 gap-4">
                        <!-- Imagen del expositor -->
                        <div id="nuevo_ver_imagen_container"
                            class="flex justify-center items-center bg-gray-100 rounded p-4">
                            <p class="text-gray-500">Cargando imagen...</p>
                        </div>

                        <!-- Información del expositor -->
                        <div class="space-y-2">
                            <h2 id="nuevo_ver_nombre" class="text-xl font-bold text-gray-800">Nombre del expositor</h2>
                            <p class="text-sm text-gray-600"><span
                                    class="font-semibold text-indigo-600">Especialidad:</span> <span
                                    id="nuevo_ver_especialidad">-</span></p>
                            <p class="text-sm text-gray-600"><span class="font-semibold text-pink-600">Institución:</span>
                                <span id="nuevo_ver_institucion">-</span>
                            </p>
                            <p class="text-sm text-gray-600"><span class="font-semibold text-teal-600">Contacto:</span>
                                <span id="nuevo_ver_contacto">-</span>
                            </p>
                        </div>
                    </div>

                    <!-- Eventos del expositor -->
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold mb-2 text-gray-700">Eventos relacionados:</h3>
                        <div id="nuevo-eventos-temas-container" class="space-y-2 max-h-40 overflow-auto"></div>
                    </div>
                </div>
            </div>











        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function cargarDatosExpositor(id) {
            fetch(`/expositores/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Suponiendo que tienes un modal con estos campos:
                    document.getElementById('edit_id').value = data.expositor.id;
                    document.getElementById('edit_nombre').value = data.expositor.nombre;
                    document.getElementById('edit_especialidad').value = data.expositor.especialidad;
                    document.getElementById('edit_institucion').value = data.expositor.institucion;
                    document.getElementById('edit_contacto').value = data.expositor.contacto;
                    document.getElementById('edit_tema').value = data.tema;

                    // Para mostrar la imagen actual en el modal
                    const imgPreview = document.getElementById('imagen_preview');
                    if (data.expositor.imagen_perfil) {
                        imgPreview.src = `/storage/${data.expositor.imagen_perfil}`;
                        imgPreview.classList.remove('hidden');
                    } else {
                        imgPreview.classList.add('hidden');
                    }
                });
        }
    </script>

    <script>
        // Función para abrir el modal
        function abrirModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        // Función para cerrar el modal
        function cerrarModal(id) {
            document.getElementById(id).classList.add('hidden');
            // Limpiar formulario
            document.getElementById('formularioExpositor').reset();
            document.getElementById('preview').innerHTML = '';
        }

        // Vista previa de la imagen
        document.getElementById('imagen_perfil').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'h-20 w-20 object-cover rounded-full';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        let contadorEventos = 1;

        function agregarEventoTema() {
            const container = document.getElementById('eventos-temas-container');
            const nuevoCampo = document.createElement('div');
            nuevoCampo.classList.add('evento-tema', 'flex', 'gap-4', 'mb-2');

            nuevoCampo.innerHTML = `
                <select name="eventos[${contadorEventos}][id_evento]" class="w-1/2 border border-gray-300 rounded px-3 py-2" required>
                    <option value="">Seleccionar evento</option>
                    @foreach ($eventos as $evento)
                        <option value="{{ $evento->id_evento }}">{{ $evento->nombre }}</option>
                    @endforeach
                </select>
                <input type="text" name="eventos[${contadorEventos}][tema]" class="w-1/2 border border-gray-300 rounded px-3 py-2"
                    placeholder="Tema del expositor en este evento" required>
            `;

            container.appendChild(nuevoCampo);
            contadorEventos++;
        }
    </script>

    <!-- editar -->
    <script>
        let eventosDisponibles = @json($eventos); // Este array se llena desde el controlador

        function cargarDatosExpositor(id) {
            fetch(`/expositores/${id}/edit`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('formularioEditarExpositor').action = `/expositores/${id}`;
                    document.getElementById('edit_id').value = id;
                    document.getElementById('edit_nombre').value = data.expositor.nombre;
                    document.getElementById('edit_especialidad').value = data.expositor.especialidad;
                    document.getElementById('edit_institucion').value = data.expositor.institucion;
                    document.getElementById('edit_contacto').value = data.expositor.contacto;

                    // Limpiar contenedor eventos
                    const container = document.getElementById('edit-eventos-temas-container');
                    container.innerHTML = '';

                    data.eventos.forEach((ev, index) => {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'evento-tema flex gap-4 mb-2';

                        const select = document.createElement('select');
                        select.name = `eventos[${index}][id_evento]`;
                        select.className = 'w-1/2 border border-gray-300 rounded px-3 py-2';
                        select.required = true;

                        const defaultOption = document.createElement('option');
                        defaultOption.value = '';
                        defaultOption.text = 'Seleccionar evento';
                        select.appendChild(defaultOption);

                        eventosDisponibles.forEach(e => {
                            const option = document.createElement('option');
                            option.value = e.id_evento;
                            option.text = e.nombre;
                            if (e.id_evento == ev.id_evento) option.selected = true;
                            select.appendChild(option);
                        });

                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = `eventos[${index}][tema]`;
                        input.value = ev.pivot?.tema || '';
                        input.placeholder = 'Tema del expositor en este evento';
                        input.required = true;
                        input.className = 'w-1/2 border border-gray-300 rounded px-3 py-2';


                        wrapper.appendChild(select);
                        wrapper.appendChild(input);
                        container.appendChild(wrapper);
                    });

                    const preview = document.getElementById('imagen_preview');
                    preview.innerHTML = '';
                    if (data.expositor.imagen_perfil) {
                        const img = document.createElement('img');
                        img.src = `/storage/${data.expositor.imagen_perfil}`;
                        img.className = 'h-20 w-20 object-cover rounded-full';
                        preview.appendChild(img);
                        preview.classList.remove('hidden');
                    } else {
                        preview.classList.add('hidden');
                    }

                    abrirModal('modalEditarExpositor');
                });
        }

        function agregarEventoTemaEdit() {
            const container = document.getElementById('edit-eventos-temas-container');
            const index = container.querySelectorAll('.evento-tema').length;

            const wrapper = document.createElement('div');
            wrapper.className = 'evento-tema flex gap-4 mb-2';

            const select = document.createElement('select');
            select.name = `eventos[${index}][id_evento]`;
            select.className = 'w-1/2 border border-gray-300 rounded px-3 py-2';
            select.required = true;

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.text = 'Seleccionar evento';
            select.appendChild(defaultOption);

            eventosDisponibles.forEach(e => {
                const option = document.createElement('option');
                option.value = e.id_evento;
                option.text = e.nombre;
                select.appendChild(option);
            });

            const input = document.createElement('input');
            input.type = 'text';
            input.name = `eventos[${index}][tema]`;
            input.placeholder = 'Tema del expositor en este evento';
            input.required = true;
            input.className = 'w-1/2 border border-gray-300 rounded px-3 py-2';

            wrapper.appendChild(select);
            wrapper.appendChild(input);
            container.appendChild(wrapper);
        }
    </script>
    <!-- ver expositor -->

    <script>
        function verExpositor(id) {
            fetch(`/expositores/${id}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('ver_nombre').textContent = data.expositor.nombre;
                    document.getElementById('ver_especialidad').textContent = data.expositor.especialidad;
                    document.getElementById('ver_institucion').textContent = data.expositor.institucion;
                    document.getElementById('ver_contacto').textContent = data.expositor.contacto;

                    // Imagen
                    const imgHtml = data.expositor.imagen_perfil ?
                        `<img src="/storage/${data.expositor.imagen_perfil}" alt="Imagen expositor" class="max-w-full h-auto rounded shadow">` :
                        `<p class="text-gray-500">Sin imagen</p>`;
                    document.getElementById('ver_imagen_container').innerHTML = imgHtml;

                    // Eventos y temas
                    const eventosContainer = document.getElementById('ver-eventos-temas-container');
                    eventosContainer.innerHTML = '';
                    data.eventos.forEach(et => {
                        const item = document.createElement('div');
                        item.className = 'bg-gray-100 p-2 rounded shadow';

                        const nombreEvento = et.nombre_evento || et.nombre || 'Evento sin nombre';
                        const tema = et.pivot?.tema || 'Tema no especificado';

                        item.innerHTML = `<strong>${nombreEvento}</strong>: ${tema}`;
                        eventosContainer.appendChild(item);
                    });



                    // Mostrar modal
                    document.getElementById('modalVerExpositor').classList.remove('hidden');
                })
                .catch(err => {
                    console.error('Error al cargar expositor:', err);
                    alert('No se pudo cargar la información del expositor.');
                });
        }

        function cerrarModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>

    <!-- Eliminar expositor -->
    <script>
        function confirmarEliminarExpositor(id, nombre) {
            $('#formEliminarExpositor').attr('action', `/expositores/${id}`);
            $('#nombreExpositorEliminar').text(nombre);
            $('#eliminarExpositorModal').removeClass('hidden');
        }

        function cerrarModalEliminarExpositor() {
            $('#eliminarExpositorModal').addClass('hidden');
            $('#formEliminarExpositor').attr('action', '');
            $('#nombreExpositorEliminar').text('');
        }

        $('#formEliminarExpositor').on('submit', function(e) {
            e.preventDefault();

            let actionUrl = $(this).attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    cerrarModalEliminarExpositor();
                    location.reload(); // Puedes eliminar visualmente la fila si deseas
                },
                error: function(xhr) {
                    alert('Error al eliminar el expositor.');
                }
            });
        });
    </script>

    <!-- Modal para ver usuarios-->
    <script>
        function verExpositorNuevo(id) {
            fetch(`/expositores/${id}`)
                .then(res => res.json())
                .then(data => {
                    const expositor = data.expositor;

                    document.getElementById('nuevo_ver_nombre').textContent = expositor.nombre;
                    document.getElementById('nuevo_ver_especialidad').textContent = expositor.especialidad ??
                        'No especificado';
                    document.getElementById('nuevo_ver_institucion').textContent = expositor.institucion ??
                        'No especificado';
                    document.getElementById('nuevo_ver_contacto').textContent = expositor.contacto ?? 'Sin contacto';

                    const imagenHtml = expositor.imagen_perfil ?
                        `<img src="/storage/${expositor.imagen_perfil}" alt="Imagen expositor" class="rounded shadow max-h-60">` :
                        `<p class="text-gray-500">Sin imagen</p>`;

                    document.getElementById('nuevo_ver_imagen_container').innerHTML = imagenHtml;

                    const eventosContainer = document.getElementById('nuevo-eventos-temas-container');
                    eventosContainer.innerHTML = '';
                    data.eventos.forEach(evt => {
                        const div = document.createElement('div');
                        div.className = 'bg-gray-100 p-2 rounded shadow-sm text-sm';
                        div.innerHTML = `<strong>${evt.nombre_evento}</strong>: ${evt.tema}`;
                        eventosContainer.appendChild(div);
                    });

                    // Mostrar modal
                    document.getElementById('modalVerExpositorNuevo').classList.remove('hidden');
                })
                .catch(err => {
                    console.error('Error al cargar expositor:', err);
                    alert('No se pudo cargar la información del expositor.');
                });
        }
    </script>
@endpush