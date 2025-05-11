<footer>
    <section class="inner">
        <section class="wrapper">
            <section class="col_1 logos_iasa bg-gray-150 py-8">
                <!-- Contenedor principal con overflow oculto -->
                <div class="overflow-hidden whitespace-nowrap relative">
                    <!-- Carrusel animado -->
                    <div class="animate-marquee flex gap-8">
                        <!-- Duplicado para efecto continuo -->
                        @for ($i = 0; $i < 2; $i++)
                            @foreach ($patrocinadores as $patro)
                                <div
                                    class="flex-shrink-0 w-48 h-24 flex items-center justify-center bg-white rounded-lg shadow-md transition-transform hover:scale-105">
                                    <a @if ($patro->url) href="{{ $patro->url }}" target="_blank" rel="noreferrer" @endif
                                        class="block w-full h-full flex items-center justify-center">
                                        @if ($patro->imagen)
                                            <img src="{{ asset('storage/' . $patro->imagen) }}"
                                                alt="{{ $patro->razon_social }}"
                                                class="max-h-16 max-w-[90%] object-contain transition-opacity hover:opacity-90"
                                                style="filter: brightness(0.95) contrast(1.1);">
                                        @else
                                            <div class="text-sm text-gray-600">
                                                Sin logo
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        @endfor
                    </div>
                </div>

                <!-- Estilos embebidos -->
                <style>
                    @keyframes marquee {
                        0% {
                            transform: translateX(0);
                        }

                        100% {
                            transform: translateX(-50%);
                        }
                    }

                    .animate-marquee {
                        display: inline-flex;
                        animation: marquee 30s linear infinite;
                        white-space: nowrap;
                        padding-right: 100%;
                    }
                </style>
            </section>

            <section class="col_4">
                <strong class="nice">Información</strong>
                <a href="https://www.bicentenario.gob.bo/" target="_blank" rel="noreferrer">Sitio Oficial</a>
                <a href="/aviso-de-privacidad">Política de Privacidad</a>
                <a href="/accesibilidad">Accesibilidad</a>
            </section>

            <section class="col_4">
                <strong class="nice">Sobre el Bicentenario</strong>
                <a href="/historia-bicentenario">Historia y Significado</a>
                <a href="/actividades-nacionales">Actividades Nacionales</a>
                <a href="/contacto-bicentenario">Contáctanos</a>
            </section>

            <section class="col_4 digital_mag">
                <strong class="nice">Ver galería conmemorativa</strong>
                <p>Explora imágenes y contenidos digitales en homenaje a los 200 años de Bolivia.</p>

                <a href="https://www.bicentenario.gob.bo/galeria" class="btn block" rel="noreferrer" target="_blank">Ver
                    galería</a>
            </section>
        </section>
    </section>
    <section class="copyright">
        ©2025 Bicentenario de Bolivia | Gobierno del Estado Plurinacional
    </section>
</footer>
