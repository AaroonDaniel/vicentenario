@extends('layouts.principal')

@section('content')
<div x-data="modalEdit()">

    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Listado de Culturas</h1>
            <button onclick="abrirModal('modalNuevo')" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">+ Nuevo</button>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto table-responsive">
            <table id="funcionesTable" class="min-w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Historia</th>
                        <th class="px-4 py-3">Nombre</th>
                        <th class="px-4 py-3">Tipo</th>
                        <th class="px-4 py-3">Origen</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($culturas as $cultura)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $cultura->id_cultura }}</td>
                            <td class="px-4 py-2">{{ optional($cultura->historia)->titulo ?? 'Sin historia' }}</td>
                            <td class="px-4 py-2">{{ $cultura->nombre }}</td>
                            <td class="px-4 py-2">{{ $cultura->tipo }}</td>
                            <td class="px-4 py-2">{{ $cultura->origen }}</td>
                            <td class="px-4 py-2">{{ $cultura->created_at }}</td>
                            
                            <td class="px-4 py-2 flex space-x-2">
                                {{-- Ver --}}

                                <button onclick="mostrarDetalles({{ $cultura->id_cultura }})" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </button>

                                {{-- Editar --}}
                                <button 
                                    @click="openEditModal({ 
                                        id: '{{ $cultura->id_cultura }}', 
                                        historia: '{{ optional($cultura->historia)->titulo }}', 
                                        nombre: '{{ $cultura->nombre }}', 
                                        tipo: '{{ $cultura->tipo }}', 
                                        origen: '{{ $cultura->origen }}', 
                                        fecha: '{{ $cultura->created_at }}' 
                                    })"
                                    class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </button>

                                {{-- Eliminar --}}
                                <button onclick="confirmarEliminar({{ $cultura->id_cultura }}, '{{ $cultura->nombre }}')" class="text-red-600 hover:text-red-800">
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
    <div 
        x-show="show" 
        x-transition 
        x-cloak
        class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative">
            <button @click="close" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>

            <h2 class="text-lg font-bold text-black-700 mb-4"><i class="fas fa-user-edit mr-2"></i>Editar Cultura</h2>

            <form :action="'/culturas/' + form.id" method="POST" @submit="show = false">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-semibold">Historia</label>
                    <input type="text" name="historia" x-model="form.historia" class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2">
                    
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Nombre</label>
                    <input type="text" name="nombre" x-model="form.nombre"class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Tipo</label>
                    <input type="text" name="tipo" x-model="form.tipo" class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2" >
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Origen</label>
                    <input type="text" name="origen" x-model="form.origen" class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold">Fecha</label>
                    <input type="text" name="fecha" x-model="form.fecha" class="w-full bg-gray-200 border-3 border-red-100 rounded px-3 py-2" >
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" @click="close" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cerrar</button>
                    <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Editar cultura</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal VER DETALLES -->
    <div id="verCulturaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">

        <div class="flex justify-between items-center border-b pb-2 mb-2">

            <h2 class="text-lg font-bold text-black-700 mb-4"><i class="fas fa-info-circle"></i> Detalles de la cultura</h2>
            <button onclick="cerrarModalVer()" class="text-gray-600 hover:text-red-600 text-lg">&times;</button>
        </div>

        <div >
            <div >
            <strong >Nombre:</strong>
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
            <strong>Historia relacionada:</strong>
            <div id="ver-historia" class="text-gray-600"></div>
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
            <button onclick="cerrarModalVer()" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">
            OK
            </button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal de Confirmación Eliminar Cultura -->
    <div id="eliminarCulturaModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h2 class="text-lg font-bold text-black-600"><i class="fas fa-trash-alt"></i> Eliminar Cultura</h2>
            <button onclick="cerrarModalEliminar()" class="text-gray-600 hover:text-black-600 text-lg">&times;</button>
        </div> 

        <p class="text-gray-800 mb-4">¿Estás seguro que deseas eliminar la cultura <span id="nombreCulturaEliminar" class="font-semibold text-black-600"></span>?</p>

        <form id="formEliminarCultura" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end space-x-2">
            <button type="button" onclick="cerrarModalEliminar()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancelar</button>
            <button type="submit" class="bg-pink-600 hover:bg-black-700 text-white px-4 py-2 rounded">Eliminar</button>
            </div>
        </form>
        </div>
    </div>
    </div>

    <!-- Modal NUEVO -->
    <div id="modalNuevo" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
        <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
            <button onclick="cerrarModal('modalNuevo')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
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
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Descripcion</label>
                    <input type="text" name="descripcion" value="{{ old('descripcion') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Tipo</label>
                    <input type="text" name="tipo" value="{{ old('tipo') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Origen</label>
                    <input type="text" name="origen" value="{{ old('origen') }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection

<!-- Scripts MODALS-->
@push('scripts')

    <!-- editar-->
    <script>
        function modalEdit() {
            return {
                show: false,
                form: {
                    id: '',
                    historia: '',
                    nombre: '',
                    tipo: '',
                    origen: '',
                    fecha: '',
                },
                openEditModal(data) {
                    this.form = { ...data };
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
                url: `/culturas/${id}`,
                method: 'GET',
                success: function(data) {
                    $('#ver-nombre').text(data.nombre);
                    $('#ver-tipo').text(data.tipo);
                    $('#ver-origen').text(data.origen);
                    $('#ver-descripcion').text(data.descripcion || 'No disponible');
                    $('#ver-historia').text(data.historia?.titulo ?? 'Sin historia');
                    $('#ver-fecha-creacion').text(new Date(data.created_at).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' }));
                    $('#ver-fecha-actualizacion').text(new Date(data.updated_at).toLocaleDateString('es-ES', { year: 'numeric', month: 'long', day: 'numeric' }));
                    $('#verCulturaModal').removeClass('hidden');
                },
                error: function() {
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




