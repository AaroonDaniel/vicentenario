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
                <div class="cuadricula">
                    <a href="{{ 'ultimo1' }}" class="card">
                        <div class="headercard">
                            <img data-src="https://pxcdn.reduno.com.bo/reduno/042024/1712922753923.webp?cw=800&ch=450&extw=jpg"
                                alt="Día del Niño en Bolivia:"
                                src="https://pxcdn.reduno.com.bo/reduno/042024/1712922753923.webp?cw=800&ch=450&extw=jpg"
                                class="ready">
                        </div>
                        <div class="contentcard">
                            <div class="topinfo">
                                <h2>Conoce Bolivia</h2>
                                <p class="hashtag"><i class="fas fa-map-marker-alt"></i>Bolivia</p>
                            </div>
                            <p class="notetitle">Día del Niño en Bolivia</p>
                            <span class="notegeneral">En Bolivia, el Día del Niño se celebra cada 12 de abril. Es una fecha dedicada a homenajear y reflexionar sobre los derechos,
                                la protección y el bienestar de la niñez en el país.
                            </span>
                        </div>
                    </a>

                    <a href="{{ 'ultimo1' }}" class="card">
                        <div class="headercard">
                            <img post-id="5250" fifu-featured="1"
                                data-src="https://cdn.bolivia.com/sdi/2025/04/16/todo-lo-que-necesitas-para-la-peregrinacion-a-copacabana-en-semana-santa-1282133.jpg"
                                alt="copacabana La paz" title="copacabana La paz"
                                src="https://cdn.bolivia.com/sdi/2025/04/16/todo-lo-que-necesitas-para-la-peregrinacion-a-copacabana-en-semana-santa-1282133.jpg"
                                class="ready">
                        </div>
                        <div class="contentcard">
                            <div class="topinfo">
                                <h2>Pueblos Mágicos</h2>
                                <p class="hashtag"><i class="fas fa-map-marker-alt"></i>Copacabana</p>
                            </div>
                            <p class="notetitle">Copacabana, La paz</p>
                            <span class="notegeneral">Miles de personas acuden a la peregrinación hasta Copacabana. Esta ciudad turística recibirá este año a 25.000 visitantes.</span>
                        </div>
                    </a>

                    <a href="{{ 'ultimo1' }}" class="card">
                        <div class="headercard">
                            <img data-src="https://abi.bo/images//nube/2021/10oct/FestivalNacionalTarqueadaBolivia27/3.jpg"
                                alt="La «Tarqueada» Más grande Del Mundo"
                                src="https://abi.bo/images//nube/2021/10oct/FestivalNacionalTarqueadaBolivia27/3.jpg"
                                class="ready">
                        </div>
                        <div class="contentcard">
                            <div class="topinfo">
                                <h2>Danza del altiplano</h2>
                                <p class="hashtag"><i class="fas fa-map-marker-alt"></i>Bolivia</p>
                            </div>
                            <p class="notetitle">La «Tarqueada» Más grande Del Mundo
                            </p>
                            <span class="notegeneral">¡Festejemos el Bicentenario a lo grande!
                            Se parte de un hito histórico, únete a La Tarqueada Más grande Del Mundo.</span>
                        </div>
                    </a>

                    <a href="{{ 'ultimo1' }}"
                        class="card">
                        <div class="headercard">
                            <img data-src="https://scontent-lim1-1.xx.fbcdn.net/v/t39.30808-6/492041672_1421471329289412_2318168045478537980_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_ohc=OdMVwgEOP98Q7kNvwG5ci0q&_nc_oc=Adm4gNvx_EhyC2CRIIXPprdAL7uZ_iBGDqjNcsUzUnVMYw9CrE-G4yfHyLqCyc9eo3U&_nc_zt=23&_nc_ht=scontent-lim1-1.xx&_nc_gid=5wP1XzmR3Ujvs5hRc-lrWA&oh=00_AfGepJNths17tHptPpxhT0CtPcqFgBNLWoilpKp6F6puag&oe=680A3C93"
                                alt="¡Bolivia Danza en el Bicentenario!"
                                src="https://scontent-lim1-1.xx.fbcdn.net/v/t39.30808-6/492041672_1421471329289412_2318168045478537980_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_ohc=OdMVwgEOP98Q7kNvwG5ci0q&_nc_oc=Adm4gNvx_EhyC2CRIIXPprdAL7uZ_iBGDqjNcsUzUnVMYw9CrE-G4yfHyLqCyc9eo3U&_nc_zt=23&_nc_ht=scontent-lim1-1.xx&_nc_gid=5wP1XzmR3Ujvs5hRc-lrWA&oh=00_AfGepJNths17tHptPpxhT0CtPcqFgBNLWoilpKp6F6puag&oe=680A3C93"
                                class="ready">
                        </div>
                        <div class="contentcard">
                            <div class="topinfo">
                                <h2>Actualidad</h2>
                                <p class="hashtag"><i class="fas fa-map-marker-alt"></i>Bolivia</p>
                            </div>
                            <p class="notetitle">¡Bolivia Danza en el Bicentenario 2025!</p>
                            <span class="notegeneral">¡Bolivia Danza en el Bicentenario! 
                            Partipa de este concurso que se realiza a nivel nacional. 
                            </span>
                        </div>
                    </a>
                    <a href="{{ 'ultimo1' }}"
                        class="card">
                        <div class="headercard">
                            <img data-src="https://i.pinimg.com/736x/27/4e/47/274e476a4a6ca0eba095211ef399427a.jpg"
                                alt="Salar de Uyuni, Bolivia"
                                src="https://i.pinimg.com/736x/27/4e/47/274e476a4a6ca0eba095211ef399427a.jpg"
                                class="ready">
                        </div>
                        <div class="contentcard">
                            <div class="topinfo">
                                <h2>Conoce Bolivia</h2>
                                <p class="hashtag"><i class="fas fa-map-marker-alt"></i>Salar de Uyuni</p>
                            </div>
                            <p class="notetitle">Salar de Uyuni, Bolivia</p>
                            <span class="notegeneral">El Salar de Uyuni es más visitado durante la temporada de lluvias, que va desde diciembre hasta abril
                            Durante este período, el salar se cubre de agua, creando el famoso efecto espejo, lo que atrae a muchos turistas. 
                            </span>
                        </div>
                    </a>

                </div>
            </div>
        </section>


        <!--PARTE PUEBLOS MAGICOS -->
        <section class="ultimas">
            <section class="inner">
                <h2 class="title_home">Pueblos Mágicos</h2>
                <section class="scroll_notes">
                    <article>

                        <a href="https://www.mexicodesconocido.com.mx/comala-colima.html" class="especial">
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

                        <a href="https://www.mexicodesconocido.com.mx/todos-santos-baja-california-un-oasis-multicolor-en-el-desierto-baja-california.html"
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

                        <a href="https://www.mexicodesconocido.com.mx/que-hacer-en-villa-del-carbon.html"
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

                        <a href="https://www.mexicodesconocido.com.mx/tamales-capulin.html" class="especial">
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
                        <a href="https://www.mexicodesconocido.com.mx/macarrones-y-dulce-de-leche.html" class="especial">
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
                        <a href="https://www.mexicodesconocido.com.mx/bugambilia-maximiliano.html" class="especial">
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

                        <a href="https://www.mexicodesconocido.com.mx/rancho-magico-tlalpan.html" class="especial">
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
                        <a href="https://www.mexicodesconocido.com.mx/el-parque-nacional-la-malinche-tlaxcala-puebla.html"
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
                        <a href="https://www.mexicodesconocido.com.mx/paquetes-turisticos-tren-maya.html"
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
            <figure class="cover" style="background-image: url('{{ asset('images/fondo.jpg') }}') !important;"
            >
            </figure>

            <section class="inner">
                <h2 class="nice white">Guías turísticas de viaje</h2>
                <section class="scroll_notes apps">
                    <article>

                        <a href="https://visitaloreto.com/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_loreto.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico"
                                    src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_loreto.jpg"
                                    class="ready">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Guía Loreto</strong>
                            </figcaption>
                        </a>
                        <a href="https://zacatecasdeslumbrante.com/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_zacatecas.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico"
                                    src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_zacatecas.jpg"
                                    class="ready">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Guía Zacatecas</strong>
                            </figcaption>
                        </a>
                        <a href="https://chihuahuadesconocido.com/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_chihuahua.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico"
                                    src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_chihuahua.jpg"
                                    class="ready">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Guía Chihuahua</strong>
                            </figcaption>
                        </a>
                        <a href="https://tlatlauquitepecmagico.com/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_tlatla.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Guia Tlatlauquitepec</strong>
                            </figcaption>
                        </a>
                        <a href="https://tamaulipasseguroteenamora.com/" target="_blank" class="especial"
                            rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2025/01/Portada_TAMAULIPAS-corregida-1.gif"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Guía Turística Digital de Tamaulipas</strong>
                            </figcaption>
                        </a>
                        <a href="https://guia.chignahuapan.travel/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_chignahuapan.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Guía Chignahuapan</strong>
                            </figcaption>
                        </a>
                        <a href="https://oaxacaesmagia.com/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_oaxaca.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Guía Oaxaca</strong>
                            </figcaption>
                        </a>
                        <a href="https://mardecortes.mx/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/portada_mardecortes.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico">
                            </figure>
                            <figcaption>
                                <b>E-Magazine</b>
                                <strong>Mar de Cortés</strong>
                            </figcaption>
                        </a>
                    </article>
                </section>
            </section>
        </section>

        <!-- Seccion de MENU DESPLAZAMIENTO DE EVENTOS DE WEB APPS  -->
        <section class="especiales_home">
            <figure class="cover"
                style="background-image: url('{{ asset('images/fondo.jpg') }}') !important;"
                >
            </figure>
            <section class="inner">
                <h2 class="nice white">Web Apps</h2>
                <section class="scroll_notes apps">
                    <article>

                        <a href="https://www.mexicodesconocido.com.mx/viajes-por-carretera" target="_blank"
                            class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/viajes_carretera_guia.webp"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico"
                                    src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/viajes_carretera_guia.webp"
                                    class="ready">
                            </figure>
                            <figcaption>
                                <b>Micrositio</b>
                                <strong>Viajes por carretera</strong>
                            </figcaption>
                        </a>
                        <a href="https://hazturismoencoahuila.mx/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/coahuila_guia.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico"
                                    src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/coahuila_guia.jpg"
                                    class="ready">
                            </figure>
                            <figcaption>
                                <b>Webapp</b>
                                <strong>Coahuila</strong>
                            </figcaption>
                        </a>
                        <a href="https://pueblosmagicos.mexicodesconocido.com.mx" target="_blank" class="especial"
                            rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/pueblos_guia.webp"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico"
                                    src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/pueblos_guia.webp"
                                    class="ready">
                            </figure>
                            <figcaption>
                                <b>Webapp</b>
                                <strong>Pueblos</strong>
                            </figcaption>
                        </a>
                        <a href="https://disfrutatuciudad.mx/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/cdmx_guia.webp"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico">
                            </figure>
                            <figcaption>
                                <b>Webapp</b>
                                <strong>Ciudad de México</strong>
                            </figcaption>
                        </a>
                        <a href="https://guia.visitpuebla.mx/" target="_blank" class="especial" rel="noopener">
                            <figure>
                                <img data-src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2023/11/puebla.jpg"
                                    alt="primavera-CDMX-Mexico" title="primavera-CDMX-Mexico">
                            </figure>
                            <figcaption>
                                <b>Webapp</b>
                                <strong>Visit Puebla</strong>
                            </figcaption>
                        </a>
                    </article>
                </section>
            </section>
        </section>
        <!-- publicidad -->
        <div class="publicidad" data-gtm-vis-first-on-screen32626292_39="257563" data-gtm-vis-total-visible-time32626292_39="100" data-gtm-vis-has-fired32626292_39="1">
                  <!-- <section class="adPlacement" data-ad="div-gpt-ad-Leader_01_Desktop_970x90" data-slot="0"></section> -->
          <div id="div-gpt-ad-1699062229990-0" style="min-width: 320px; min-height: 90px;" data-google-query-id="CJK1j5CQ24wDFTNMuAQdeg0Ohw">

            <div id="google_ads_iframe_/1016237/Leader1_970x250_0__container__" style="border: 0pt none;">
              <iframe id="google_ads_iframe_/1016237/Leader1_970x250_0" name="google_ads_iframe_/1016237/Leader1_970x250_0" title="3rd party ad content" width="970" height="90" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" aria-label="Advertisement" tabindex="0" allow="private-state-token-redemption;attribution-reporting" data-load-complete="true" data-google-container-id="7" style="border: 0px; vertical-align: bottom;">                
              </iframe>
            </div>
          </div>
        </div>

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

        <!-- Seccion de las noticias -->
        <section class="inner">
            <h2 class="nice color">Noticias en Bolivia</h2>
            <section class="grid_notes">

                <a href="https://www.mexicodesconocido.com.mx/serpentikah-aztlan-montana-rusa.html" class="especial">
                    <figure>
                        <img src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2025/03/serpentikah-montana-rusa-aztlan-900x579.png"
                            alt="serpentikah-montana-rusa-aztlán" title="serpentikah-montana-rusa-aztlán "
                            data-credit="Captura de pantalla, vía YouTube." data-alt="serpentikah-montana-rusa-aztlán">
                    </figure>
                    <figcaption>
                        <b>Actualidad</b>
                        <strong>Serpentikah, la nueva montaña rusa del Parque Aztlán que no te puedes
                            perder</strong>
                        <em><i class="fas fa-map-marker"></i>Ciudad de México</em>
                    </figcaption>
                </a>
                <a href="https://www.mexicodesconocido.com.mx/semana-santa-iztapalapa.html" class="especial">
                    <figure>
                        <img src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2025/03/1280px-Procesion_solemne_en_La_Cuevita_de_Iztapalapa-900x675.jpg"
                            alt="1280px-Procesión_solemne_en_La_Cuevita_de_Iztapalapa"
                            title="1280px-Procesión_solemne_en_La_Cuevita_de_Iztapalapa " data-credit="Wikipedia"
                            data-alt="1280px-Procesión_solemne_en_La_Cuevita_de_Iztapalapa">
                    </figure>
                    <figcaption>
                        <b>Actualidad</b>
                        <strong>¡No te pierdas la Semana Santa 2025 en Iztapalapa! Conoce las fechas clave</strong>
                        <em><i class="fas fa-map-marker"></i>Ciudad de México</em>
                    </figcaption>
                </a>
                <a href="https://www.mexicodesconocido.com.mx/semana-santa-iztapalapa.html" class="especial">
                    <figure>
                        <img src="https://www.mexicodesconocido.com.mx/wp-content/uploads/2025/03/1280px-Procesion_solemne_en_La_Cuevita_de_Iztapalapa-900x675.jpg"
                            alt="1280px-Procesión_solemne_en_La_Cuevita_de_Iztapalapa"
                            title="1280px-Procesión_solemne_en_La_Cuevita_de_Iztapalapa " data-credit="Wikipedia"
                            data-alt="1280px-Procesión_solemne_en_La_Cuevita_de_Iztapalapa">
                    </figure>
                    <figcaption>
                        <b>Actualidad</b>
                        <strong>¡No te pierdas la Semana Santa 2025 en Iztapalapa! Conoce las fechas clave</strong>
                        <em><i class="fas fa-map-marker"></i>Ciudad de México</em>
                    </figcaption>
                </a>
            </section>
        </section><!--inner-->
        {{-- Parte de patrocinadores --}}
        
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
