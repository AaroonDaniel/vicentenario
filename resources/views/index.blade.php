<!-- resources/views/index.blade.php -->
@extends('layouts.principal')
@section('title', 'Vicentenario Bolivia')
@section('content')

    <!--PARTE LO ULTIMO -->

    <!--CONTENIDO DEL CUERPO DE LA PAGINA -->

    <section class="content ">

        <!-- Carrusel de lugares turísticos -->
        <div x-data="carousel()" x-init="start()" class="relative w-full h-[400px] sm:h-[500px] md:h-[600px] overflow-hidden">
            <template x-for="(lugar, index) in lugares" :key="index">
                <div x-show="current === index" 
                    x-transition:enter="transition-opacity duration-700" 
                    x-transition:enter-start="opacity-0" 
                    x-transition:enter-end="opacity-100" 
                    class="absolute inset-0 bg-cover bg-center"
                    :style="'background-image: url(/storage/lugares/' + lugar.imagen + ')'">
                    <div class="bg-black bg-opacity-50 h-full flex items-center justify-center">
                        <div class="text-white text-center p-4">
                            <h2 class="text-2xl sm:text-4xl font-bold" x-text="lugar.departamento"></h2>
                            <p class="text-md sm:text-xl mt-2" x-text="lugar.nombre_lugar"></p>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Flechas navegación -->
            <button @click="prev()" 
                    class="absolute left-0 top-1/2 transform -translate-y-1/2  bg-opacity-30 hover:bg-opacity-60 text-white text-3xl px-4 py-2 z-10">
                ❮
            </button>
            <button @click="next()" 
                    class="absolute right-0 top-1/2 transform -translate-y-1/2  bg-opacity-30 hover:bg-opacity-60 text-white text-3xl px-4 py-2 z-10">
                ❯
            </button>
        </div>


        <section class="principalnotes">
            <div class="boxnotes">
                <div style="width:90%;">
                    <h2 class="title_home">Lo último</h2>
                </div>
                @if($novedades->count())
                <div class="cuadricula">
                    @foreach($novedades as $novedad)
                        <a href="{{ route('novedades.show1', $novedad->id) }}" class="card">
                            <div class="headercard">
                                <img data-src="{{ asset('storage/' . $novedad->imagen) }}" alt="Imagen de {{ $novedad->titulo }}" 
                                src="{{ asset('storage/' . $novedad->imagen) }}"
                                    class="ready">
                            </div>
                            <div class="contentcard">
                                <div class="topinfo">
                                    <h2>Conoce: {{ $novedad->departamento }}</h2>
                                    <p class="hashtag"><i class="fas fa-map-marker-alt"></i>Bolivia</p>
                                </div>
                                <p class="notetitle">{{ $novedad->titulo }}</p>
                                <span class="notegeneral">
                                    {{ Str::limit($novedad->descripcion, 100) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                @else
                    <p class="text-gray-500">No hay novedades disponibles.</p>
                @endif
                
            </div>
        </section>


        <!--PARTE PUEBLOS MAGICOS -->
        <section class="ultimas">
            <section class="inner">
                <h2 class="title_home">Pueblos Mágicos</h2>
                <section class="scroll_notes">
                    <article>

                        <a href="#" class="especial">
                            <figure>
                                <img src="https://images.pexels.com/photos/11396013/pexels-photo-11396013.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2
                                "
                                    alt="Santa Cruz, Samaipata" title="comala-rulfo-fp " data-credit="Francisco Palma"
                                    data-alt="">
                            </figure>
                            <figcaption>
                                <b>Pueblos Mágicos</b>
                                <strong>Santa Cruz, Samaipata, ¿qué hacer en este Municipio Mágico?</strong>
                                <em><i class="fas fa-map-marker"></i> Samaipata</em>
                            </figcaption>
                        </a>

                        <a href="#"
                            class="especial">
                            <figure>
                                <img post-id="693" fifu-featured="1"
                                    src="https://i.pinimg.com/736x/55/df/27/55df27769bee522705cdbe3b1f039abe.jpg"
                                    alt="Coroico"
                                    title="Coroico" data-credit=""
                                    data-alt="Coroico">
                            </figure>
                            <figcaption>
                                <b>Pueblos Mágicos</b>
                                <strong>El pueblo de Coroico se encuentra enclavado en lo alto de las cordilleras de la provincia de Nor Yungas</strong>
                                <em><i class="fas fa-map-marker"></i>Coroico</em>
                            </figcaption>
                        </a>

                        <a href="#"
                            class="especial">
                            <figure>
                                <img src="https://www.ibolivia.org/wp-content/uploads/2019/08/parque-nacional-toro-toro.jpg"
                                    alt="Toro Toro" title="Toro Toro" data-credit="Diego L. Cuevas"
                                    data-alt="Toro Toro">
                            </figure>
                            <figcaption>
                                <b>Pueblos Mágicos</b>
                                <strong>Parque Nacional Toro Toro: ¿Qué se puede hacer y cómo llegar?</strong>
                                <em><i class="fas fa-map-marker"></i> Toro Toro</em>
                            </figcaption>
                        </a>
                    </article>
                </section>
            </section>
        </section>

        <!--PARTE GASTROMONIA -->

        <section class="ultimas">
            <section class="inner">
                <h2 class="title_home">Gastronomía</h2>
                <section class="scroll_notes">
                    <article>

                        <a href="#" class="especial">
                            <figure>
                                <img src="https://i.pinimg.com/736x/75/78/e7/7578e71c7245f487a2d7a37ea2cbf646.jpg"
                                    alt="Pique macho de Cochabamba" title="Pique macho de Cochabamba" data-credit="Flickr"
                                    data-alt="Pique macho de Cochabamba">
                            </figure>
                            <figcaption>
                                <b>Conoce Bolivia</b>
                                <strong>Pique macho de Cochabamba, manjar que debes probar</strong>
                                <em><i class="fas fa-map-marker"></i> Cochabamba</em>
                            </figcaption>
                        </a>
                        <a href="#" class="especial">
                            <figure>
                                <img src="https://i.pinimg.com/736x/71/38/f5/7138f594579a706bab8b17184f591d8b.jpg"
                                    alt="Sopa de mani" title="Sopa de mani "
                                    data-credit="Sopa de mani" data-alt="">
                            </figure>
                            <figcaption>
                                <b>Conoce Bolivia</b>
                                <strong>Sopa de mani: un plato muy tradicional de Bolivia</strong>
                                <em><i class="fas fa-map-marker"></i> Chuqisaca</em>
                            </figcaption>
                        </a>
                        <a href="#" class="especial">
                            <figure>
                                <img src="https://www.pub.eldiario.net/noticias/2016/2016_09/nt160920/f_2016-09-20_89.jpg"
                                    alt="Salteña" title="Salteña de Bolivia"
                                    data-credit="Salteña" data-alt="">
                            </figure>
                            <figcaption>
                                <strong>Salteña de Bolivia: son empanadas de origen boliviano, populares en el occidente del pais</strong>
                                <em><i class="fas fa-map-marker"></i> Bolivia</em>
                            </figcaption>
                        </a>
                    </article>
                </section>
            </section>
        </section>

        <!--PARTE ECOTURISMO Y AVENTURA -->

        <section class="ultimas">
            <section class="inner">
                <h2 class="title_home">Ecoturismo y aventura</h2>
                <section class="scroll_notes">
                    <article>

                        <a href="#" class="especial">
                            <figure>
                                <img src="https://boliviatravelsite.com/Images/Attractionphotos/villa-tunari-private-tour-02.jpg"
                                    alt="Villa Tunari" title="carrusellaberinto " data-credit="Villa Tunari"
                                    data-alt="">
                            </figure>
                            <figcaption>
                                <b>Ecoturismo y aventura</b>
                                <strong>Villa Tunari, es una localidad turística de la provincia de Chapare</strong>
                                <em><i class="fas fa-map-marker"></i>Cochabamba</em>
                            </figcaption>
                        </a>
                        <a href="#"
                            class="especial">
                            <figure>
                                <img src="https://images.pexels.com/photos/21637495/pexels-photo-21637495/free-photo-of-coches-punto-de-referencia-viaje-viajar.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
                                    alt="Salar de Uyuni" title="CONANP_1600 " data-credit="CONANP"
                                    data-alt="">
                            </figure>
                            <figcaption>
                                <b>Conoce Bolivia</b>
                                <strong>Salar de Uyuni: Desierto de sal</strong>
                                <em><i class="fas fa-map-marker"></i>Potosi</em>
                            </figcaption>
                        </a>
                        <a href="#"
                            class="especial">
                            <figure>
                                <img src="https://estaticos-cdn.prensaiberica.es/clip/285aba65-fca1-44ea-8ab3-7415130b72e6_original-libre-aspect-ratio_default_0.jpg"
                                    alt="Lago Titicaca" title="cenote-ik-kil-01 "
                                    data-credit="chichenitza.com" data-alt="">
                            </figure>
                            <figcaption>
                                <b>Conoce Bolivia</b>
                                <strong>Aventura en el Titicaca, el lago más alto del mundo</strong>
                                <em><i class="fas fa-map-marker"></i>La paz</em>
                            </figcaption>
                        </a>
                    </article>
                </section>
            </section>
        </section>


        <!-- Seccion de MENU DESPLAZAMIENTO DE EVENTOS DE GUIAS TURISTICAS DE VIAJE  -->
        <section class="especiales_home">
            <figure class="cover" style="background-image: url('{{ asset('images/fondo.jpg') }}') !important;">
            </figure>

            <section class="inner">
                <h2 class="nice white">Eventos del Bicentenario</h2>
                <section class="scroll_notes apps">
                    <article>
                        @forelse ($eventos as $evento)
                            
                                <a href="{{ 'eventos' }}" class="especial" rel="noopener">
                                    <figure>
                                        <img 
                                            src="{{ $evento->imagen_ruta ? asset('storage/' . $evento->imagen_ruta) : asset('images/default.jpg') }}"
                                            alt="{{ $evento->nombre }}"
                                            title="{{ $evento->nombre }}"
                                            class="ready"
                                        >
                                    </figure>
                                    <figcaption>
                                        <b>{{ $evento->nombre }}</b>
                                        <strong>{{ $evento->departamento }}</strong>
                                    </figcaption>
                                </a>
                        @empty
                            <p class="text-white">No hay eventos disponibles.</p>
                        @endforelse

                    </article>
                </section>

            </section>
        </section>

        <section class="especiales_home">
            <figure class="cover" style="background-image: url('{{ asset('images/fondo.jpg') }}') !important;">
            </figure>

            <section class="inner">
                <h2 class="nice white">Galeria del las actividades del Bicentenario</h2>
                <section class="scroll_notes apps">
                    <article>
                        @forelse ($galerias as $item)
                            
                                <a href="{{ route('galeria.show', $item->id) }}" class="especial" rel="noopener">
                                    <figure>
                                        <img 
                                            src="{{ $item->imagen ? asset('storage/' . $item->imagen) : asset('images/default.jpg') }}" 
                                            alt="{{ $item->titulo }}" 
                                            class="w-full h-64 object-cover"
                                        >
                                    </figure>
                                    <figcaption>
                                        <b>{{ $item->titulo }}</b>
                                    </figcaption>
                                </a>
                        @empty
                            <p class="col-span-3 text-center text-gray-600">No hay imágenes en la galería.</p>
                        @endforelse

                    </article>
                </section>

            </section>
        </section>

        <!-- Seccion de videos -->
        <section class="videos_home">
            <section class="inner">
                <article class="video_top">

                    <h3>Videos</h3>
                    <p>Video más visto</p>
                    <a href="https://www.mexicodesconocido.com.mx/visita-la-ciudad-puebla.html">
                        <strong>Visita Bolivia</strong>
                        <span>Descubre las joyas ocultas de Bolivia en este recorrido imperdible por algunos de sus destinos más sorprendentes</span>
                    </a>
                    <br>
                    <a href="{{ 'videos' }}" class="btn terciary"><i class="fas fa-play"></i> Ver todos los
                        videos</a>
                </article>
                <section class="player">
                    <figure
                        data-video="<iframe title=&quot;Ciudad de Puebla&quot; width=&quot;640&quot; height=&quot;360&quot; src=&quot;https://www.youtube.com/embed/56U-OdXF9eQ?si=l2VOY8NP2rh0Mk0B&quot; frameborder=&quot;0&quot; allow=&quot;accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share&quot; referrerpolicy=&quot;strict-origin-when-cross-origin&quot; allowfullscreen></iframe>">
                        <img data-src="https://i.pinimg.com/736x/82/c5/3c/82c53c33ab3eaf32ece746687072a9c1.jpg"
                            alt="Visita la Ciudad de Puebla"
                            src="https://i.pinimg.com/736x/82/c5/3c/82c53c33ab3eaf32ece746687072a9c1.jpg"
                            class="ready">
                        <a href="#video">
                            <i class="fas fa-play"></i>
                        </a>
                    </figure>
                </section>
            </section>
        </section>

        
        
    </section>
    <!--content-->
@endsection

@push('scripts')
    <script>
        function carousel() {
            return {
                current: 0,
                interval: null,
                lugares: [
                    { departamento: 'La Paz', nombre_lugar: 'Plaza Murillo', imagen: 'la_paz_titicaca.jpg' },
                    { departamento: 'Santa Cruz', nombre_lugar: 'Catedral de San Lorenzo', imagen: 'Santa-Cruz_catedral.jpg' },
                    { departamento: 'Cochabamba', nombre_lugar: 'Cristo de la Concordia', imagen: 'Cochabamba_Cristo.avif' },
                    { departamento: 'Potosí', nombre_lugar: 'Ciudad de Potosi, Iglesia San Francisco', imagen: 'Potosi_San_Francisco.avif' },
                    { departamento: 'Oruro', nombre_lugar: 'Ciudad de Oruro', imagen: 'oruro.jpg' },
                    { departamento: 'Chuquisaca', nombre_lugar: 'Catedral de Sucre', imagen: 'Sucre_catedral.avif' },
                    { departamento: 'Tarija', nombre_lugar: 'Castillo azul', imagen: 'tarija_castillo_azul.jpg' },
                    { departamento: 'Beni', nombre_lugar: 'Rurrenabaque, orillas de la Amazonía', imagen: 'beni_amazonia.jpg' },
                    { departamento: 'Pando', nombre_lugar: 'Parque piñata', imagen: 'cobija_parque.jpg' }
                ],
                start() {
                    this.interval = setInterval(() => {
                        this.next();
                    }, 5000);
                },
                next() {
                    this.current = (this.current + 1) % this.lugares.length;
                },
                prev() {
                    this.current = (this.current - 1 + this.lugares.length) % this.lugares.length;
                }
            }
        }
    </script>
@endpush
