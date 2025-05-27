@extends('layouts.app1')
@section('title', 'Bicentenario Bolivia / Videos')

@php
    use App\Helpers\VideoHelper;
@endphp

@section('content')

    <div x-data="videoModal()" class="relative w-full h-screen bg-black pt-10 ">
        <!-- Swiper -->
        <div class="swiper mySwiper w-full h-full">
            <div class="swiper-wrapper h-full">
                @foreach($videos as $vid)
                <div class="swiper-slide relative w-full h-screen overflow-hidden cursor-pointer" @click="openCurrentSlideModal()">
                    <div class="absolute inset-0 z-0 w-full h-full relative">
                        <iframe
                            class="absolute top-0 left-0 w-full h-full object-cover"
                            src="https://www.youtube.com/embed/{{ VideoHelper::getYoutubeId($vid->url) }}?autoplay=1&mute=1&loop=1&playlist={{ VideoHelper::getYoutubeId($vid->url) }}"
                            frameborder="0"
                            allowfullscreen
                            allow="autoplay; encrypted-media">
                        </iframe>
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>
                </div>
                @endforeach
            </div>

            <div class="swiper-button-next z-30"></div>
            <div class="swiper-button-prev z-30"></div>

            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-30">
                <button
                    @click="toggleGallery"
                    class="bg-black text-white font-semibold py-2 px-5 rounded hover:bg-blue-700 transition shadow-lg">
                    <template x-if="!mostrarGaleria">
                        <span>Todos los videos</span>
                    </template>
                    <template x-if="mostrarGaleria">
                        <span>Ocultar galería</span>
                    </template>
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div x-show="show" x-transition class="fixed inset-0 z-50 bg-black bg-opacity-50 overflow-y-auto">
            <div class="min-h-screen flex items-center justify-center p-4">
                <button @click="closeModal()" class="absolute top-4 right-6 text-white text-3xl z-50">&times;</button>
                <div class="w-full max-w-7xl bg-black text-white rounded-lg shadow-lg overflow-hidden flex flex-col md:flex-row border border-[rgb(0, 255, 217)] max-h-[90vh]">
                    <div class="w-full md:w-1/2 aspect-video md:h-auto p-2">
                        <iframe
                            class="w-full h-full"
                            :src="`https://www.youtube.com/embed/${video.youtubeId}`"
                            frameborder="0"
                            allow="autoplay; encrypted-media"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="w-full md:w-1/2 p-6 overflow-y-auto max-h-[90vh] relative">
                        <h2 class="text-3xl font-bold mb-4 sticky top-0 z-10" x-text="video.titulo"></h2>
                        <p class="text-lg mb-6" x-text="video.descripcion"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- GALERÍA DE VIDEOS -->
        <div x-show="mostrarGaleria" x-collapse x-transition id="videoGallery" class="overflow-hidden bg-gray-900 text-white py-2 mb-2">
            <div class="flex overflow-x-auto gap-4 px-4 pb-6">
                @foreach($videos as $video)
                    @php
                        $videoData = [
                            'youtubeId' => VideoHelper::getYoutubeId($video->url),
                            'titulo' => $video->titulo,
                            'descripcion' => $video->descripcion,
                        ];
                    @endphp
                    <div class="min-w-[320px] max-w-[320px] relative group rounded-lg overflow-hidden flex-shrink-0">
                        <img src="https://img.youtube.com/vi/{{ VideoHelper::getYoutubeId($video->url) }}/hqdefault.jpg"
                            alt="{{ $video->titulo }}"
                            class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-50 transition duration-300"></div>
                        <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-3 text-center">
                            <h3 class="text-lg font-semibold mb-2">{{ $video->titulo }}</h3>
                            <button
                                @click='abrirModal(@json($videoData))'
                                x-data
                                class="flex items-center gap-2 bg-white bg-opacity-50 px-3 py-2 rounded hover:bg-opacity-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-white" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                <span class="text-sm font-medium text-black">Reproducir video</span>
                            </button>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="w-full bg-gray-100" style="height: 5cm;">  </div>


    <!-- FORMULARIO CRUD -->
    <section class=" bg-white">
        <div>
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Listado de Videos</h1>
                    <button onclick="abrirModal('modalNuevo')" 
                        class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">+ Nuevo
                    </button>
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
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">TÍTULO</th>
                                <th class="px-4 py-2">EVENTO</th>
                                <th class="px-4 py-2">DESCRIPCIÓN</th>
                                <th class="px-4 py-2">URL</th>
                                <th class="px-4 py-2">IMAGEN</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-2">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $video->id }}</td>
                                    <td class="px-4 py-2">{{ $video->titulo }}</td>
                                    <td class="px-4 py-2">{{ $video->evento->nombre ?? 'Sin evento' }}</td>
                                    <td class="px-4 py-2">{{ $video->descripcion }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ $video->url }}" class="text-blue-600 underline" target="_blank">Ver video</a>
                                    </td>
                                    <td class="px-4 py-2">
                                        @php
                                            $youtubeId = null;
                                            if (preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11})/', $video->url, $matches)) {
                                                $youtubeId = $matches[1];
                                            }
                                        @endphp
                                        @if ($youtubeId)
                                            <img src="https://img.youtube.com/vi/{{ $youtubeId }}/mqdefault.jpg" alt="Miniatura" class="w-24 rounded">
                                        @else
                                            <span class="italic text-gray-500">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $video->created_at->format('Y-m-d') }}</td>

                                    <td class="px-4 py-2 flex space-x-2">
                                        {{-- Botón para ver --}}
                                        <button onclick="mostrarDetalles({{ $video->id }})"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- Editar --}}


                                        <button
                                            onclick="openEditModal({
                                                id: '{{ $video->id }}',
                                                evento_id:'{{ $video->evento_id }}',
                                                titulo: '{{ addslashes($video->titulo) }}',
                                                url: '{{ addslashes($video->url) }}',
                                                descripcion: '{{ addslashes($video->descripcion) }}',
                                                fecha: '{{ $video->created_at }}'
                                            })"
                                            class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Eliminar --}}
                                        <button
                                            onclick="confirmarEliminar({{ $video->id }}, '{{ $video->titulo }}')"
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
                        <i class="fas fa-user-edit mr-2"></i>Editar Video
                    </h2>

                    <form id="editForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" id="form-id">

                        <div class="mb-4">
                            <label class="block font-semibold">Evento</label>
                            <select name="evento_id" id="form-evento"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                                @foreach ($eventos as $evento)
                                    <option value="{{ $evento->evento_id }}">
                                        {{ $evento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Título</label>
                            <input type="text" name="titulo" id="form-titulo"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>
                        <div class="mb-4">
                            <label class="block font-semibold">Url</label>
                            <input type="text" name="url" id="form-url"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Descripción</label>
                            <textarea name="descripcion" id="form-descripcion" class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Fecha</label>
                            <input type="text" name="fecha" id="form-fecha"
                                class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2" required>
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="closeEditModal()"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cerrar</button>
                            <button type="submit" name="submit"
                                class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Editar video</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal VER DETALLES -->
            <div id="verVideoModal"  class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                
                <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <div class="flex justify-between items-center border-b pb-2 mb-2">
                        <h2 class="text-lg font-bold text-black-700 mb-4">
                            <i class="fas fa-info-circle"></i> Detalles del video
                        </h2>
                        <button onclick="cerrarModalVer()"
                            class="text-gray-600 hover:text-red-600 text-lg">&times;
                        </button>
                    </div>

                    <div>
                        <div class="mb-2">
                            <strong>Evento:</strong>
                            <div id="ver-evento" class="text-gray-600"></div>
                        </div>
                        <div class="mb-2">
                            <strong>Título:</strong>
                            <div id="ver-titulo" class="text-gray-600"></div>
                        </div>
                        <div class="mb-2">
                            <strong>Url:</strong>
                            <div id="ver-url" class="text-gray-600"></div>
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

                        <!--
                        <div class="mt-4">
                            <strong>Imagen:</strong>
                            <div>
                                @php
                                    $youtubeId = null;
                                    if (preg_match('/(?:v=|\/)([0-9A-Za-z_-]{11})/', $video->url, $matches)) {
                                        $youtubeId = $matches[1];
                                    }
                                @endphp
                                @if ($youtubeId)
                                    <img src="https://img.youtube.com/vi/{{ $youtubeId }}/mqdefault.jpg" alt="Miniatura" class="w-24 rounded">
                                @else
                                    <span class="italic text-gray-500">Sin imagen</span>
                                @endif
                            </div>
                        </div>-->
                    </div>

                    <div class="flex justify-end mt-4">
                        <button onclick="cerrarModalVer()"
                            class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">
                            OK
                        </button>
                    </div>
                </div>                
            </div>

            <!-- Modal de Confirmación Eliminar Video -->
            <div id="eliminarVideoModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-bold text-black-600"><i class="fas fa-trash-alt"></i> Eliminar
                                Video</h2>
                            <button onclick="cerrarModalEliminar()"
                                class="text-gray-600 hover:text-black-600 text-lg">&times;</button>
                        </div>

                        <p class="text-gray-800 mb-4">¿Estás seguro que deseas eliminar el video <span
                                id="tituloVideoEliminar" class="font-semibold text-black-600"></span>?</p>

                        <form id="formEliminarVideo" method="POST">
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
                <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh]">
                    <button onclick="cerrarModal('modalNuevo')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                    <h2 class="text-lg font-bold text-black mb-4">
                        <i class="fas fa-plus-circle mr-2"></i>Agregar nuevo video
                    </h2>

                    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-semibold mb-1"> Evento</label>
                            <select name="evento_id" class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2" requerid>
                                <option value="">-- Selecciona un evento --</option>
                                @foreach ($eventos as $evento)
                                    <option value="{{ $evento->id_evento}}"                                        
                                        {{ old('evento_id') == $evento->id_evento ? 'selected' : '' }}>
                                        {{ $evento->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Título</label>
                            <input type="text" name="titulo" required class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">URL</label>
                            <input type="text" name="url" required class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Descripción</label>
                            <textarea name="descripcion" required class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2"></textarea>
                        </div>
                        <!--
                        <div class="mb-4">
                            <label class="block font-semibold">Fecha</label>
                            <input type="date" name="fecha" class="w-full bg-gray-200 border border-red-100 rounded px-3 py-2">
                        </div>-->

                        <!-- Imagen opcional en un futuro -->
                        <!--
                        <div class="mb-4">
                            <label class="block font-semibold">Imagen (opcional)</label>
                            <input type="file" name="imagen" accept="image/*"
                                class="w-full bg-white border border-gray-300 rounded px-3 py-2">
                        </div>
                        -->

                        <div class="flex justify-end gap-2">
                            <button type="button" onclick="cerrarModal('modalNuevo')"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</button>
                            <button type="submit"
                                class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Guardar Video</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
    </section>
@endsection

@push('scripts')

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('videoModal', () => ({
            show: false,
            mostrarGaleria: false,
            video: {
                titulo: '',
                descripcion: '',
                youtubeId: ''
            },
            videos: @json($videos),
            swiper: null,

            init() {
                this.swiper = new Swiper('.mySwiper', {
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    }
                });
            },

            openCurrentSlideModal() {
                const index = this.swiper.activeIndex;
                const current = this.videos[index];
                this.video = {
                    titulo: current.titulo,
                    descripcion: current.descripcion,
                    youtubeId: this.getYoutubeId(current.url),
                };
                this.show = true;
                document.body.classList.add('overflow-hidden');
            },

            abrirModal(videoObj) {
                this.video = {
                    youtubeId: videoObj.youtubeId,
                    titulo: videoObj.titulo,
                    descripcion: videoObj.descripcion
                };
                this.show = true;
                document.body.classList.add('overflow-hidden');
            },

            closeModal() {
                this.show = false;
                document.body.classList.remove('overflow-hidden');
                this.$nextTick(() => {
                    const iframe = document.querySelector('[x-show="show"] iframe');
                    if (iframe) {
                        const src = iframe.src;
                        iframe.src = '';
                        iframe.src = src;
                    }
                });
            },

            getYoutubeId(url) {
                const match = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([^\&\?\/]+)/);
                return match ? match[1] : '';
            },

            toggleGallery() {
                this.mostrarGaleria = !this.mostrarGaleria;
                this.$nextTick(() => {
                    if (this.mostrarGaleria) {
                        const section = document.getElementById('videoGallery');
                        if (section) {
                            section.scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                });
            }
        }));
    });
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
    <!-- editar-->
    <script>
        function openEditModal(data) {
            document.getElementById('form-id').value = data.id;
            document.getElementById('form-titulo').value = data.titulo;
            document.getElementById('form-url').value = data.url;
            document.getElementById('form-descripcion').value = data.descripcion;
            document.getElementById('form-fecha').value = data.fecha;

            document.getElementById('form-evento').value = data.evento_id;

            const eventoSelect = document.getElementById('form-evento');
            if (eventoSelect) {
                for (let i = 0; i < eventoSelect.options.length; i++) {
                    if (eventoSelect.options[i].value == data.evento_id) {
                        eventoSelect.options[i].selected = true;
                        break;
                    }
                }
            }



            // Establecer acción del formulario
            const form = document.getElementById('editForm');
            form.action = `/videos/${data.id}`;

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
                url: `/videos/${id}`,
                method: 'GET',
                success: function(data) {
                    // Rellenar campos
                    $('#ver-evento').text(data.nombre);
                    $('#ver-titulo').text(data.titulo); 
                    $('#ver-url').text(data.url);
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
                   // const imagenRuta = data.imagen ? `/storage/${data.imagen}` : '/default.jpg';
                   // $('#ver-imagen').attr('src', imagenRuta);

                    // Mostrar modal
                    $('#verVideoModal').removeClass('hidden');
                },
                error: function() {
                    alert('No se pudo cargar la información.');
                }
            });
        }

        function cerrarModalVer() {
            $('#verVideoModal').addClass('hidden');
        }
    </script>

    <!-- ELIMINAR-->
    <script>
        function confirmarEliminar(id, titulo) {
            $('#formEliminarVideo').attr('action', `/videos/${id}`);
            $('#tituloVideoEliminar').text(titulo);
            $('#eliminarVideoModal').removeClass('hidden');
        }

        function cerrarModalEliminar() {
            $('#eliminarVideoModal').addClass('hidden');
            $('#formEliminarVideo').attr('action', '');
            $('#tituloVideoEliminar').text('');
        }

        // Opción AJAX (si no deseas recargar)
        $('#formEliminarVideo').on('submit', function(e) {
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
                    alert('Error al eliminar el video.');
                }
            });
        });
    </script>


@endpush