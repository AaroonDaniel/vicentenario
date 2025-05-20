@extends('adminlte::page')

@section('content_header')
    <h1 class="text-2xl font-bold mb-4">Panel de Asistencias por Evento</h1>
@stop

@section('content')

{{-- Tarjetas --}}
<div class="row">
    <!-- Total de Asistencias -->
    <div class="col-md-4 mb-4">
        <div class="card text-white shadow" style="background: linear-gradient(to right,rgb(114, 176, 0),rgb(6, 3, 64));">
            <div class="card-body text-center">
                <i class="fas fa-users fa-2x mb-2"></i>
                <h4>{{ $totalAsistencias }}</h4>
                <p class="mb-0">Total Asistencias</p>
            </div>
        </div>
    </div>

    <!-- Total de Eventos -->
    <div class="col-md-4 mb-4">
        <div class="card text-white shadow" style="background: linear-gradient(to right,rgb(16, 187, 190),rgb(3, 70, 84));">
            <div class="card-body text-center">
                <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                <h4>{{ $totalEventos }}</h4>
                <p class="mb-0">Total Eventos</p>
            </div>
        </div>
    </div>

    <!-- Evento con Mayor Asistencia -->
    <div class="col-md-4 mb-4">
        <div class="card text-white shadow" style="background: linear-gradient(to right,rgb(107, 255, 154),rgb(201, 24, 101));">
            <div class="card-body text-center">
                <i class="fas fa-chart-bar fa-2x mb-2"></i>
                <h4>{{ $eventoConMayorAsistencia->nombre_evento ?? 'No disponible' }}</h4>
                <p class="mb-0">Evento con más asistencia</p>
            </div>
        </div>
    </div>
</div>

{{-- Gráfico tipo dona --}}
<div class="bg-gray-200 rounded-lg shadow p-6 mt-8">
    <h2 class="text-center font-semibold mb-4 p-4">Distribución de Asistencia</h2>
    <div class="chart-container" style="position: relative; height:40vh; width:100%;">
        <canvas id="donutChart"></canvas>
    </div>
</div>

{{-- Gráfico de barras --}}
<div class="bg-gray-100 rounded-lg shadow p-6 mt-8">
    <h2 class="text-center font-semibold mb-4 p-4">Resumen de Asistencias</h2>
    <div class="chart-container p-4" style="position: relative; height:40vh; width:100%;">
        <canvas id="chartAsistencias"></canvas>
    </div>
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
            backgroundColor: labels.map(() => {
                // Colores aleatorios
                const r = Math.floor(Math.random() * 255);
                const g = Math.floor(Math.random() * 255);
                const b = Math.floor(Math.random() * 255);
                return `rgba(${r}, ${g}, ${b}, 0.6)`;
            }),
            borderColor: 'rgba(0,0,0,0.1)',
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
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    };

    const myChart = new Chart(document.getElementById('chartAsistencias'), config);

    // Donut chart
    const donutData = {
        labels: labels,
        datasets: [{
            label: 'Asistencias',
            data: data.datasets[0].data,
            backgroundColor: data.datasets[0].backgroundColor,
            hoverOffset: 10
        }]
    };

    const donutConfig = {
        type: 'doughnut',
        data: donutData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    };

    new Chart(document.getElementById('donutChart'), donutConfig);
</script>
@stop

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .chart-container {
        position: relative;
        width: 100%;
        height: 40vh;
    }

    @media (max-width: 768px) {
        .chart-container {
            height: 50vh;
        }
    }
</style>
@endsection

