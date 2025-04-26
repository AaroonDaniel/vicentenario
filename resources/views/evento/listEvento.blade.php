@extends('layouts.principal')
@section('title', 'Vicentenario Bolivia')

@section('content')
    <section class="content">
        {{-- Carrusel de Eventos --}}
        <section class="ultimas gray">
            <section class="inner">
                <h2 class="title_home">Eventos</h2>
                <section class="scroll_notes">
                    <article>
                        @foreach ($eventos as $evento)
                            <a href="{{ route('eventos.show', $evento->id_evento) }}" class="especial">
                                <figure>
                                    @if ($evento->imagen_ruta)
                                        <img src="{{ Storage::url($evento->imagen_ruta) }}"
                                            alt="Imagen de {{ $evento->nombre }}" title="{{ $evento->nombre }}">
                                    @else
                                        <img src="https://via.placeholder.com/350x200?text=Sin+imagen" alt="Sin imagen">
                                    @endif
                                </figure>


                                <figcaption>
                                    <b>{{ ucfirst($evento->tipo) }}</b>
                                    <strong>{{ $evento->nombre }}</strong>
                                    <b class="mt-2 text-sm text-white description-text"> {{ substr($evento->hora, 0, 5) }}
                                        {{ $evento->modalidad }} </b>
                                    <p class="mt-2 text-sm text-white description-text">
                                        {{ Str::limit($evento->descripcion, 160, '...') }}
                                    </p>
                                    <em>
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $evento->fecha->format('Y-m-d') }} -
                                        – {{ $evento->departamento }}
                                    </em>

                                </figcaption>
                            </a>
                        @endforeach
                    </article>
                </section>
            </section>
        </section>

        {{-- MODAL --}}
        <div x-data="modalEdit()">

            <!-- Vista de la lista de eventos -->
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Listado de Eventos</h1>
                    <button onclick="abrirModal('modalNuevo')"
                        class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">
                        + Nuevo
                    </button>
                </div>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto table-responsive">
                    <table id="eventosTable" class="min-w-full bg-white text-sm text-left text-gray-800 rounded-lg shadow">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Imagen</th>
                                <th class="px-4 py-3">Nombre</th>
                                <th class="px-4 py-3">Tipo</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Dirección</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3">Hora</th>
                                <th class="px-4 py-3">Modalidad</th>
                                <th class="px-4 py-3">Enlace</th>
                                <th class="px-4 py-3">Departamento</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventos as $evento)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $evento->id_evento }}</td>

                                    {{-- Imagen --}}
                                    <td class="px-4 py-2">
                                        @if ($evento->imagen_ruta)
                                            <img src="{{ Storage::url($evento->imagen_ruta) }}"
                                                alt="{{ $evento->nombre }}" class="h-16 w-16 object-cover rounded">
                                        @else
                                            <span class="text-gray-400 text-sm">Sin imagen</span>
                                        @endif
                                    </td>

                                    {{-- Nombre y Tipo --}}
                                    <td class="px-4 py-2">{{ $evento->nombre }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($evento->tipo) }}</td>

                                    {{-- Descripción --}}
                                    <td class="px-4 py-2">{{ $evento->descripcion }}</td>

                                    {{-- Dirección --}}
                                    <td class="px-4 py-2">{{ $evento->direccion }}</td>

                                    {{-- Fecha --}}
                                    <td class="px-4 py-2">{{ $evento->fecha->format('Y-m-d') }}</td>

                                    {{-- Hora --}}
                                    <td class="px-4 py-2">{{ $evento->hora }}</td>

                                    {{-- Modalidad --}}
                                    <td class="px-4 py-2">{{ $evento->modalidad }}</td>

                                    {{-- Enlace --}}
                                    <td class="px-4 py-2">{{ $evento->enlace }}</td>

                                    {{-- Departamento --}}
                                    <td class="px-4 py-2">{{ $evento->departamento }}</td>

                                    {{-- Acciones --}}
                                    <td class="px-4 py-2 flex space-x-2">
                                        {{-- Ver --}}
                                        <button
                                            @click="openViewModal({
                                                nombre: '{{ addslashes($evento->nombre) }}',
                                                descripcion: `{!! addslashes($evento->descripcion) !!}`,
                                                tipo: '{{ ucfirst($evento->tipo) }}',
                                                fecha: '{{ $evento->fecha->format('Y-m-d') }}',
                                                departamento: '{{ addslashes($evento->departamento) }}',
                                                direccion: '{{ addslashes($evento->direccion) }}',
                                                imagenUrl: '{{ $evento->imagen_ruta ? Storage::url($evento->imagen_ruta) : asset('images/default-event.png') }}',
                                                hora: '{{ substr($evento->hora, 0, 5) }}',
                                                modalidad: '{{ $evento->modalidad }}',
                                                enlace: '{{ $evento->enlace }}'
                                            })"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- Editar --}}
                                        <button
                                            @click="openEditModal({
                                                id: {{ $evento->id_evento }},
                                                nombre: '{{ addslashes($evento->nombre) }}',
                                                descripcion: `{!! addslashes($evento->descripcion) !!}`,
                                                tipo: '{{ $evento->tipo }}',
                                                fecha: '{{ $evento->fecha->format('Y-m-d') }}',
                                                departamento: '{{ addslashes($evento->departamento) }}',
                                                direccion: '{{ addslashes($evento->direccion) }}',
                                                hora: '{{ substr($evento->hora, 0, 5) }}',
                                                modalidad: '{{ $evento->modalidad }}',
                                                enlace: '{{ $evento->enlace }}'
                                            })"
                                            class="text-yellow-500 hover:text-yellow-700">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- Eliminar --}}
                                        <button
                                            onclick="confirmarEliminar({{ $evento->id_evento }}, '{{ addslashes($evento->titulo) }}')"
                                            class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <!-- Modal EDITAR -->
            <div x-show="showEdit" x-transition x-cloak x-on:keydown.escape.window="closeEdit()" @click.away="closeEdit()"
                class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                <div
                    class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative overflow-y-auto max-h-[90vh] relative">
                    <!-- Botón cerrar -->
                    <button @click="closeEdit()"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-2xl">&times;
                    </button>

                    <h2 class="text-lg font-bold text-black-700 mb-4">
                        <i class="fas fa-user-edit mr-2"></i>Editar Evento
                    </h2>

                    <form :action="`/eventos/${form.id}`" method="POST" enctype="multipart/form-data"
                        @submit.prevent="submitEdit($event)">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label class="block font-semibold">Nombre</label>
                            <input type="text" name="nombre" x-model="form.nombre"
                                class="w-full bg-gray-100 border rounded px-3 py-2" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label class="block font-semibold">Descripción</label>
                            <textarea name="descripcion" x-model="form.descripcion" class="w-full bg-gray-100 border rounded px-3 py-2"
                                rows="3" required></textarea>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-4">
                            <label class="block font-semibold">Dirección</label>
                            <input type="text" name="direccion" x-model="form.direccion"
                                class="w-full bg-gray-100 border rounded px-3 py-2" required>
                        </div>

                        <!-- Tipo -->
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Categoría del Evento</label>
                            <select name="tipo" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="" disabled {{ old('tipo', $evento->tipo) == '' ? 'selected' : '' }}>
                                    -- Selecciona una categoría --
                                </option>

                                <optgroup label="Cultura">
                                    <option value="música" {{ old('tipo', $evento->tipo) == 'música' ? 'selected' : '' }}>
                                        Música</option>
                                    <option value="danza" {{ old('tipo', $evento->tipo) == 'danza' ? 'selected' : '' }}>
                                        Danza</option>
                                    <option value="teatro" {{ old('tipo', $evento->tipo) == 'teatro' ? 'selected' : '' }}>
                                        Teatro</option>
                                    <option value="gastronomía"
                                        {{ old('tipo', $evento->tipo) == 'gastronomía' ? 'selected' : '' }}>Gastronomía
                                    </option>
                                    <option value="arte" {{ old('tipo', $evento->tipo) == 'arte' ? 'selected' : '' }}>
                                        Arte</option>
                                </optgroup>

                                <optgroup label="Historia">
                                    <option value="batallas"
                                        {{ old('tipo', $evento->tipo) == 'batallas' ? 'selected' : '' }}>Batallas</option>
                                    <option value="personajes históricos"
                                        {{ old('tipo', $evento->tipo) == 'personajes históricos' ? 'selected' : '' }}>
                                        Personajes Históricos</option>
                                    <option value="movimientos"
                                        {{ old('tipo', $evento->tipo) == 'movimientos' ? 'selected' : '' }}>Movimientos
                                    </option>
                                    <option value="fechas importantes"
                                        {{ old('tipo', $evento->tipo) == 'fechas importantes' ? 'selected' : '' }}>Fechas
                                        Importantes</option>
                                </optgroup>

                                <optgroup label="Otros">
                                    <option value="ferias" {{ old('tipo', $evento->tipo) == 'ferias' ? 'selected' : '' }}>
                                        Ferias</option>
                                    <option value="conferencias"
                                        {{ old('tipo', $evento->tipo) == 'conferencias' ? 'selected' : '' }}>Conferencias
                                    </option>
                                    <option value="talleres"
                                        {{ old('tipo', $evento->tipo) == 'talleres' ? 'selected' : '' }}>Talleres</option>
                                    <option value="infantil"
                                        {{ old('tipo', $evento->tipo) == 'infantil' ? 'selected' : '' }}>Infantil</option>
                                </optgroup>
                            </select>
                        </div>


                        <!-- Fecha -->
                        <div class="mb-4">
                            <label class="block font-semibold">Fecha</label>
                            <input type="date" name="fecha" x-model="form.fecha"
                                class="w-full bg-gray-100 border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Hora</label>
                            <input type="time" name="hora" x-model="form.hora"
                                class="w-full bg-gray-100 border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Modalidad</label>
                            <select name="modalidad" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="Presencial"
                                    {{ old('modalidad', $evento->modalidad) == 'Presencial' ? 'selected' : '' }}>Presencial
                                </option>
                                <option value="Virtual"
                                    {{ old('modalidad', $evento->modalidad) == 'Virtual' ? 'selected' : '' }}>Virtual
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Enlace</label>
                            <input type="text" name="enlace" x-model="form.hora"
                                class="w-full bg-gray-100 border rounded px-3 py-2" required>
                        </div>


                        <!-- Departamento -->
                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Departamento</label>
                            <select name="departamento" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="La Paz"
                                    {{ old('departamento', $evento->departamento) == 'La Paz' ? 'selected' : '' }}>La Paz
                                </option>
                                <option value="Cochabamba"
                                    {{ old('departamento', $evento->departamento) == 'Cochabamba' ? 'selected' : '' }}>
                                    Cochabamba</option>
                                <option value="Santa Cruz"
                                    {{ old('departamento', $evento->departamento) == 'Santa Cruz' ? 'selected' : '' }}>
                                    Santa Cruz</option>
                                <option value="Oruro"
                                    {{ old('departamento', $evento->departamento) == 'Oruro' ? 'selected' : '' }}>Oruro
                                </option>
                                <option value="Potosí"
                                    {{ old('departamento', $evento->departamento) == 'Potosí' ? 'selected' : '' }}>Potosí
                                </option>
                                <option value="Tarija"
                                    {{ old('departamento', $evento->departamento) == 'Tarija' ? 'selected' : '' }}>Tarija
                                </option>
                                <option value="Chuquisaca"
                                    {{ old('departamento', $evento->departamento) == 'Chuquisaca' ? 'selected' : '' }}>
                                    Chuquisaca</option>
                                <option value="Beni"
                                    {{ old('departamento', $evento->departamento) == 'Beni' ? 'selected' : '' }}>Beni
                                </option>
                                <option value="Pando"
                                    {{ old('departamento', $evento->departamento) == 'Pando' ? 'selected' : '' }}>Pando
                                </option>
                            </select>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label class="block font-semibold">Cambiar imagen</label>
                            <input type="file" name="imagen" accept="image/*"
                                class="w-full bg-gray-100 border rounded px-3 py-2">
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="closeEdit()"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Eliminar -->
            <div id="eliminarEventoModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h2 class="text-lg font-bold text-black-600">
                                <i class="fas fa-trash-alt"></i> Eliminar Evento
                            </h2>
                            <button onclick="cerrarModalEliminar()"
                                class="text-gray-600 hover:text-black-600 text-lg">&times;</button>
                        </div>

                        <p class="text-gray-800 mb-4">
                            ¿Estás seguro que deseas eliminar el evento
                            <span id="tituloEventoEliminar" class="font-semibold text-black-600"></span>?
                        </p>

                        <form id="formEliminarEvento" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-end space-x-2">
                                <button type="button" onclick="cerrarModalEliminar()"
                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="bg-pink-600 hover:bg-black-700 text-white px-4 py-2 rounded">
                                    Eliminar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal CREAR un nuevo evento-->
            <div id="modalNuevo"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
                <div class="bg-white w-full max-w-2xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh] relative">
                    <button onclick="cerrarModal('modalNuevo')"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
                    <h2 class="text-2xl font-bold mb-4">Registrar nuevo evento</h2>

                    <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Nombre del Evento</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Descripción</label>
                            <textarea name="descripcion" rows="4" class="w-full border border-gray-300 rounded px-3 py-2" required>{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Dirección</label>
                            <input type="text" name="direccion" value="{{ old('direccion') }}"
                                class="w-full border border-gray-300 rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Categoría del Evento</label>
                            <select name="tipo" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="" disabled {{ old('tipo') ? '' : 'selected' }}>-- Selecciona una
                                    categoría --</option>

                                <optgroup label="Cultura">
                                    <option value="música" {{ old('tipo') == 'música' ? 'selected' : '' }}>Música</option>
                                    <option value="danza" {{ old('tipo') == 'danza' ? 'selected' : '' }}>Danza</option>
                                    <option value="teatro" {{ old('tipo') == 'teatro' ? 'selected' : '' }}>Teatro</option>
                                    <option value="gastronomía" {{ old('tipo') == 'gastronomía' ? 'selected' : '' }}>
                                        Gastronomía</option>
                                    <option value="arte" {{ old('tipo') == 'arte' ? 'selected' : '' }}>Arte</option>
                                </optgroup>

                                <optgroup label="Historia">
                                    <option value="batallas" {{ old('tipo') == 'batallas' ? 'selected' : '' }}>Batallas
                                    </option>
                                    <option value="personajes históricos"
                                        {{ old('tipo') == 'personajes históricos' ? 'selected' : '' }}>Personajes
                                        Históricos</option>
                                    <option value="movimientos" {{ old('tipo') == 'movimientos' ? 'selected' : '' }}>
                                        Movimientos</option>
                                    <option value="fechas importantes"
                                        {{ old('tipo') == 'fechas importantes' ? 'selected' : '' }}>Fechas Importantes
                                    </option>
                                </optgroup>

                                <optgroup label="Otros">
                                    <option value="ferias" {{ old('tipo') == 'ferias' ? 'selected' : '' }}>Ferias</option>
                                    <option value="conferencias" {{ old('tipo') == 'conferencias' ? 'selected' : '' }}>
                                        Conferencias</option>
                                    <option value="talleres" {{ old('tipo') == 'talleres' ? 'selected' : '' }}>Talleres
                                    </option>
                                    <option value="infantil" {{ old('tipo') == 'infantil' ? 'selected' : '' }}>Infantil
                                    </option>
                                </optgroup>
                            </select>
                        </div>


                        <div class="mb-4">
                            <label class="block font-semibold">Fecha</label>
                            <input type="date" name="fecha" value="{{ old('fecha') }}"
                                class="w-full bg-gray-100 border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-semibold">Hora</label>
                            <input type="time" name="hora" value="{{ old('hora') }}"
                                class="w-full bg-gray-100 border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4" x-data="{ modalidad: '{{ old('modalidad', 'presencial') }}' }">
                            <label class="block font-semibold mb-1">Modalidad</label>
                            <select name="modalidad" x-model="modalidad"
                                class="w-full bg-gray-100 border rounded px-3 py-2">
                                <option value="presencial">Presencial</option>
                                <option value="virtual">Virtual</option>
                            </select>

                            <div x-show="modalidad === 'virtual'" class="mt-4">
                                <label class="block font-semibold mb-1">Enlace del evento virtual</label>
                                <input type="url" name="enlace" value="{{ old('enlace') }}"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="https://zoom.us/j/xxxxx">
                            </div>
                        </div>


                        <div class="mb-4">
                            <label class="block font-semibold mb-1">Departamento</label>
                            <select name="departamento" class="w-full border border-gray-300 rounded px-3 py-2" required>
                                <option value="" disabled selected>-- Selecciona un departamento --</option>
                                <option value="La Paz" {{ old('departamento') == 'La Paz' ? 'selected' : '' }}>La Paz
                                </option>
                                <option value="Cochabamba" {{ old('departamento') == 'Cochabamba' ? 'selected' : '' }}>
                                    Cochabamba</option>
                                <option value="Santa Cruz" {{ old('departamento') == 'Santa Cruz' ? 'selected' : '' }}>
                                    Santa Cruz</option>
                                <option value="Oruro" {{ old('departamento') == 'Oruro' ? 'selected' : '' }}>Oruro
                                </option>
                                <option value="Potosí" {{ old('departamento') == 'Potosí' ? 'selected' : '' }}>Potosí
                                </option>
                                <option value="Tarija" {{ old('departamento') == 'Tarija' ? 'selected' : '' }}>Tarija
                                </option>
                                <option value="Chuquisaca" {{ old('departamento') == 'Chuquisaca' ? 'selected' : '' }}>
                                    Chuquisaca</option>
                                <option value="Beni" {{ old('departamento') == 'Beni' ? 'selected' : '' }}>Beni</option>
                                <option value="Pando" {{ old('departamento') == 'Pando' ? 'selected' : '' }}>Pando
                                </option>
                            </select>
                        </div>


                        <div class="mb-4">
                            <label class="block font-semibold">Ingrese imagen</label>
                            <input type="file" name="imagen" class="w-full bg-gray-100 border rounded px-3 py-2">
                        </div>

                        <div class="text-right space-x-2">
                            <button type="button" onclick="cerrarModal('modalNuevo')"
                                class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                                Cancelar
                            </button>
                            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">
                                Guardar
                            </button>
                        </div>


                    </form>
                </div>
            </div>

            <!-- Modal VER -->
            <div x-show="showView" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                x-cloak x-on:keydown.escape.window="closeView()" @click.away="closeView()">
                <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6 relative overflow-y-auto max-h-[90vh]">
                    <button @click="closeView"
                        class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>

                    <h2 class="text-2xl font-bold mb-4 text-center">Detalle del Evento</h2>

                    <div class="mb-4 flex justify-center">
                        <img :src="viewForm.imagenUrl" alt="Imagen del evento"
                            class="rounded-lg shadow-md max-w-full object-contain max-h-96">
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Nombre:</span>
                        <p x-text="viewForm.nombre" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Descripción:</span>
                        <p x-html="viewForm.descripcion" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Tipo:</span>
                        <p x-text="viewForm.tipo" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Fecha:</span>
                        <p x-text="viewForm.fecha" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Hora:</span>
                        <p x-text="viewForm.hora" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Modalidad:</span>
                        <p x-text="viewForm.modalidad" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Enlace:</span>
                        <p x-text="viewForm.enlace" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Departamento:</span>
                        <p x-text="viewForm.departamento" class="text-gray-700"></p>
                    </div>

                    <div class="mb-2">
                        <span class="font-semibold">Dirección:</span>
                        <p x-text="viewForm.direccion" class="text-gray-700"></p>
                    </div>

                    <div class="text-right mt-4">
                        <button @click="closeView" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>


    </section>
@endsection

@push('scripts')
    <script>
        function abrirModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function cerrarModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        function modalEdit() {
            return {
                show: false,
                form: {},
                openEditModal(data) {
                    this.form = {
                        ...data
                    };
                    this.show = true;
                },
                close() {
                    this.show = false;
                }
            }
        }
    </script>

    {{-- Script para eliminar un evento --}}

    <script>
        function confirmarEliminar(id, titulo) {
            $('#formEliminarEvento').attr('action', `/eventos/${id}`);
            $('#tituloEventoEliminar').text(titulo);
            $('#eliminarEventoModal').removeClass('hidden');
        }

        function cerrarModalEliminar() {
            $('#eliminarEventoModal').addClass('hidden');
            $('#formEliminarEvento').attr('action', '');
            $('#tituloEventoEliminar').text('');
        }

        $('#formEliminarEvento').on('submit', function(e) {
            e.preventDefault();

            let actionUrl = $(this).attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    cerrarModalEliminar();
                    location.reload(); // O elimina visualmente la fila si prefieres
                },
                error: function(xhr) {
                    alert('Error al eliminar el evento.');
                }
            });
        });
    </script>



    <!-- Alpine.js controller -->
    <script>
        function modalEdit() {
            return {
                // Estados
                showEdit: false,
                showView: false,
                form: {
                    id: null,
                    nombre: '',
                    descripcion: '',
                    direccion: '',
                    tipo: '',
                    fecha: '',
                    departamento: '',
                    hora: '',
                    modalidad: '',
                    enlace: ''

                },
                viewForm: {
                    nombre: '',
                    descripcion: '',
                    direccion: '',
                    tipo: '',
                    fecha: '',
                    departamento: '',
                    imagenUrl: '',
                    hora: '',
                    modalidad: '',
                    enlace: ''
                },

                // Abrir edición
                openEditModal(data) {
                    this.form = {
                        ...data,
                        hora: data.hora ? data.hora.slice(0, 5) : '', // Recorta segundos
                    };
                    this.showEdit = true;
                    document.body.classList.add('overflow-hidden');
                },
                // Cerrar edición
                closeEdit() {
                    this.showEdit = false;
                    document.body.classList.remove('overflow-hidden');
                },
                // Enviar edición
                submitEdit(event) {
                    this.closeEdit();
                    this.$nextTick(() => event.target.submit());
                },

                // Abrir vista
                openViewModal(data) {
                    this.viewForm = {
                        ...data,
                        hora: data.hora ? data.hora.slice(0, 5) : '',
                        modalidad: data.modalidad ?? '',
                    };
                    this.showView = true;
                    document.body.classList.add('overflow-hidden');
                },

                // Cerrar vista
                closeView() {
                    this.showView = false;
                    document.body.classList.remove('overflow-hidden');
                },

                // Eliminar (ya lo tienes)
                abrirModalEliminar(id, nombre) {
                    /* ... */
                },
                cerrarModalEliminar() {
                    /* ... */
                }
            }
        }
    </script>

    <!-- Nuevo modal -->
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
@endpush
