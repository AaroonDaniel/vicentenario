<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Evento;
use Illuminate\Http\Request;

class GraficoControlador extends Controller
{
    public function index()
    {
        $asistenciasPorEvento = Asistencia::select('nombre_evento')
            ->selectRaw('count(*) as total_asistentes')
            ->groupBy('nombre_evento')
            ->get();

        // Total de asistencias
        $totalAsistencias = Asistencia::count();

        // Total de eventos
        $totalEventos = Evento::count();

        // Evento con mayor asistencia
        $eventoConMayorAsistencia = Asistencia::select('nombre_evento')
            ->selectRaw('count(*) as total')
            ->groupBy('nombre_evento')
            ->orderByDesc('total')
            ->first();

        return view('sistema.Graficos.graph', compact(
            'asistenciasPorEvento',
            'totalAsistencias',
            'totalEventos',
            'eventoConMayorAsistencia'
        ));

    }
}
