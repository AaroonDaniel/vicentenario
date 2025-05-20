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
                                    @if ($historia->imagen)
                                        <img src="{{ Storage::url($historia->imagen) }}"
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
                                        max-height: 40px;
                                        /* Altura máxima del texto */
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 2;
                                        /* Limita a 2 líneas */
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

            <!-- Modal lista -->
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
                                <th class="px-4 py-3">Imagen</th>
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
                                    <td class="px-4 py-2">{{ $historia->created_at->format('Y-m-d') }}</td>

                                    <td class="px-4 py-2">
                                        @if ($historia->imagen)
                                            <img src="{{ asset('storage/' . $historia->imagen) }}" alt="Imagen"
                                                class="w-16 h-16 object-cover rounded border">
                                        @else
                                            <span class="text-gray-500 italic">Sin imagen</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-2 flex space-x-2">
                                        
                                        {{-- Botón para ver --}}
                                        <button onclick="mostrarDetalles({{ $historia->id_historia }})"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- Editar --}}
                                        <button
                                            onclick="openEditModal({
                                                id: '{{ $historia->id_historia }}',
                                                titulo: '{{ addslashes($historia->titulo) }}',
                                                descripcion: '{{ addslashes($historia->descripcion) }}',
                                                fuentes: '{{ addslashes($historia->fuentes) }}',
                                                puntuacion: '{{ $historia->puntuacion }}',
                                                fecha: '{{ $historia->created_at }}',
                                                imagen: '{{ $historia->imagen }}' // <--- aquí pasas la imagen
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
            <div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh]">
                    <button onclick="closeEditModal()"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                    <h2 class="text-lg font-bold text-black-700 mb-4">
                        <i class="fas fa-user-edit mr-2"></i>Editar Historia
                    </h2>

                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="form-id">

                        <div class="mb-4">
                            <label class="block font-semibold">Título</label>
                            <input type="text" name="titulo" id="form-titulo"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Descripción</label>
                            <textarea name="descripcion" id="form-descripcion" class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Fuentes</label>
                            <input type="text" name="fuentes" id="form-fuentes"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Puntuación</label>
                            <input type="number" name="puntuacion" id="form-puntuacion"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Fecha</label>
                            <input type="text" name="fecha" id="form-fecha"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Imagen actual</label>
                            <img id="edit-imagen-preview" src="" alt="Imagen actual"
                                class="w-32 h-32 object-cover rounded border">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Nueva imagen (opcional)</label>
                            <input type="file" name="imagen" accept="image/*"
                                class="w-full bg-white border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeEditModal()"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cerrar</button>
                            <button type="submit"
                                class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Editar historia</button>
                        </div>
                    </form>
                </div>
            </div>




            <!-- Modal VER DETALLES -->
            <div id="verHistoriaModal"  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white w-full max-w-4xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                        <div class="flex justify-between items-center border-b pb-2 mb-2">
                            <h2 class="text-lg font-bold text-black-700 mb-4">
                                <i class="fas fa-info-circle"></i> Detalles de la historia
                            </h2>
                            <button onclick="cerrarModalVer()"
                                class="text-gray-600 hover:text-red-600 text-lg">&times;</button>
                        </div>

                        <div>
                            <div class="mb-2">
                                <strong>Título:</strong>
                                <div id="ver-titulo" class="text-gray-600"></div>
                            </div>
                            <div class="mb-2">
                                <strong>Descripción:</strong>
                                <div id="ver-descripcion" class="text-gray-600"></div>
                            </div>
                            <div class="mb-2">
                                <strong>Fuentes:</strong>
                                <div id="ver-fuentes" class="text-gray-600"></div>
                            </div>
                            <div class="mb-2">
                                <strong>Puntuación:</strong>
                                <div id="ver-puntuacion" class="text-gray-600"></div>
                            </div>
                            <div class="mb-2">
                                <strong>Fecha creación:</strong>
                                <div id="ver-fecha-creacion" class="text-gray-600"></div>
                            </div>
                            <div class="mb-2">
                                <strong>Fecha actualización:</strong>
                                <div id="ver-fecha-actualizacion" class="text-gray-600"></div>
                            </div>
                            <div class="mt-4">
                                <strong>Imagen:</strong>
                                <div>
                                    <img id="ver-imagen" src="" alt="Imagen de la historia"
                                        class="w-full max-h-64 object-contain mt-2 rounded border"
                                        onerror="this.src='/default.jpg'">
                                </div>
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

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Imagen</label>
                            <input type="file" name="imagen" accept="image/*"
                                class="w-full border border-gray-300 rounded px-3 py-2">
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
        function openEditModal(data) {
            document.getElementById('form-id').value = data.id;
            document.getElementById('form-titulo').value = data.titulo;
            document.getElementById('form-descripcion').value = data.descripcion;
            document.getElementById('form-fuentes').value = data.fuentes;
            document.getElementById('form-puntuacion').value = data.puntuacion;
            document.getElementById('form-fecha').value = data.fecha;

            // Mostrar imagen actual
            const imageUrl = `/storage/${data.imagen}`;
            document.getElementById('edit-imagen-preview').src = imageUrl;


            // Establecer acción del formulario
            const form = document.getElementById('editForm');
            form.action = `/historias/${data.id}`;

            // Mostrar modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>


    <!-- ver -->
    <script>
        function mostrarDetalles(id) {
            $.ajax({
                url: `/historias/${id}`,
                method: 'GET',
                success: function(data) {
                    // Rellenar campos
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

                    // Imagen con fallback
                    const imagenRuta = data.imagen ? `/storage/${data.imagen}` : '/default.jpg';
                    $('#ver-imagen').attr('src', imagenRuta);

                    // Mostrar modal
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
