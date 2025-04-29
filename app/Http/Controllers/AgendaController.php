<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Evento; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr; // Para manejo de arrays

class AgendaController extends Controller
{

    public function index(Request $request)
    {
        $mes = $request->input('mes', Carbon::now()->month);
        $tipos = $request->input('tipos', []); // <-- tipos de eventos filtrados

        $query = Agenda::whereMonth('fecha_inicio', $mes)
                    ->with('evento');

        if (!empty($tipos)) {
            $query->whereHas('evento', function ($q) use ($tipos) {
                $q->whereIn('tipo', $tipos);
            });
        }

        $agendas = $query->orderBy('fecha_inicio')->get();

        return view('AgendaEventos.index', compact('agendas', 'mes', 'tipos'));
    }


}
