@extends('layouts.app1')
@section('title', 'Bicentenario Bolivia / Videos')

@php
    function getYoutubeId($url) {
        preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|v\/))([^\&\?\/]+)/', $url, $matches);
        return $matches[1] ?? null;
    }
@endphp

@section('content')
    <div x-data="videoModal()" class="relative w-full h-screen bg-black pt-10">

        <!-- Swiper -->
        <div class="swiper mySwiper w-full h-full">
            <div class="swiper-wrapper h-full h-screen">
                @foreach($videos as $vid)
                <div class="swiper-slide relative w-full h-screen overflow-hidden cursor-pointer" @click="openCurrentSlideModal()">
                        <div class="absolute inset-0 z-0 w-full h-full relative">
                            <iframe
                                class="absolute top-0 left-0 w-full h-full object-cover"
                                src="https://www.youtube.com/embed/{{ getYoutubeId($vid->url) }}?autoplay=1&mute=1&loop=1&playlist={{ getYoutubeId($vid->url) }}"
                                frameborder="0"
                                allowfullscreen
                                allow="autoplay; encrypted-media">
                            </iframe>
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>
                    </div>
                @endforeach
            </div>

            <!-- Flechas -->
            <div class="swiper-button-next z-30"></div>
            <div class="swiper-button-prev z-30"></div>

            <!-- BOTÓN VER MÁS VIDEOS -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-30">
                <button
                    type="button"
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
                    <div class="w-full md:w-1/2 aspect-video md:aspect-auto md:h-auto p-2">
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
                        <p class="text-sm leading-relaxed">Lorem ipsum dolor sit amet...</p>
                    </div>
                </div>
            </div>
        </div>
    
    
            <!-- BOTÓN VER MÁS VIDEOS
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-30">
            <button
                type="button"
                @click="toggleGallery"
                class="bg-black text-white font-semibold py-2 px-5 rounded hover:bg-blue-700 transition shadow-lg">
                <template x-if="!mostrarGaleria">
                    <span>Todos los videos</span>
                </template>
                <template x-if="mostrarGaleria">
                    <span>Ocultar galería</span>
                </template>
            </button>
        </div> -->   
    


    <!-- GALERÍA DE VIDEOS -->
    <div
        x-show="mostrarGaleria"
        x-collapse
        x-transition:enter="transition-all duration-500 ease-in-out"
        x-transition:leave="transition-all duration-500 ease-in-out"
        id="videoGallery"
        class="overflow-hidden bg-gray-900 text-white py-2 mb-2">
        <div class="flex overflow-x-auto gap-4 px-4 pb-6">
            @foreach($videos as $video)
            @php
                $videoData = [
                    'youtubeId' => getYoutubeId($video->url),
                    'titulo' => $video->titulo,
                    'descripcion' => $video->descripcion,
                ];
            @endphp
                <div class="min-w-[320px] max-w-[320px] relative group rounded-lg overflow-hidden flex-shrink-0">
                    <!-- Imagen previa del video -->
                    <img src="https://img.youtube.com/vi/{{ getYoutubeId($video->url) }}/hqdefault.jpg"
                        alt="{{ $video->titulo }}"
                        class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-105">

                    <!-- Capa oscura al hacer hover -->
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-50 transition duration-300"></div>

                    <!-- Contenido centrado -->
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white px-3 text-center">
                        <h3 class="text-lg font-semibold mb-2">{{ $video->titulo }}</h3>
                        <button
                            @click='abrirModal({!! json_encode($videoData) !!})'
                            class="flex items-center gap-2 bg-white bg-opacity-50 px-3 py-2 rounded hover:bg-opacity-50 transition"
                        >
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
<div class="bg-white p-20  mt-10  max-w-xl mx-auto  ">

</div>

<!-- Sección para agregar nuevo video -->
    <div class="bg-gray-800 p-6 rounded-lg mt-10 max-w-xl mx-auto pt-9">
        <h2 class="text-2xl font-bold mb-4 text-white">Agregar nuevo video</h2>

        @if(session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

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

        // ✅ Versión actualizada: recibe un objeto video completo
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


@endpush
