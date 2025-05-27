@extends('layouts.app1') {{-- Asegúrate de usar tu layout base --}}

@section('content')
<div class="p-9">
    <div class="max-w-xl mx-auto p-4 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Subir Imagen a la Galería</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('galeria.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium">Título</label>
                <input type="text" name="titulo" id="titulo" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="imagen" class="block text-sm font-medium">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="w-full border rounded p-2" accept="image/*" required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="w-full border rounded p-2" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label for="evento_id" class="block text-sm font-medium">Evento</label>
                <select name="evento_id" id="evento_id" class="w-full border rounded p-2" required>
                    <option value="">Selecciona un evento</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id_evento }}">{{ $evento->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="w-full border rounded p-2" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
        </form>
    </div>
</div>

@endsection
