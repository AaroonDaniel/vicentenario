@extends('layouts.app1')

@section('content')
<section class="py-16  bg-gradient-to-b from-lime-50 to-stone-500 bg-opacity-50">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Encabezado principal -->
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10 uppercase tracking-wide">
            {{ $galeria->titulo }}
        </h1>

        <div class="bg-white  shadow-lg overflow-hidden transform transition duration-500 hover:shadow-2xl">
            <div class="flex flex-col md:flex-row">
                
                <!-- Imagen -->
                <div class="md:w-1/8">
                    <img 
                        src="{{ $galeria->imagen ? asset('storage/' . $galeria->imagen) : asset('images/default.jpg') }}" 
                        alt="{{ $galeria->titulo }}" 
                        class="w-full h-full object-cover  transition-transform duration-500 hover:scale-105"
                    >
                </div>

                <!-- Contenido -->
                <div class="md:w-1/2 p-10 flex flex-col justify-center  bg-gradient-to-b from-lime-50 to-stone-600 bg-opacity-50">
                    <div class="space-y-6">
                        <div class="h-1 w-16 bg-teal-800 rounded-full"></div> <!-- Línea decorativa -->
                        <p class="text-gray-800 text-lg leading-relaxed">
                            {{ $galeria->descripcion }}
                        </p>
                    </div>

                    <div class="mt-10">
                        <a href="{{ route('galeria.index') }}" 
                            class="inline-flex items-center text-sm font-medium text-gray-100 hover:underline">
                            
                            <svg class="mr-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                            </svg>
                            Volver a la galeria

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
