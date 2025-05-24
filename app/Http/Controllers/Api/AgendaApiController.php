<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Evento;
use Carbon\Carbon;
use App\Models\User;

class AgendaApiController extends Controller
{
    // Devuelve todos los eventos del mes actual
    public function index(Request $request)
    {
        $mes = $request->query('mes', Carbon::now()->month);

        $eventos = Evento::whereMonth('fecha', $mes)->get();
        return response()->json($eventos);
    }

    // Devuelve un evento por su ID
    public function show($id)
    {
        $evento = Evento::find($id);

        if (!$evento) {
            return response()->json(['error' => 'Evento no encontrado'], 404);
        }

        return response()->json($evento);
    }

    // Devuelve los eventos inscritos por el usuario
    public function misEventos(Request $request, $user_id)
    {
        $mes = $request->query('mes', Carbon::now()->month);

        // Obtiene los eventos donde el usuario está inscrito
        $eventos = Evento::join('user_agenda', 'eventos.id_evento', '=', 'user_agenda.evento_id')
            ->where('user_agenda.user_id', $user_id)
            ->whereMonth('eventos.fecha', $mes)
            ->select('eventos.*')
            ->get();

        return response()->json($eventos);
    }

    // Prueba fija para user_id = 1
    public function pruebaEventosUsuario1(Request $request)
    {
        $mes = $request->query('mes', Carbon::now()->month);

        // Obtiene los eventos del usuario user_id = 1
        $eventos = Evento::whereHas('participantes', function ($query) {
            $query->where('user_id', 1);
        })->whereMonth('fecha', $mes)
            ->get();

        return response()->json($eventos);
    }
}
