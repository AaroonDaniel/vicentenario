@extends('layouts.app1')

@section('title', 'Quiénes Somos - Bicentenario Bolivia')

@section('content')
<section class="relative w-full h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/fondo01.png') }}');">
    <!-- Capa oscura semi-transparente -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Contenido centrado -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-white text-center px-4 md:px-16">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 drop-shadow-lg">¿Quiénes Somos?</h1>
        <p class="text-lg md:text-xl max-w-3xl mb-8 leading-relaxed drop-shadow-md">
            En conmemoración a los 200 años de independencia de Bolivia, el proyecto <strong>Bicentenario Bolivia</strong> nace como una iniciativa para recordar, celebrar y proyectar el legado histórico, cultural y social de nuestro país hacia las nuevas generaciones.
        </p>
        <a href="{{ route('eventos.index') }}" class="bg-teal-600 hover:bg-teal-500 text-white px-6 py-3 rounded-full font-semibold shadow-lg transition duration-300">
            Conoce nuestras actividades
        </a>
    </div>
</section>

<!-- Tarjetas de misión, visión y qué hacemos -->
<section class="bg-gray-100 py-20 px-6 md:px-16">
    <div class="max-w-6xl mx-auto grid gap-12 md:grid-cols-3 text-center">
        <!-- Misión -->
        <div class="bg-gray-150 rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
            <div class="mb-4 transform transition duration-300 hover:scale-110 hover:drop-shadow-md">
                <svg class="mx-auto h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="url(#gradient-mision)" stroke-width="2">
                    <defs>
                        <linearGradient id="gradient-mision" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#ff5858" />
                            <stop offset="100%" stop-color="#f09819" />
                        </linearGradient>
                    </defs>
                    <path d="M12 6v6l4 2" />
                    <path d="M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">Nuestra Misión</h3>
            <p class="text-gray-700">
                Fomentar el orgullo nacional y fortalecer la identidad boliviana mediante eventos y actividades que celebren nuestros 200 años de independencia.
            </p>
        </div>

        <!-- Visión -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
            <div class="mb-4 transform transition duration-300 hover:scale-110 hover:drop-shadow-md">
                <svg class="mx-auto h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="url(#gradient-vision)" stroke-width="2">
                    <defs>
                        <linearGradient id="gradient-vision" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#36d1dc" />
                            <stop offset="100%" stop-color="#5b86e5" />
                        </linearGradient>
                    </defs>
                    <path d="M12 4.5c4.5 0 8 3.5 8 7.5s-3.5 7.5-8 7.5-8-3.5-8-7.5 3.5-7.5 8-7.5z" />
                    <circle cx="12" cy="12" r="2" />
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">Nuestra Visión</h3>
            <p class="text-gray-700">
                Ser un referente en la preservación de la memoria histórica y los valores que unen a Bolivia como nación libre y soberana.
            </p>
        </div>

        <!-- Qué hacemos -->
        <div class="bg-gray-100 rounded-2xl shadow-lg p-8 hover:shadow-xl transition">
            <div class="mb-4 transform transition duration-300 hover:scale-110 hover:drop-shadow-md">
                <svg class="mx-auto h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="url(#gradient-quehacemos)" stroke-width="2">
                    <defs>
                        <linearGradient id="gradient-quehacemos" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#43e97b" />
                            <stop offset="100%" stop-color="#38f9d7" />
                        </linearGradient>
                    </defs>
                    <path d="M3 10h11M9 21V3M16 13h5v7h-5z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold mb-3 text-gray-900">¿Qué Hacemos?</h3>
            <p class="text-gray-700">
                Promovemos actividades culturales, exposiciones, foros y publicaciones que celebran la historia, diversidad y futuro de Bolivia.
            </p>
        </div>
    </div>
</section>


@endsection
