@extends('adminlte::page')

@section('content_header')
    <h1 class="text-2xl font-bold mb-4">Panel de Asistencias por Evento</h1>
@stop

@section('content')




<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Resumen de Asistencias</h2>
    <div style="height: 400px;">
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
            backgroundColor: [
                'rgba(208, 119, 138, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.6)',
                'rgba(116, 90, 167, 0.6)',
                'rgba(255, 159, 64, 0.6)',
                'rgba(212, 118, 160, 0.6)'
            ],
            borderColor: [
                'rgb(255, 83, 120)',
                'rgb(15, 105, 165)',
                'rgb(245, 177, 4)',
                'rgb(23, 170, 170)',
                'rgb(116, 81, 184)',
                'rgb(199, 111, 23)',
                'rgb(79, 77, 77)'
            ],

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
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#f9fafb',
                    titleColor: '#111827',
                    bodyColor: '#374151',
                    borderColor: '#e5e7eb',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#374151',
                        font: { size: 12 }
                    }
                },
                y: {
                    beginAtZero: true,
                    precision: 0,
                    ticks: {
                        color: '#374151',
                        font: { size: 12 }
                    },
                    grid: {
                        color: '#e5e7eb'
                    }
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
