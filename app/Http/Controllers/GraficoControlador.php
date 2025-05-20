<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Illuminate\Support\Facades\DB;

class GraficoControlador extends Controller
{
    public function index()
    {
        // Contar asistentes por evento (solo donde asistio = 1)
        $asistenciasPorEvento = Asistencia::select('evento_id', 'nombre_evento', DB::raw('count(*) as total_asistentes'))
            ->where('asistio', true)
            ->groupBy('evento_id', 'nombre_evento')
            ->get();

        return view('sistema.Graficos.graph', compact('asistenciasPorEvento'));
    }
}
