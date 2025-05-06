@extends('layouts.app1')
@section('title', 'Bicentenario Bolivia / Videos')

@php
    function getYoutubeId($url) {
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([^\&\?\/]+)/', $url, $matches);
        return $matches[1] ?? null;
    }
@endphp

@section('content')
    <div x-data="videoModal()" class="relative w-full h-screen bg-pink-900">
        <!-- Swiper -->
        <div class="swiper mySwiper w-full h-screen">
            <div class="swiper-wrapper h-full h-screen">
                @foreach($videos as $vid)
                    <div class="swiper-slide relative w-full h-screen ">
                        <!-- Contenedor absoluto del video -->
                        <div class="absolute inset-0 z-0   h-screen ">
                            <iframe
                                class="w-full h-full"
                                src="https://www.youtube.com/embed/{{ getYoutubeId($vid->url) }}?autoplay=1&mute=1&loop=1&playlist={{ getYoutubeId($vid->url) }}"
                                frameborder="0"
                                allowfullscreen
                                allow="autoplay; encrypted-media">
                            </iframe>
                        </div>

                        <!-- Capa oscura -->
                        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

                        <!-- Botón central -->
                        <div class="absolute inset-0 flex items-center justify-center z-20">
                            <button
                                @click="openModal({ titulo: '{{ addslashes($vid->titulo) }}', descripcion: `{{ addslashes($vid->descripcion) }}`, youtubeId: '{{ getYoutubeId($vid->url) }}' })"
                                class="bg-white text-black font-bold py-3 px-6 rounded-lg hover:bg-gray-300 transition">
                                Ver video
                            </button>
                        </div>

                        <!-- Botón inferior -->
                        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20">
                            <a href="#"
                                class="bg-blue-600 text-white font-semibold py-2 px-5 rounded hover:bg-blue-700 transition">
                                Ver más videos
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Flechas -->
            <div class="swiper-button-next z-30"></div>
            <div class="swiper-button-prev z-30"></div>
        </div>


        <!-- Modal -->
        <div x-show="show" x-transition class="fixed inset-0 bg-pink bg-opacity-90 z-50 flex items-center justify-center px-4 py-10">
            <div class="bg-pink-800 text-white max-w-4xl w-full p-6 relative space-y-4">
                <!-- Botón cerrar -->
                <button @click="closeModal()" class="absolute top-2 right-4 text-3xl text-white">&times;</button>

                <!-- Video -->
                <iframe
                    class="w-full h-64 md:h-96"
                    :src="`https://www.youtube.com/embed/${video.youtubeId}`"
                    frameborder="0"
                    allowfullscreen>
                </iframe>

                <!-- Información -->
                <h2 class="text-2xl font-bold" x-text="video.titulo"></h2>
                <p class="text-white text-sm" x-text="video.descripcion"></p>
            </div>
        </div>

    </div>

    <!-- para mas videos -->
<div class="bg-gray text-white min-h-screen p-6">
    <!-- Carrusel de videos -->
    <div class="flex overflow-x-auto gap-4 pb-6">
        @foreach($videos as $video)
            <div class="min-w-[320px] max-w-[320px] bg-black rounded shadow-lg overflow-hidden flex-shrink-0">
                <div class="aspect-video">
                    <iframe
                        class="w-full h-full"
                        src="https://www.youtube.com/embed/{{ getYoutubeId($video->url) }}"
                        frameborder="0"
                        allowfullscreen
                    ></iframe>
                </div>
                <div class="p-3">
                    <h3 class="font-semibold text-lg text-white">{{ $video->titulo }}</h3>
                    <p class="text-gray-400 text-sm">{{ $video->descripcion }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Formulario para agregar nuevos videos -->
<div class="bg-gray-800 p-6 rounded-lg mt-10 max-w-xl mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-white">Agregar nuevo video</h2>

    <form action="{{ route('videos.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="titulo" class="block text-sm font-medium text-white">Título</label>
            <input type="text" name="titulo" id="titulo" required
                class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="url" class="block text-sm font-medium text-white">URL de YouTube</label>
            <input type="url" name="url" id="url" required
                class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500"
                placeholder="https://www.youtube.com/watch?v=xxxx">
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-white">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="3" required
                    class="mt-1 block w-full rounded-md bg-gray-700 text-white border-gray-600 focus:ring-blue-500 focus:border-blue-500"></textarea>
        </div>

        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            Guardar video
        </button>
    </form>
</div>
@endsection

@push('scripts')



<!-- Alpine.js data -->
<script>
    function videoModal() {
        return {
            show: false,
            video: {
                titulo: '',
                descripcion: '',
                youtubeId: ''
            },
            openModal(data) {
                this.video = data;
                this.show = true;
                document.body.classList.add('overflow-hidden');
            },
            closeModal() {
                this.show = false;
                document.body.classList.remove('overflow-hidden');
            }
        }
    }
</script>
@endpush
