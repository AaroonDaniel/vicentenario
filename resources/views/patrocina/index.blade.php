@extends('layouts.principal')

@section('title', 'Vicentenario Bolivia')

@section('content')
    <section class="content">
        <div x-data="modalEdit()">
            <div class="p-6">

                <!-- Encabezado y botón -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Listado de Patrocinadores</h1>
                    <button onclick="abrirModal('modalNuevo')"
                        class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">+ Nuevo</button>
                </div>

                <!-- Éxito -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabla -->
                <div class="overflow-x-auto table-responsive">
                    <table id="funcionesTable" class="min-w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Imagen</th>
                                <th class="px-4 py-3">Razón Social</th>
                                <th class="px-4 py-3">Institución</th>
                                <th class="px-4 py-3">Eventos</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patrocinadores as $patrocinador)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $patrocinador->id_patrocinador }}</td>
                                    <td class="px-4 py-2">
                                        @if ($patrocinador->imagen)
                                            <img src="{{ asset('storage/' . $patrocinador->imagen) }}" alt="Imagen"
                                                class="w-16 h-16 object-cover rounded border">
                                        @else
                                            <span class="text-gray-500 italic">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $patrocinador->razon_social }}</td>
                                    <td class="px-4 py-2">{{ $patrocinador->institucion }}</td>
                                    <td class="px-4 py-2">
                                        @forelse ($patrocinador->eventos as $evento)
                                            <div>
                                                <strong>{{ $evento->nombre }}</strong>
                                                <span class="text-sm text-gray-600">(Bs
                                                    {{ number_format($evento->pivot->monto, 2) }})</span>
                                            </div>
                                        @empty
                                            <span class="text-gray-500 italic">Sin eventos</span>
                                        @endforelse
                                    </td>
                                    <td class="px-4 py-2 flex space-x-2">
                                        <button onclick='abrirModalVer(@json(array_merge($patrocinador->toArray(), [
                                                'imagen_url' => $patrocinador->imagen ? asset("storage/{$patrocinador->imagen}") : asset('default.jpg'),
                                            ])))'
                                            class="text-blue-500 hover:text-blue-700" title="Ver expositor">
                                            <i class="fas fa-eye"></i>
                                        </button>




                                        <button onclick="abrirModalEditar({{ $patrocinador->id_patrocinador }})"
                                            class="text-yellow-500 hover:text-yellow-700" title="Editar expositor">
                                            <i class="fas fa-edit"></i>
                                        </button>


                                        <button
                                            onclick="confirmarEliminarPatrocinador({{ $patrocinador->id_patrocinador }}, '{{ addslashes($patrocinador->razon_social) }}')"
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
            <!-- MODAL NUEVO PATROCINADOR -->
            <div id="modalNuevo" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <button onclick="cerrarModal('modalNuevo')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-4">Registrar Nuevo Patrocinador</h2>
                    <form action="{{ route('patrocinadores.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Imagen (opcional)</label>
                            <input type="file" name="imagen"
                                class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:border-blue-300">
                        </div>

                        <!-- Razón social -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Razón Social</label>
                            <input type="text" name="razon_social" value="{{ old('razon_social') }}" required
                                class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:border-blue-300">
                            @error('razon_social')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Institución -->
                        <div class="mb-4">
                            <label class="block text-gray-700 font-semibold mb-2">Institución</label>
                            <input type="text" name="institucion" value="{{ old('institucion') }}"
                                class="border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring focus:border-blue-300">
                            @error('institucion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Selección de eventos con monto -->
                        <div id="eventos-container" class="mb-4">
                            <label class="block font-semibold mb-2">Eventos y Monto</label>

                            <div class="evento-entry flex gap-4 mb-2">
                                <select name="eventos[0][id_evento]" class="w-1/2 border border-gray-300 rounded px-3 py-2"
                                    required>
                                    <option value="">Seleccionar evento</option>
                                    @foreach ($eventos as $evento)
                                        <option value="{{ $evento->id_evento }}">{{ $evento->nombre }}</option>
                                    @endforeach
                                </select>

                                <input type="number" name="eventos[0][monto]"
                                    class="w-1/2 border border-gray-300 rounded px-3 py-2"
                                    placeholder="Monto del patrocinio (Bs.)" min="0" required>
                            </div>
                            <button type="button" onclick="agregarEventoEntrada()" class="text-blue-600 text-sm mb-4">
                                + Añadir otro evento
                            </button>
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end mt-6 space-x-3">
                            <button type="button" onclick="cerrarModal('modalNuevo')"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancelar</button>

                            <button type="submit"
                                class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">Guardar</button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- MODAL DE EDITAR -->
            <div id="modalEditar" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <button onclick="cerrarModal('modalEditar')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>

                    <h2 class="text-2xl font-bold mb-4">Editar Patrocinador</h2>

                    <form id="formEditar" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block font-semibold mb-2">Razón Social</label>
                            <input type="text" id="editarRazonSocial" name="razon_social"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-2">Institución</label>
                            <input type="text" id="editarInstitucion" name="institucion"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-2">Imagen (opcional)</label>
                            <input type="file" name="imagen" class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Imagen actual</label>
                            <img id="edit-imagen-preview" src="" alt="Imagen actual"
                                class="w-32 h-32 object-cover rounded border">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-2">Eventos y Montos</label>
                            <div id="editar-eventos-container" class="space-y-2">
                                <!-- Aquí se agregan dinámicamente entradas con JS -->
                            </div>
                            <button type="button" onclick="agregarEventoEntradaEditar()"
                                class="text-blue-600 text-sm mt-2">
                                + Añadir otro evento
                            </button>
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <button type="button" onclick="cerrarModal('modalEditar')"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>



            <!-- MODAL DE BORRAR -->
            <div id="eliminarPatrocinadorModal"
                class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white p-5 rounded shadow-lg w-1/3">
                    <h2 class="text-lg font-bold mb-4">Eliminar Patrocinador</h2>
                    <p>¿Estás seguro de eliminar a <span id="nombrePatrocinadorEliminar" class="font-semibold"></span>?
                    </p>
                    <p id="error-message" class="text-red-500 mt-2 hidden"></p>
                    <div class="mt-4 flex justify-end space-x-2">
                        <button onclick="cerrarModalEliminarPatrocinador()"
                            class="px-4 py-2 bg-gray-300 rounded">Cancelar</button>
                        <form id="formEliminarPatrocinador" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="btnEliminarNormal"
                                class="px-4 py-2 bg-red-500 text-white rounded">Eliminar</button>
                            <button type="button" id="btnEliminarForzado" onclick="eliminarPatrocinador(true)"
                                class="px-4 py-2 bg-red-700 text-white rounded hidden">Eliminar de todas formas</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL D VER -->
            <div id="verPatrocinadorModal"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                <div class="bg-white w-full max-w-4xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <div class="flex justify-between items-center border-b pb-2 mb-2">
                        <h2 class="text-lg font-bold text-black-700"><i class="fas fa-info-circle"></i> Detalles del
                            patrocinador</h2>
                        <button onclick="cerrarModal('verPatrocinadorModal')"
                            class="text-gray-600 hover:text-red-600 text-lg">&times;</button>
                    </div>

                    <div class="space-y-2">
                        <div><strong>Razón Social:</strong> <span id="ver-nombre" class="text-gray-600"></span></div>
                        <div><strong>Institución:</strong> <span id="ver-institucion" class="text-gray-600"></span></div>
                        <div><strong>Eventos:</strong>
                            <ul id="ver-eventos" class="list-disc ml-5 text-gray-600"></ul>
                        </div>
                        
                        <div class="mt-4">
                            <strong>Imagen:</strong>
                            <img id="ver-imagen" src="" alt=""
                                class="w-full max-h-64 object-contain mt-2 rounded border"
                                onerror="this.src='/default.jpg'">
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button onclick="cerrarModal('verPatrocinadorModal')"
                            class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">OK</button>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function abrirModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            } else {
                console.error('Modal no encontrado:', id);
            }
        }

        function cerrarModal(id) {
            const modal = document.getElementById(id);
            if (modal) {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                console.error('Modal no encontrado:', id);
            }
        }
    </script>

    <!-- Crear nuevo patrocinador -->
    <script>
        let contadorEvento = 1;

        function agregarEventoEntrada() {
            const container = document.getElementById('eventos-container');

            const div = document.createElement('div');
            div.className = 'evento-entry flex gap-4 mb-2';

            div.innerHTML = `
            <select name="eventos[${contadorEvento}][id_evento]" class="w-1/2 border border-gray-300 rounded px-3 py-2" required>
                <option value="">Seleccionar evento</option>
                @foreach ($eventos as $evento)
                    <option value="{{ $evento->id_evento }}">{{ $evento->nombre }}</option>
                @endforeach
            </select>

            <input type="number" name="eventos[${contadorEvento}][monto]" class="w-1/2 border border-gray-300 rounded px-3 py-2"
                   placeholder="Monto del patrocinio (Bs.)" min="0" required>
        `;

            container.appendChild(div);
            contadorEvento++;
        }
    </script>

    <!-- Editar patrocinador -->
    <script>
        // Función para abrir el modal de edición
        function abrirModalEditar(id_patrocinador) {
            fetch(`/patrocinadores/${id_patrocinador}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error al obtener los datos del patrocinador");
                    }
                    return response.json();
                })
                .then(patrocinador => {
                    if (!patrocinador || !patrocinador.id_patrocinador) {
                        console.error("Datos del patrocinador no válidos:", patrocinador);
                        alert("No se pudo abrir el modal. Patrocinador no válido.");
                        return;
                    }

                    // Asigna la acción del formulario
                    document.getElementById("formEditar").action = `/patrocinadores/${patrocinador.id_patrocinador}`;

                    // Rellena los campos
                    document.getElementById("editarRazonSocial").value = patrocinador.razon_social || "";
                    document.getElementById("editarInstitucion").value = patrocinador.institucion || "";

                    // Previsualización de imagen
                    const imagenPreview = document.getElementById("edit-imagen-preview");
                    imagenPreview.src = patrocinador.imagen ?
                        "/storage/" + patrocinador.imagen :
                        "https://via.placeholder.com/300x200?text=Sin+imagen ";

                    // Llena los eventos asociados
                    const container = document.getElementById("editar-eventos-container");
                    container.innerHTML = "";

                    (patrocinador.eventos || []).forEach((evento, index) => {
                        const div = document.createElement("div");
                        div.className = "flex gap-4 mb-2";

                        // Selector de evento
                        const select = document.createElement("select");
                        select.name = `eventos[${index}][id_evento]`;
                        select.className = "w-1/2 border border-gray-300 rounded px-3 py-2";
                        select.required = true;

                        const optionDefault = document.createElement("option");
                        optionDefault.value = "";
                        optionDefault.textContent = "Seleccionar evento";
                        select.appendChild(optionDefault);

                        @foreach ($eventos as $evento)
                            const option{{ $evento->id_evento }} = document.createElement("option");
                            option{{ $evento->id_evento }}.value = "{{ $evento->id_evento }}";
                            option{{ $evento->id_evento }}.textContent = "{{ $evento->nombre }}";
                            if (evento.id_evento == "{{ $evento->id_evento }}") {
                                option{{ $evento->id_evento }}.selected = true;
                            }
                            select.appendChild(option{{ $evento->id_evento }});
                        @endforeach

                        // Campo de monto
                        const inputMonto = document.createElement("input");
                        inputMonto.type = "number";
                        inputMonto.name = `eventos[${index}][monto]`;
                        inputMonto.className = "w-1/2 border border-gray-300 rounded px-3 py-2";
                        inputMonto.placeholder = "Monto Bs.";
                        inputMonto.required = true;
                        inputMonto.value = evento.pivot?.monto || 0;

                        div.appendChild(select);
                        div.appendChild(inputMonto);
                        container.appendChild(div);
                    });

                    // Abrir modal
                    document.getElementById("modalEditar").classList.remove("hidden");
                })
                .catch(error => {
                    console.error("Error al obtener los datos:", error);
                    alert("No se pudieron cargar los datos del patrocinador.");
                });
        }

        // Función para agregar nuevos eventos
        function agregarEventoEntradaEditar() {
            const container = document.getElementById('editar-eventos-container');
            const index = container.children.length;

            const div = document.createElement('div');
            div.className = 'flex gap-4 mb-2';

            const select = document.createElement('select');
            select.name = `eventos[${index}][id_evento]`;
            select.className = 'w-1/2 border border-gray-300 rounded px-3 py-2';
            select.required = true;

            const optionDefault = document.createElement('option');
            optionDefault.value = '';
            optionDefault.textContent = 'Seleccionar evento';
            select.appendChild(optionDefault);

            @foreach ($eventos as $evento)
                const option{{ $evento->id_evento }} = document.createElement('option');
                option{{ $evento->id_evento }}.value = '{{ $evento->id_evento }}';
                option{{ $evento->id_evento }}.textContent = '{{ $evento->nombre }}';
                select.appendChild(option{{ $evento->id_evento }});
            @endforeach

            const inputMonto = document.createElement('input');
            inputMonto.type = 'number';
            inputMonto.name = `eventos[${index}][monto]`;
            inputMonto.className = 'w-1/2 border border-gray-300 rounded px-3 py-2';
            inputMonto.placeholder = 'Monto Bs.';

            div.appendChild(select);
            div.appendChild(inputMonto);
            container.appendChild(div);
        }

        // Cerrar modal
        function cerrarModal(modalId) {
            document.getElementById(modalId).classList.add("hidden");
        }
    </script>

    <!-- Ver patrocinador -->
    <script>
        function abrirModalVer(patrocinador) {
            document.getElementById('ver-nombre').textContent = patrocinador.razon_social || 'Sin datos';
            document.getElementById('ver-institucion').textContent = patrocinador.institucion || 'Sin datos';

            const imagen = document.getElementById('ver-imagen');
            const imagenURL = patrocinador.imagen_url && patrocinador.imagen_url.trim() !== '' ?
                patrocinador.imagen_url :
                '/default.jpg';
            const timestamp = new Date().getTime(); // Evita caché
            imagen.src = `${imagenURL}?t=${timestamp}`;
            imagen.alt = `Imagen de ${patrocinador.razon_social || 'Patrocinador'}`;

            const eventosContainer = document.getElementById('ver-eventos');
            eventosContainer.innerHTML = '';

            if (patrocinador.eventos && patrocinador.eventos.length > 0) {
                patrocinador.eventos.forEach(ev => {
                    const li = document.createElement('li');
                    li.textContent = `${ev.nombre} - Bs. ${ev.pivot.monto}`;
                    eventosContainer.appendChild(li);
                });
            } else {
                eventosContainer.innerHTML = '<li class="text-gray-500">Sin eventos registrados.</li>';
            }

            abrirModal('verPatrocinadorModal');
        }

        function abrirModalEliminar(id, nombre) {
            document.getElementById('formEliminar').action = `/patrocinadores/${id}`;
            document.getElementById('eliminarNombre').textContent = nombre;
            abrirModal('modalEliminar');
        }
    </script>

    <!-- Eliminar-->
    <script>
        function confirmarEliminarPatrocinador(id, nombre) {
            $('#formEliminarPatrocinador').attr('action', `/patrocinadores/${id}`);
            $('#nombrePatrocinadorEliminar').text(nombre);
            $('#error-message').hide().text('');
            $('#eliminarPatrocinadorModal').removeClass('hidden');
        }

        function cerrarModalEliminarPatrocinador() {
            $('#eliminarPatrocinadorModal').addClass('hidden');
            $('#formEliminarPatrocinador').attr('action', '');
            $('#nombrePatrocinadorEliminar').text('');
            $('#error-message').hide();
            $('#btnEliminarNormal').show();
            $('#btnEliminarForzado').hide();
        }

        $('#formEliminarPatrocinador').on('submit', function(e) {
            e.preventDefault();
            eliminarPatrocinador(false); // Eliminación normal
        });

        function eliminarPatrocinador(force = false) {
            const actionUrl = $('#formEliminarPatrocinador').attr('action');
            const token = $('meta[name="csrf-token"]').attr('content');
            let url = actionUrl;

            if (force) {
                url += '?force=1'; // Añadir parámetro de fuerza
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: token,
                    _method: 'DELETE'
                },
                success: function(response) {
                    if (response.success) {
                        cerrarModalEliminarPatrocinador();
                        location.reload();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 400 && xhr.responseJSON.has_events) {
                        $('#error-message')
                            .text(xhr.responseJSON.error)
                            .show();
                        $('#btnEliminarNormal').hide();
                        $('#btnEliminarForzado').show();
                    } else {
                        alert('No se pudo eliminar el patrocinador.');
                        cerrarModalEliminarPatrocinador();
                    }
                }
            });
        }
    </script>
@endpush
