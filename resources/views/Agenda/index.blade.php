@extends('layouts.principal')
@section('content')
    
    <div class="max-w-5xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-4">Mi Calendario</h2>
        <div id="calendar" class="bg-white rounded shadow p-4"></div>
    </div>

    <!-- Modal para crear evento -->
    <!-- Modal para crear evento -->
    <div id="eventoModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Crear evento</h2>
                <button type="button" onclick="cerrarModal()" class="text-gray-500 hover:text-gray-700 text-lg">&times;</button>
            </div>

            <form id="formEvento">
                @csrf
                <input type="hidden" name="fecha" id="fecha">

                <div class="mb-2">
                    <label class="block">Título:</label>
                    <input type="text" name="titulo" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-2">
                    <label class="block">Fecha y hora de inicio:</label>
                    <input type="datetime-local" name="hora_inicio" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-2">
                    <label class="block">Fecha y hora de fin:</label>
                    <input type="datetime-local" name="hora_fin" class="w-full border rounded p-2">
                </div>

                <div class="mb-2">
                    <label class="block">Ubicación:</label>
                    <input type="text" name="ubicacion" class="w-full border rounded p-2">
                </div>

                <div class="mb-2">
                    <label class="block">Descripción:</label>
                    <!-- Editor de texto avanzado (opcional) -->
                    <textarea name="descripcion" class="w-full border rounded p-2"></textarea>
                </div>

                <div class="mb-2">
                    <label class="block">Usuario:</label>
                    <input type="text" name="usuario" value="{{ auth()->user()->name }}" class="w-full border rounded p-2" readonly>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
                    <button type="button" onclick="cerrarModal()" class="ml-2 bg-gray-200 text-gray-700 px-4 py-2 rounded">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                events: '{{ route("agenda.eventos") }}',
                dateClick: function(info) {
                    console.log("Hiciste clic en", info.dateStr); // ← línea nueva
                    document.getElementById('fecha').value = info.dateStr;
                    document.getElementById('eventoModal').classList.remove('hidden');
                }
            });

            calendar.render();

            document.getElementById('formEvento').addEventListener('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);

                fetch('{{ route("agenda.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name="_token"]').value
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        calendar.refetchEvents();
                        cerrarModal();
                        alert('Evento guardado correctamente');
                    }
                });
            });
        });

        function cerrarModal() {
            document.getElementById('eventoModal').classList.add('hidden');
        }
    </script>
@endpush


