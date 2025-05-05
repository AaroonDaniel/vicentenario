@extends('layouts.principal')

@section('content')
<section class="content">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">
        <!-- Bloque del título -->
        <div class="bg-neutral-50 rounded-2xl shadow-lg p-6 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-gray-800 flex items-center justify-center gap-2">
                <svg class="w-8 h-8 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Mi Calendario
            </h2>
        </div>

        <!-- Bloque del calendario -->
        <div class="bg-neutral-50 rounded-2xl shadow-lg p-4 sm:p-6 overflow-x-auto">
            <div id="calendar" class="min-w-[320px]"></div>
        </div>
    </div>

    <!-- Modal para visualizar/eliminar evento -->
    <div id="eventoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 sm:p-6 transition-opacity duration-300">
        <div class="bg-black p-4 sm:p-6 rounded-2xl shadow-xl w-full max-w-lg sm:max-w-2xl transform transition-all duration-300 scale-95">
            <!-- Encabezado -->
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h2 class="text-lg sm:text-xl font-semibold flex items-center gap-2 text-teal-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-teal-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                    </svg>

                    Detalles del Evento
                </h2>
                <button type="button" onclick="cerrarModal()" class="text-teal-500 hover:text-teal-700 text-2xl font-bold">
                    &times;
                </button>
            </div>

            <!-- Formulario -->
            <form id="formEvento">
                @csrf
                <input type="hidden" name="fecha" id="fecha">

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-neutral-100">Título</label>
                        <input type="text" name="titulo" class="w-full border border-gray-300 rounded-md p-2 bg-stone-50" readonly>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-neutral-100">Fecha de inicio</label>
                            <input type="date" name="fecha_inicio" class="w-full border border-gray-300 rounded-md p-2 bg-stone-50" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-neutral-100">Hora de inicio</label>
                            <input type="time" name="hora_inicio" class="w-full border border-gray-300 rounded-md p-2 bg-stone-50" readonly>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-neutral-100">Ubicación</label>
                        <input type="text" name="ubicacion" class="w-full border border-gray-300 rounded-md p-2 bg-stone-50" readonly>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-neutral-100">Descripción</label>
                        <textarea name="descripcion" rows="3" class="w-full border border-gray-300 rounded-md p-2 bg-stone-50 resize-none" readonly></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-teal-500">Usuario</label>
                        <input type="text" name="usuario" value="{{ auth()->user()->name }}" class="w-full bg-neutral-500 rounded-md p-2 text-white" readonly>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-2 sm:gap-4 mt-6">
                    <button type="button" id="deleteBtn" class="bg-teal-900 text-white px-4 py-2 rounded hover:bg-teal-700 transition">Eliminar</button>
                    <button type="button" onclick="cerrarModal()" class="bg-neutral-800 text-white px-4 py-2 rounded hover:bg-neutral-500 transition">Cerrar</button>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let calendarEl = document.getElementById('calendar');

        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',

            dateClick: function(info) {
                document.getElementById('fecha').value = info.dateStr;
                document.getElementById('formEvento').reset();
                document.getElementById('deleteBtn').classList.add('hidden');
                document.getElementById('eventoModal').classList.remove('hidden');
            },

            eventClick: function(info) {
                const evento = info.event;

                document.querySelector('[name="titulo"]').value = evento.title;

                const [fechaIso, horaIso] = evento.startStr.split('T');

                document.querySelector('[name="fecha_inicio"]').value = fechaIso;
                document.querySelector('[name="hora_inicio"]').value = horaIso?.slice(0, 5) || '';

                document.querySelector('[name="ubicacion"]').value = evento.extendedProps.ubicacion || '';
                document.querySelector('[name="descripcion"]').value = evento.extendedProps.descripcion || '';
                
                document.getElementById('deleteBtn').classList.remove('hidden');
                document.getElementById('eventoModal').classList.remove('hidden');

                document.getElementById('deleteBtn').onclick = function() {
                    if (confirm('¿Eliminar este evento?')) {
                        fetch('/agenda/delete/' + evento.id, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                calendar.refetchEvents();
                                cerrarModal();
                                alert('Evento eliminado correctamente');
                            }
                        });
                    }
                };
            }
        });

        calendar.render();
            // Cargar eventos y aplicar colores automáticamente
            fetch('{{ route("agenda.eventos") }}')
            .then(res => res.json())
            .then(eventos => {
                const colores = ['#FF5733', '#33FF57', '#3357FF', '#F39C12', '#8E44AD', '#1ABC9C','#bc1a91','#1abcaf','#a6bc1a'];
                eventos.forEach((evento, index) => {
                    evento.color = colores[index % colores.length];
                });
                calendar.addEventSource(eventos);
            });

        document.getElementById('formEvento').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Solo puedes visualizar y eliminar eventos.');
        });
    });

    function cerrarModal() {
        document.getElementById('eventoModal').classList.add('hidden');
        document.getElementById('formEvento').reset();        
        document.getElementById('deleteBtn').classList.add('hidden');
    }
</script>
@endpush
