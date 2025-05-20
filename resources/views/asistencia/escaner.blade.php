@extends('layouts.principal')

@section('content')
<section class="content  p-8 bg-dark bg-opacity-75" >

    <div class="container d-flex justify-content-center ">
        <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; background: rgba(51, 218, 140, 0.1); backdrop-filter: blur(12px); border-radius: 1rem; color: #fff;">
            <h2 class="text-center mb-3 fw-bold"><i class="bi bi-upc-scan"></i>   E s c a n e a r   c ó d i g o   QR</h2>
            <p class="text-center">Coloca el código QR frente a la cámara para registrar tu asistencia al evento.</p>
            
            <div id="reader" class="mx-auto mt-3" style="width: 100%; max-width: 400px;"></div>
            <div id="result" class="mt-4 alert alert-info text-center fw-bold d-none" role="alert"></div>
        </div>
    </div>
    
</section>
<!------------------------------------------------------->
<section class="content  bg-dark bg-opacity-50">
    <!-- tabla lista -->
    <div class="p-5">
        <!-- Modo pc:  -->
        <div class="hidden md:block overflow-x-auto  ">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-100">Listado de asistencias</h1>
                <button onclick="abrirModal('modalNuevo')" 
                    class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">+ Nuevo</button>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm shadow">
                    {{ session('success') }}
                </div>
            @endif
            {{-- Mensaje de error --}}
            @if ($errors->has('error'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm shadow">
                    {{ $errors->first('error') }}
                </div>
            @endif
            

            <div class="overflow-x-auto table-responsive">
                <table id="funcionesTable"
                    class="min-w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">ID USUARIO</th>
                            <th class="px-4 py-3">NOMBRE DEL USUARIO</th>
                            <th class="px-4 py-3">ID EVENTO</th>
                            <th class="px-4 py-3">NOMBRE DEL EVENTO</th>
                            <th class="px-4 py-3">ASISTIO</th>
                            <th class="px-4 py-3">Fecha</th>                                
                            <th class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asistencias as $asistencia)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $asistencia->id }}</td>
                                <td class="px-4 py-2">{{ $asistencia->user_id }}</td>
                                <td class="px-4 py-2">{{ $asistencia->nombre_usuario }}</td>
                                <td class="px-4 py-2">{{ $asistencia->evento_id }}</td>
                                <td class="px-4 py-2">{{ $asistencia->nombre_evento }}</td>
                                <td class="px-4 py-2">{{ $asistencia->asistio ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2">{{ $asistencia->created_at?->format('Y-m-d') ?? 'Sin fecha' }}</td>


                                <td class="px-4 py-2 flex space-x-2">
                                    
                                    {{-- Botón para ver --}}
                                    <button onclick="mostrarDetalles({{ $asistencia->id }})"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    {{-- Editar --}}
                                    <button
                                        onclick="openEditModal({
                                            id: '{{ $asistencia->id }}',
                                            user_id: '{{ addslashes($asistencia->user_id) }}',
                                            nombre_usuario: '{{ addslashes($asistencia->nombre_usuario) }}',
                                            evento_id: '{{ addslashes($asistencia->evento_id) }}',
                                            nombre_evento: '{{ $asistencia->nombre_evento }}',
                                            asistio: '{{ $asistencia->asistio }}',
                                            fecha: '{{ $asistencia->created_at }}'
                                            
                                        })"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modo móvil: tarjetas -->
        <div class="md:hidden space-y-4 p-2">
            @foreach ($asistencias as $asistencia)
                <div class="bg-gray-100 p-3 rounded-lg shadow">
                    <div><span class="font-semibold">ID:</span> {{ $asistencia->id }}</div>
                    <div><span class="font-semibold">ID Usuario:</span> {{ $asistencia->user_id }}</div>
                    <div><span class="font-semibold">Nombre Usuario:</span> {{ $asistencia->nombre_usuario }}</div>
                    <div><span class="font-semibold">ID Evento:</span> {{ $asistencia->evento_id }}</div>
                    <div><span class="font-semibold">Nombre Evento:</span> {{ $asistencia->nombre_evento }}</div>
                    <div><span class="font-semibold">Asistió:</span> {{ $asistencia->asistio ? 'Sí' : 'No' }}</div>
                    <div><span class="font-semibold">Fecha:</span> {{ $asistencia->created_at?->format('Y-m-d') ?? 'Sin fecha' }}</div>

                    <div class="flex mt-2 space-x-4 justify-center">
                        <button onclick="mostrarDetalles({{ $asistencia->id }})"
                            class="text-teal-900 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button
                            onclick="openEditModal({
                                id: '{{ $asistencia->id }}',
                                user_id: '{{ addslashes($asistencia->user_id) }}',
                                nombre_usuario: '{{ addslashes($asistencia->nombre_usuario) }}',
                                evento_id: '{{ addslashes($asistencia->evento_id) }}',
                                nombre_evento: '{{ $asistencia->nombre_evento }}',
                                asistio: '{{ $asistencia->asistio }}',
                                fecha: '{{ $asistencia->created_at }}'
                            })"
                            class="text-yellow-900 hover:text-yellow-700">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- MODAL EDITAR -->
    <div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh]">
            <button onclick="closeEditModal()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;
            </button>
            <h2 class="text-lg font-bold text-black-700 mb-4">
                <i class="fas fa-user-edit mr-2"></i>Editar Asistencia
            </h2>

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" id="form-id">

                <div class="mb-4">
                    <label class="block font-semibold">ID del usuario</label>
                    <input type="number" name="user_id" id="form-user_id"
                        class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Nombre del usuario</label>
                    <input type="text" name="nombre_usuario" id="form-nombre_usuario" 
                        class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">ID del evento</label>
                    <input type="number" name="evento_id" id="form-evento_id"
                        class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                </div>

                

                <div class="mb-4">
                    <label class="block font-semibold">Nombre del evento</label>
                    <input type="text" name="nombre_evento" id="form-nombre_evento"
                        class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold">Asistio</label>
                    <select name="asistio" id="form-asistio"
                        class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Fecha</label>
                    <input type="text" name="fecha" id="form-fecha"
                        class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2" readonly>
                </div>


                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</button>
                    <button type="submit"
                        class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Editar Asitencia</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal VER DETALLES -->
    <div id="verAsistenciaModal"  class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
        
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh]">
            <button onclick="cerrarModalVer()"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;
            </button>
            <h2 class="text-lg font-bold text-black-700 mb-4">
                <i class="fas fa-info-circle"></i> Detalles de la asistencia
            </h2>

            <div>
                <div class="mb-2">
                    <strong>ID USUARIO:</strong>
                    <div id="ver-user_id" class="text-gray-600"></div>
                </div>

                <div class="mb-2">
                    <strong>NOMBRE DEL USUARIO:</strong>
                    <div id="ver-nombre_usuario" class="text-gray-600"></div>
                </div>

                <div class="mb-2">
                    <strong>ID USUARIO:</strong>
                    <div id="ver-evento_id" class="text-gray-600"></div>
                </div>

                <div class="mb-2">
                    <strong>NOMBRE DEL EVENTO:</strong>
                    <div id="ver-nombre_evento" class="text-gray-600"></div>
                </div>

                <div class="mb-2">
                    <strong>ASISTIO:</strong>
                    <div id="ver-asistio" class="text-gray-600"></div>
                </div>

                <div class="mb-2">
                    <strong>Fecha creación:</strong>
                    <div id="ver-fecha-creacion" class="text-gray-600"></div>
                </div>

                <div class="mb-2">
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

    <!-- Modal NUEVO -->
    <div id="modalNuevo"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh]">
            <button onclick="cerrarModal('modalNuevo')"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
            <h2 class="text-2xl font-bold mb-4">Registrar Nueva Asistencia</h2>

            <form action="{{ route('asistencias.store') }}" method="POST">
                @csrf

                {{-- Seleccionar Usuario --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Seleccionar Usuario</label>
                    <select name="user_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">-- Selecciona un usuario --</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->user_id }}"
                                {{ old('user_id') == $usuario->user_id ? 'selected' : '' }}>
                                {{ $usuario->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Seleccionar Evento --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Seleccionar Evento</label>
                    <select name="evento_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="">-- Selecciona un evento --</option>
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->id_evento }}"
                                {{ old('evento_id') == $evento->id_evento ? 'selected' : '' }}>
                                {{ $evento->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Asistió --}}
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Asistió</label>
                    <select name="asistio" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="1" {{ old('asistio') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('asistio') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="text-right">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>


</section>

@endsection
@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const html5QrcodeScanner = new Html5QrcodeScanner("reader", {
            fps: 10,
            qrbox: 250,
            rememberLastUsedCamera: true,
            showTorchButtonIfSupported: true,
            formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ]
        });

        function reiniciarEscaner() {
            html5QrcodeScanner.clear().then(() => {
                html5QrcodeScanner.render(onScanSuccess);
            }).catch(err => {
                console.error("Error al reiniciar el escáner:", err);
            });
        }

        function onScanSuccess(decodedText, decodedResult) {
            const resultBox = document.getElementById('result');
            resultBox.classList.remove('d-none');
            resultBox.innerText = "📡 QR detectado. Enviando datos...";
            html5QrcodeScanner.clear();

            fetch("{{ route('asistencias.registrar') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify(JSON.parse(decodedText))
            }).then(response => response.json())
            .then(data => {
                if (data.usuario && data.evento) {
                    Swal.fire({
                        icon: 'success',
                        title: '✅ Asistencia registrada',
                        html: `<b>👤 Usuario:</b> ${data.usuario}<br><b>🎉 Evento:</b> ${data.evento}`,
                        confirmButtonText: 'Escanear otro',
                        allowOutsideClick: false
                    }).then(() => {
                        reiniciarEscaner();
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'ℹ️ Información',
                        text: data.message
                    }).then(() => {
                        reiniciarEscaner();
                    });
                }
            }).catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: '❌ Error',
                    text: 'Ocurrió un error al registrar la asistencia.'
                }).then(() => {
                    reiniciarEscaner();
                });
            });
        }

        html5QrcodeScanner.render(onScanSuccess);

        // Traducción UI
        setTimeout(() => {
            const traducirTexto = () => {
                document.querySelectorAll('button').forEach(btn => {
                    if (btn.innerText === "Stop Scanning") btn.innerText = "Detener escaneo";
                    if (btn.innerText === "Start Scanning") btn.innerText = "Iniciar escaneo";
                    if (btn.innerText === "Scan an Image File") btn.innerText = "Escanear imagen desde archivo";
                    if (btn.innerText === "Switch camera") btn.innerText = "Cambiar cámara";
                });
                document.querySelectorAll('span, div').forEach(el => {
                    if (el.innerText.includes("Camera permissions")) {
                        el.innerText = "Permisos de cámara denegados o no disponibles.";
                    }
                });
            };

            traducirTexto();

            const observer = new MutationObserver(traducirTexto);
            observer.observe(document.getElementById('reader'), { childList: true, subtree: true });
        }, 500);
    </script>
    <!---->




    <!-- modal cerrar//abrir-->
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
            document.getElementById('form-user_id').value = data.user_id;
            document.getElementById('form-nombre_usuario').value = data.nombre_usuario;
            document.getElementById('form-evento_id').value = data.evento_id;
            document.getElementById('form-nombre_evento').value = data.nombre_evento;
            document.getElementById('form-asistio').value = data.asistio ? '1' : '0';

            document.getElementById('form-fecha').value = data.fecha;

            // Establecer acción del formulario
            const form = document.getElementById('editForm');
            form.action = `/asistencias/${data.id}`;

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
                url: `/asistencias/${id}`,
                method: 'GET',
                success: function(data) {
                    // Rellenar campos
                    $('#ver-user_id').text(data.user_id);
                    $('#ver-nombre_usuario').text(data.nombre_usuario);
                    $('#ver-evento_id').text(data.evento_id);
                    $('#ver-nombre_evento').text(data.nombre_evento);
                    $('#ver-asistio').text(data.asistio);
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

                    // Mostrar modal
                    $('#verAsistenciaModal').removeClass('hidden');
                },
                error: function() {
                    alert('No se pudo cargar la información.');
                }
            });
        }

        function cerrarModalVer() {
            $('#verAsistenciaModal').addClass('hidden');
        }
    </script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('#modalNuevo form');
        form.addEventListener('submit', (e) => {
            const btn = form.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerText = 'Guardando...';
        });
    });
</script>

<script>
    // Ocultar los mensajes después de 4 segundos
    setTimeout(() => {
        const success = document.getElementById('alert-success');
        const error = document.getElementById('alert-error');
        if (success) success.style.display = 'none';
        if (error) error.style.display = 'none';
    }, 4000);
</script>



@endpush

