@extends('adminlte::page')

@section('content_header')
    <h1 class="text-2xl font-bold mb-4">Panel de Asistencias por Evento</h1>
@stop

@section('content')


<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Resumen de Asistencias</h2>
    <canvas id="chartAsistencias" height="100"></canvas>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [
        @foreach ($asistenciasPorEvento as $evento)
            "{{ $evento->nombre_evento }}",
        @endforeach
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'Cantidad de Asistentes',
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: [
                @foreach ($asistenciasPorEvento as $evento)
                    {{ $evento->total_asistentes }},
                @endforeach
            ],
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    };

    const myChart = new Chart(document.getElementById('chartAsistencias'), config);
</script>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endsection
