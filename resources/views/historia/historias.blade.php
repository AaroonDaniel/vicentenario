@extends('layouts.principal')

@section('content')
    <section class="content">
        {{-- Carrusel de Historias --}}
        <section class="ultimas gray">
            <section class="inner">
                <h2 class="title_home">Historias</h2>
                <section class="scroll_notes">
                    <article class="flex gap-4 overflow-x-auto pb-4">
                        @foreach ($historias as $historia)
                            <a href="{{ route('historias.show', $historia->id_historia) }}"
                                class="especial min-w-[300px] bg-white shadow rounded overflow-hidden">
                                <figure>
                                    @if ($historia->imagen_ruta)
                                        <img src="{{ Storage::url($historia->imagen_ruta) }}"
                                            alt="Imagen de {{ $historia->titulo }}" class="w-full h-48 object-cover">
                                    @else
                                        <img src="https://via.placeholder.com/300x200?text=Sin+imagen" alt="Sin imagen"
                                            class="w-full h-48 object-cover">
                                    @endif
                                </figure>

                                <figcaption class="p-3 bg-white">
                                    {{-- TÍTULO GRANDE --}}
                                    <h3 class="text-xl font-bold text-gray-900 leading-tight">
                                        {{ $historia->titulo }}
                                    </h3>
                                
                                    {{-- DESCRIPCIÓN --}}
                                    <p class="mt-2 text-sm text-white description-text">
                                        {{ Str::limit($historia->descripcion, 160, '...') }}
                                    </p>
                                </figcaption>
                                
                                <style>
                                    .description-text {
                                        max-height: 40px; /* Altura máxima del texto */
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2; /* Limita a 2 líneas */
                                        -webkit-box-orient: vertical;
                                    }
                                </style>
                            </a>
                        @endforeach
                    </article>
                </section>
            </section>
        </section>

        <div x-data="modalEdit()">

            <!-- Modal Nuevo -->
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Listado de Historias</h1>
                    <button onclick="abrirModal('modalNuevo')"
                        class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">+ Nuevo</button>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto table-responsive">
                    <table id="funcionesTable"
                        class="min-w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Título</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Fuentes</th>
                                <th class="px-4 py-3">Puntuación</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historias as $historia)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $historia->id_historia }}</td>
                                    <td class="px-4 py-2">{{ $historia->titulo }}</td>
                                    <td class="px-4 py-2">{{ $historia->descripcion }}</td>
                                    <td class="px-4 py-2">{{ $historia->fuentes }}</td>
                                    <td class="px-4 py-2">{{ $historia->puntuacion }}</td>
                                    <td class="px-4 py-2">{{ $historia->created_at }}</td>

                                    <td class="px-4 py-2 flex space-x-2">
                                        {{-- Ver --}}

                                        <button onclick="mostrarDetalles({{ $historia->id_historia }})"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- Editar --}}
                                        <button
                                            @click="openEditModal({ 
                                            id: '{{ $historia->id_historia }}',
                                            titulo: '{{ $historia->titulo }}', 
                                            descripcion: '{{ $historia->descripcion }}', 
                                            fuentes: '{{ $historia->fuentes }}',
                                            puntuacion: '{{ $historia->puntuacion }}', 
                                            fecha: '{{ $historia->created_at }}' 
                                        })"
                                            class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Eliminar --}}
                                        <button
                                            onclick="confirmarEliminar({{ $historia->id_historia }}, '{{ $historia->titulo }}')"
                                            class="text-red-600 hover:text-red-800">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL EDITAR -->
            <div x-show="show" x-transition x-cloak
                class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
                    <button @click="close"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                    <h2 class="text-lg font-bold text-black-700 mb-4"><i class="fas fa-user-edit mr-2"></i>Editar Historia
                    </h2>

                    <form :action="'/historias/' + form.id" method="POST" @submit="show = false">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-semibold">Título</label>
                            <input type="text" name="titulo"
                                x-model="form.titulo"class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Descripción</label>
                            <textarea name="descripcion"
                                x-model="form.descripcion"class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Fuentes</label>
                            <input type="text" name="fuentes"
                                x-model="form.fuentes"class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Puntuación</label>
                            <input type="number" name="puntuacion"
                                x-model="form.puntuacion"class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Fecha</label>
                            <input type="text" name="fecha" x-model="form.fecha"
                                class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" @click="close"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cerrar</button>
                            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Editar
                                historia</button>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal VER DETALLES -->
            <div id="verHistoriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <div class="flex justify-between items-center border-b pb-2 mb-2">
                            <h2 class="text-lg font-bold text-black-700 mb-4"><i class="fas fa-info-circle"></i> Detalles
                                de la historia</h2>
                            <button onclick="cerrarModalVer()"
                                class="text-gray-600 hover:text-red-600 text-lg">&times;</button>
                        </div>
                        <div>
                            <div>
                                <strong>Título:</strong>
                                <div id="ver-titulo" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Descripción:</strong>
                                <div id="ver-descripcion" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Fuentes:</strong>
                                <div id="ver-fuentes" class="text-gray-600"></div>
                            </div>
                            <div class="col-span-2">
                                <strong>Puntuación:</strong>
                                <div id="ver-puntuacion" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Fecha creación:</strong>
                                <div id="ver-fecha-creacion" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Fecha actualización:</strong>
                                <div id="ver-fecha-actualizacion" class="text-gray-600"></div>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button onclick="cerrarModalVer()"
                                class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">
                                OK
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal de Confirmación Eliminar Cultura -->
            <div id="eliminarHistoriaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-bold text-black-600"><i class="fas fa-trash-alt"></i> Eliminar
                                Historia</h2>
                            <button onclick="cerrarModalEliminar()"
                                class="text-gray-600 hover:text-black-600 text-lg">&times;</button>
                        </div>

                        <p class="text-gray-800 mb-4">¿Estás seguro que deseas eliminar la historia <span
                                id="tituloCulturaEliminar" class="font-semibold text-black-600"></span>?</p>

                        <form id="formEliminarHistoria" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="cerrarModalEliminar()"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancelar</button>
                                <button type="submit"
                                    class="bg-pink-600 hover:bg-black-700 text-white px-4 py-2 rounded">Eliminar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal NUEVO -->
            <div id="modalNuevo"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <button onclick="cerrarModal('modalNuevo')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-4">Registrar Nueva Historia</h2>

                    <form action="{{ route('historias.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Titulo</label>
                            <input type="text" name="titulo" value="{{ old('titulo') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Descripcion</label>
                            <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Fuentes</label>
                            <input type="text" name="fuentes" value="{{ old('fuentes') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Puntuación</label>
                            <input type="text" name="puntuacion" value="{{ old('puntuacion') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="text-right">
                            <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

<!-- Scripts MODALS-->
@push('scripts')
    <!-- Nuevo (agregar)-->
    <script>
        function abrirModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cerrarModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
    <!-- editar-->
    <script>
        function modalEdit() {
            return {
                show: false,
                form: {
                    id: '',
                    titulo: '',
                    descripcion: '',
                    fuentes: '',
                    puntuacion: '',
                    fecha: '',
                },
                openEditModal(data) {
                    this.form = {
                        ...data
                    };
                    this.show = true;
                },
                close() {
                    this.show = false;
                }
            }
        }
    </script>

    <!-- ver-->
    <script>
        function mostrarDetalles(id) {
            $.ajax({
                url: `/historias/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#ver-titulo').text(data.titulo);
                    $('#ver-descripcion').text(data.descripcion);
                    $('#ver-fuentes').text(data.fuentes);
                    $('#ver-puntuacion').text(data.puntuacion);
                    $('#ver-fecha-creacion').text(new Date(data.created_at).toLocaleDateString('es-ES', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }));
                    $('#ver-fecha-actualizacion').text(new Date(data.updated_at).toLocaleDateString('es-ES', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    }));
                    $('#verHistoriaModal').removeClass('hidden');
                },
                error: function() {
                    alert('No se pudo cargar la información.');
                }
            });
        }

        function cerrarModalVer() {
            $('#verHistoriaModal').addClass('hidden');
        }
    </script>

    <!-- ELIMINAR-->
    <script>
        function confirmarEliminar(id, titulo) {
            $('#formEliminarHistoria').attr('action', `/historias/${id}`);
            $('#tituloHistoriaEliminar').text(titulo);
            $('#eliminarHistoriaModal').removeClass('hidden');
        }

        function cerrarModalEliminar() {
            $('#eliminarHistoriaModal').addClass('hidden');
            $('#formEliminarHistoria').attr('action', '');
            $('#tituloCulturaEliminar').text('');
        }

        // Opción AJAX (si no deseas recargar)
        $('#formEliminarHistoria').on('submit', function(e) {
            e.preventDefault();

            let actionUrl = $(this).attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    cerrarModalEliminar();
                    location.reload(); // O bien, puedes eliminar la fila con JS sin recargar
                },
                error: function(xhr) {
                    alert('Error al eliminar la cultura.');
                }
            });
        });
    </script>
    <!-- modal cerrar//abrir-->
    <script>
        // Abre modal
        function abrirModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden'); // ⬅️ Evita scroll en el fondo
        }

        // Cierra modal
        function cerrarModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden'); // ⬅️ Restaura scroll
        }
    </script>
@endpush
