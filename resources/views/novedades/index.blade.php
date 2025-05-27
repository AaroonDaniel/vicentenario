@extends('layouts.principal')
@section('title', 'Dashboard')



@section('content')

<section class="content">
    <div>
        <div class="p-4 sm:p-6 max-w-full overflow-x-auto">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-2">
                <h1 class="text-2xl font-bold text-gray-800">Lista de Novedades</h1>

                <button onclick="abrirModal('modalNuevo')" 
                    class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded w-full sm:w-auto">+ Nuevo
                </button>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto w-full">
                <table  class="min-w-[1000px] w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3 max-w-[200px]">TITULO</th>
                            <th class="px-4 py-3">DEPARTAMENTO</th>
                            <th class="px-4 py-3 max-w-[200px]">DESCRIPCION</th>
                            <th class="px-4 py-3 ">IMAGEN</th>
                            <th class="px-4 py-3">FECHA</th>
                            <th class="px-4 py-3 ">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($novedades as $novedad)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $novedad->id }}</td>
                                <td class="px-4 py-2  truncate max-w-[200px]">{{ $novedad->titulo }}</td>
                                <td class="px-4 py-2">{{ $novedad->departamento }}</td>
                                <td class="px-4 py-2  truncate max-w-[200px]">{{ $novedad->descripcion }}</td>
                                <td class="px-4 py-2 max-w-[80px]">
                                    @if ($novedad->imagen)
                                        <div class="w-[60px] h-[60px] mx-auto overflow-hidden rounded border">
                                            <img src="{{ asset('storage/' . $novedad->imagen) }}"
                                                alt="Imagen"
                                                class="w-[60px] h-[60px] object-cover block" />
                                        </div>
                                    @else
                                        <span class="text-gray-500 italic text-xs block text-center">Sin imagen</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">{{ $novedad->created_at->format('Y-m-d') }}</td>


                                <td class="px-4 py-2 flex space-x-2">
                                        <button onclick="mostrarDetalles({{ $novedad->id }})"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <button
                                            onclick="openEditModal({
                                                id: '{{ $novedad->id }}',
                                                titulo: '{{ addslashes($novedad->titulo) }}',
                                                descripcion: '{{ addslashes($novedad->descripcion) }}',
                                                imagen: '{{ $novedad->imagen }}',
                                                fecha: '{{ $novedad->created_at }}',
                                            })"
                                            class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button
                                            onclick="confirmarEliminar({{ $novedad->id }}, '{{ addslashes($novedad->titulo) }}')"
                                            class="text-red-600 hover:text-red-800">
                                            <i class="fa fa-trash"></i>
                                        </button>


                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay novedades registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $novedades->links() }}
                </div>
            </div>
        </div>

                <!-- MODAL EDITAR -->
        <div id="editModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white w-full sm:max-w-lg p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh] space-y-4">
                <button onclick="closeEditModal()"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                <h2 class="text-lg font-bold text-black-700 mb-4">
                    <i class="fas fa-user-edit mr-2"></i>Editar Novedad
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
                        <label class="block font-semibold">Departamento</label>
                        <input type="text" name="departamento" id="form-departamento"
                            class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold">Descripción</label>
                        <textarea name="descripcion" id="form-descripcion" class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2"></textarea>
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

                    <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                        <button type="button" onclick="closeEditModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cerrar</button>
                        <button type="submit"
                            class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Editar novedad</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal VER DETALLES -->
        <div id="verNovedadModal"  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden p-4">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white w-full max-w-4xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative space-y-4">
                    <div class="flex justify-between items-center border-b pb-2 mb-2">
                        <h2 class="text-lg font-bold text-black-700 mb-4">
                            <i class="fas fa-info-circle"></i> Detalles de la novedad
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
                            <strong>Departamento:</strong>
                            <div id="ver-departamento" class="text-gray-600"></div>
                        </div>
                        <div class="mb-2">
                            <strong>Descripción:</strong>
                            <div id="ver-descripcion" class="text-gray-600"></div>
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
                                <img id="ver-imagen" src="" alt="Imagen de la novedad"
                                    class="w-full max-h-64 object-contain mt-2 rounded border"
                                    onerror="this.src='/default.jpg'">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                        <button onclick="cerrarModalVer()"
                            class="bg-pink-600 hover:bg-pink-800 text-white px-4 py-2 rounded">
                            OK
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmación Eliminar Cultura -->
        <div id="eliminarNovedadModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50 p-4">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                    <div class="flex justify-between items-center border-b pb-2 mb-4">
                        <h2 class="text-lg font-bold text-black-600"><i class="fas fa-trash-alt"></i> Eliminar
                            Novedad</h2>
                        <button onclick="cerrarModalEliminar()"
                            class="text-gray-600 hover:text-black-600 text-lg">&times;</button>
                    </div>

                    <p class="text-gray-800 mb-4">¿Estás seguro que deseas eliminar la novedad <span
                            id="tituloNovedadEliminar" class="font-semibold text-black-600"></span>?</p>

                    <form id="formEliminarNovedad" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                            <button type="button" onclick="cerrarModalEliminar()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancelar</button>
                            <button type="submit"
                                class="bg-pink-600 hover:bg-pink-800 text-white px-4 py-2 rounded">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal NUEVO -->
        <div id="modalNuevo"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden p-4">
            <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                <button onclick="cerrarModal('modalNuevo')"
                    class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                <h2 class="text-2xl font-bold mb-4">Registrar Novedad</h2>

                <form action="{{ route('novedades.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Titulo</label>
                        <input type="text" name="titulo" value="{{ old('titulo') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Departamento</label>
                        <input type="text" name="departamento" value="{{ old('departamento') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Descripcion</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Imagen</label>
                        <input type="file" name="imagen" accept="image/*"
                            class="w-full border border-gray-300 rounded px-3 py-2">
                    </div>


                    <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                        <button type="submit"
                            class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-800">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection


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
            document.getElementById('form-departamento').value = data.departamento;
            document.getElementById('form-descripcion').value = data.descripcion;
            document.getElementById('form-fecha').value = data.fecha;

            // Mostrar imagen actual
            const imageUrl = `/storage/${data.imagen}`;
            document.getElementById('edit-imagen-preview').src = imageUrl;


            // Establecer acción del formulario
            const form = document.getElementById('editForm');
            form.action = `/novedades/${data.id}`;

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
                url: `/novedades/${id}`,
                method: 'GET',
                success: function(data) {
                    // Rellenar campos
                    $('#ver-titulo').text(data.titulo);
                    $('#ver-departamento').text(data.departamento);
                    $('#ver-descripcion').text(data.descripcion);

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
                    $('#verNovedadModal').removeClass('hidden');
                },
                error: function() {
                    alert('No se pudo cargar la información.');
                }
            });
        }

        function cerrarModalVer() {
            $('#verNovedadModal').addClass('hidden');
        }
    </script>

    <!-- ELIMINAR-->
    <script>
        function confirmarEliminar(id, titulo) {
            $('#formEliminarNovedad').attr('action', `/novedades/${id}`);
            $('#tituloNovedadEliminar').text(titulo);
            $('#eliminarNovedadModal').removeClass('hidden');
        }

        function cerrarModalEliminar() {
            $('#eliminarNovedadModal').addClass('hidden');
            $('#formEliminarNovedad').attr('action', '');
            $('#tituloNovedadEliminar').text('');
        }

        // Opción AJAX (si no deseas recargar)
        $('#formEliminarNovedad').on('submit', function(e) {
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
                    alert('Error al eliminar la novedad.');
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
