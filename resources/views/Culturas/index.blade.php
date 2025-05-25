@extends('layouts.principal')

@section('content')
    <section class="content">
        <!-- Seccion de CULTURA -->


        <section class="ultimas gray">
            <section class="inner">
                <h2 class="title_home">Culturas</h2>
                <section class="scroll_notes">
                    <article class="flex gap-4 overflow-x-auto pb-4">
                        @foreach ($culturas as $cultura)
                            <a href="{{ route('culturas.show', $cultura->id_cultura) }}"
                                class="especial min-w-[300px] bg-white shadow rounded overflow-hidden">
                                <figure>
                                    @if ($cultura->imagen)
                                        <img src="{{ Storage::url($cultura->imagen) }}" alt="Imagen de {{ $cultura->nombre }}"
                                            class="w-full h-48 object-cover">
                                    @else
                                        <img src="#" alt="Sin imagen"
                                            class="w-full h-48 object-cover">
                                    @endif
                                </figure>

                                <figcaption class="p-3 bg-white">
                                    {{-- TÍTULO GRANDE --}}
                                    <h3 class="text-2xl font-bold text-center mb-4 text-white px-4 py-1">
                                        {{ $cultura->nombre }}
                                    </h3>
                                    

                                    {{-- DESCRIPCIÓN --}}
                                    <p class="mt-2 text-sm text-white description-text">
                                        {{ Str::limit($cultura->descripcion, 160, '...') }}
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

        <!-- Crud de CULTURA -->
        <div>
            <!-- {{-- @can('Usuario cultural') --}}-->
            <div class="p-4 sm:p-6 max-w-full overflow-x-auto">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-2">
                    <h1 class="text-2xl font-bold text-gray-800">Listado de Culturas</h1>
                    <button onclick="abrirModal('modalNuevo')"
                        class="bg-pink-600 hover:bg-pink-800 text-white px-4 py-2 rounded w-full sm:w-auto">+ Nuevo</button>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto w-full">
                    <table id="funcionesTable"
                        class="min-w-[1000px] w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3 max-w-[200px]">Historia</th>
                                <th class="px-4 py-3 max-w-[200px]">Nombre</th>
                                <th class="px-4 py-3 max-w-[200px]">Tipo</th>
                                <th class="px-4 py-3 max-w-[200px]">Origen</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3">Imagen</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($culturas as $cultura)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $cultura->id_cultura }}</td>
                                    <td class="px-4 py-2 truncate max-w-[200px]">{{ optional($cultura->historia)->titulo ?? 'Sin historia' }}</td>
                                    <td class="px-4 py-2 truncate max-w-[200px]">{{ $cultura->nombre }}</td>
                                    <td class="px-4 py-2 truncate max-w-[200px]">{{ $cultura->tipo }}</td>
                                    <td class="px-4 py-2 truncate max-w-[200px]">{{ $cultura->origen }}</td>
                                    <td class="px-4 py-2">{{ $cultura->created_at }}</td>

                                    <td class="px-4 py-2">
                                        @if ($cultura->imagen)
                                            <img src="{{ asset('storage/' . $cultura->imagen) }}" alt="Imagen"
                                                class="w-16 h-16 object-cover rounded border">
                                        @else
                                            <span class="text-gray-500 italic">Sin imagen</span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-2 flex space-x-2">
                                        {{-- Ver --}}

                                        <button onclick="mostrarDetalles({{ $cultura->id_cultura }})"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- Editar --}}
                                        <button onclick='openEditModal({!! json_encode([
                                            'id' => $cultura->id_cultura,
                                            'historia_id' => $cultura->id_historia,
                                            'nombre' => $cultura->nombre,
                                            'descripcion' => $cultura->descripcion,
                                            'tipo' => $cultura->tipo,
                                            'origen' => $cultura->origen,
                                            'fecha' => $cultura->created_at,
                                            'imagen' => $cultura->imagen,
                                        ]) !!})'
                                            class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Eliminar --}}
                                        <button
                                            onclick="confirmarEliminar({{ $cultura->id_cultura }}, '{{ $cultura->nombre }}')"
                                            class="text-red-600 hover:text-red-800">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center text-gray-500 py-4">
                                        No hay Culturas registrados actualmente.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!--{{-- @endcan --}}-->


            <!-- MODAL EDITAR -->
            <div id="editModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center p-4">
                <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh] space-y-4">
                    <button onclick="closeEditModal()"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                    </button>

                    <h2 class="text-lg font-bold text-black-700 mb-4">
                        <i class="fas fa-user-edit mr-2"></i>Editar Cultura
                    </h2>

                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="form-id">

                        <div class="mb-4">
                            <label class="block font-semibold">Historia</label>
                            <select name="id_historia" id="form-historia"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                                @foreach ($historias as $historia)
                                    <option value="{{ $historia->id_historia }}">
                                        {{ $historia->titulo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Nombre</label>
                            <input type="text" name="nombre" id="form-nombre"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Descripción</label>
                            <input type="text" name="descripcion" id="form-descripcion"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Tipo</label>
                            <input type="text" name="tipo" id="form-tipo"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Origen</label>
                            <input type="text" name="origen" id="form-origen"
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

                        <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                            <button type="button" onclick="closeEditModal()"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cerrar</button>
                            <button type="submit"
                                class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-800">Editar cultura</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal VER DETALLES -->
            <div
                id="verCulturaModal"class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white w-full max-w-4xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative space-y-4">
                        <div class="flex justify-between items-center border-b pb-2 mb-2">
                            <h2 class="text-lg font-bold text-black-700 mb-4"><i class="fas fa-info-circle"></i> Detalles
                                de la cultura</h2>
                            <button onclick="cerrarModalVer()"
                                class="text-gray-600 hover:text-red-600 text-lg">&times;</button>
                        </div>
                        <div>
                            <div>
                                <strong>Historia:</strong>
                                <div id="ver-historia" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Nombre:</strong>
                                <div id="ver-nombre" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Tipo:</strong>
                                <div id="ver-tipo" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Origen:</strong>
                                <div id="ver-origen" class="text-gray-600"></div>
                            </div>
                            <div class="col-span-2">
                                <strong>Descripción:</strong>
                                <div id="ver-descripcion" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Fecha creación:</strong>
                                <div id="ver-fecha-creacion" class="text-gray-600"></div>
                            </div>
                            <div>
                                <strong>Fecha actualización:</strong>
                                <div id="ver-fecha-actualizacion" class="text-gray-600"></div>
                            </div>
                            <div class="mt-4">
                                <strong>Imagen:</strong>
                                <div>
                                    <img id="ver-imagen" src="" alt="Imagen de la cultura"
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
            <div id="eliminarCulturaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg shadow-lg w-full sm:max-w-md p-6 space-y-4">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-bold text-black-600"><i class="fas fa-trash-alt"></i> Eliminar Cultura
                            </h2>
                            <button onclick="cerrarModalEliminar()"
                                class="text-gray-600 hover:text-black-600 text-lg">&times;</button>
                        </div>

                        <p class="text-gray-800 mb-4">¿Estás seguro que deseas eliminar la cultura <span
                                id="nombreCulturaEliminar" class="font-semibold text-black-600"></span>?</p>

                        <form id="formEliminarCultura" method="POST">
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
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative space-y-4">
                    <button onclick="cerrarModal('modalNuevo')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-4">Registrar Nueva Cultura</h2>

                    <form action="{{ route('culturas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Historia Relacionada</label>
                            <select name="id_historia" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="">-- Selecciona una historia --</option>
                                @foreach ($historias as $historia)
                                    <option value="{{ $historia->id_historia }}">{{ $historia->titulo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Descripcion</label>
                            <input type="text" name="descripcion" value="{{ old('descripcion') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Tipo</label>
                            <input type="text" name="tipo" value="{{ old('tipo') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Origen</label>
                            <input type="text" name="origen" value="{{ old('origen') }}"
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
            document.getElementById('editModal').classList.remove('hidden');

            // Asignar valores al formulario
            document.getElementById('form-id').value = data.id;

            // Seleccionar la historia correcta en el dropdown
            const historiaSelect = document.getElementById('form-historia');
            if (historiaSelect) {
                for (let i = 0; i < historiaSelect.options.length; i++) {
                    if (historiaSelect.options[i].value == data.historia_id) {
                        historiaSelect.options[i].selected = true;
                        break;
                    }
                }
            }

            document.getElementById('form-nombre').value = data.nombre;
            document.getElementById('form-descripcion').value = data.descripcion || '';
            document.getElementById('form-tipo').value = data.tipo;
            document.getElementById('form-origen').value = data.origen;

            if (data.fecha) {
                const fecha = new Date(data.fecha);
                const fechaFormateada = fecha.getFullYear() + '-' +
                    String(fecha.getMonth() + 1).padStart(2, '0') + '-' +
                    String(fecha.getDate()).padStart(2, '0') + ' ' +
                    String(fecha.getHours()).padStart(2, '0') + ':' +
                    String(fecha.getMinutes()).padStart(2, '0') + ':' +
                    String(fecha.getSeconds()).padStart(2, '0');
                document.querySelector("input[name='fecha']").value = fechaFormateada;
            } else {
                document.querySelector("input[name='fecha']").value = '';
            }
            // Previsualización de la imagen
            if (data.imagen) {
                document.getElementById('edit-imagen-preview').src = '/storage/' + data.imagen;
            } else {
                document.getElementById('edit-imagen-preview').src = 'https://via.placeholder.com/300x200?text=Sin+imagen';
            }

            // Actualizar la acción del formulario
            document.getElementById('editForm').action = '/culturas/' + data.id;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

    <!-- ver-->
    <script>
        function mostrarDetalles(id) {
            $.ajax({
                url: `/culturas/${id}`,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("Datos recibidos:", data); // Para depuración

                    $('#ver-nombre').text(data.nombre);
                    $('#ver-tipo').text(data.tipo);
                    $('#ver-origen').text(data.origen);
                    $('#ver-descripcion').text(data.descripcion || 'No disponible');

                    // Verificar cómo viene la relación de historia en la respuesta
                    if (data.historia && data.historia.titulo) {
                        $('#ver-historia').text(data.historia.titulo);
                    } else {
                        $('#ver-historia').text('Sin historia');
                    }

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

                    $('#verCulturaModal').removeClass('hidden');
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud:", error);
                    console.error("Respuesta:", xhr.responseText);
                    alert('No se pudo cargar la información.');
                }
            });
        }

        function cerrarModalVer() {
            $('#verCulturaModal').addClass('hidden');
        }
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

    <!-- ELIMINAR-->
    <script>
        function confirmarEliminar(id, nombre) {
            $('#formEliminarCultura').attr('action', `/culturas/${id}`);
            $('#nombreCulturaEliminar').text(nombre);
            $('#eliminarCulturaModal').removeClass('hidden');
        }

        function cerrarModalEliminar() {
            $('#eliminarCulturaModal').addClass('hidden');
            $('#formEliminarCultura').attr('action', '');
            $('#nombreCulturaEliminar').text('');
        }

        // Opción AJAX (si no deseas recargar)
        $('#formEliminarCultura').on('submit', function(e) {
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
@endpush
