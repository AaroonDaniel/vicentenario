@extends('layouts.app1')

@section('content')
<section class="py-16 bg-gradient-to-b from-lime-50 to-stone-500 bg-opacity-50">
    <div class="max-w-7x2 mx-auto px-10 sm:px-6 lg:px-10">
        <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-12">
            Galería del Bicentenario
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-8">
            @forelse ($galerias as $item)
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 overflow-hidden">
                    <div class="overflow-hidden">
                        <img 
                            src="{{ $item->imagen ? asset('storage/' . $item->imagen) : asset('images/default.jpg') }}" 
                            alt="{{ $item->titulo }}" 
                            class="w-full h-64 object-cover transform group-hover:scale-105 transition duration-500"
                        >
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-emerald-800 transition">
                            {{ $item->titulo }}
                        </h3>
                        <p class="text-sm text-gray-800 mb-3">
                            {{ Str::limit($item->descripcion, 90) }}
                        </p>
                        <a href="{{ route('galeria.show', $item->id) }}" 
                           class="inline-flex items-center text-sm font-medium text-teal-600 hover:underline">
                            Ver más
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 text-lg">
                    No hay imágenes en la galería todavía.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

