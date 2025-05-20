<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Asistencia;
use App\Models\User;
use App\Models\Evento;
class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::orderBy('created_at', 'desc')->get();
        $eventos = Evento::orderBy('nombre')->get(); // puedes ordenarlos por nombre
        $usuarios = User::orderBy('name')->get(); // obtener todos los usuarios
        return view('asistencia.escaner', compact('asistencias', 'eventos', 'usuarios'));
    }

    


    public function registrar(Request $request){
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'evento_id' => 'required|exists:eventos,id_evento',
        ]);
        // Verificar si ya existe
        $existe = Asistencia::where('user_id', $validated['user_id'])
            ->where('evento_id', $validated['evento_id'])
            ->first();

        if ($existe) {
            return response()->json(['message' => 'Asistencia ya registrada.']);
        }
        // Obtener usuario y evento
        $user = User::where('user_id', $validated['user_id'])->first();
        $evento = Evento::where('id_evento', $validated['evento_id'])->first();
        Asistencia::create([
            'user_id' => $validated['user_id'],
            'evento_id' => $validated['evento_id'],
            'asistio' => true,
            'nombre_usuario' => $user->name,
            'nombre_evento' => $evento->nombre,
        ]);
        return response()->json([
            'message' => 'Asistencia registrada con éxito.',
            'usuario' => $user->name,
            'evento' => $evento->nombre,
        ]);

    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'evento_id' => 'required|exists:eventos,id_evento',
            'asistio' => 'required|boolean',
        ]);

        $existe = Asistencia::where('user_id', $validated['user_id'])
            ->where('evento_id', $validated['evento_id'])
            ->exists();

        if ($existe) {
            return redirect()->back()->withErrors([
                'error' => '❗ La asistencia a este evento ya está registrada para este usuario.'
            ])->withInput();
        }

        $usuario = User::where('user_id', $validated['user_id'])->first();
        $evento = Evento::where('id_evento', $validated['evento_id'])->first();

        Asistencia::create([
            'user_id' => $validated['user_id'],
            'evento_id' => $validated['evento_id'],
            'asistio' => $validated['asistio'],
            'nombre_usuario' => $usuario->name,
            'nombre_evento' => $evento->nombre,
        ]);

        return redirect()->back()->with('success', '✅ Asistencia registrada correctamente.');
    }


    public function show($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        return response()->json($asistencia);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'nombre_usuario' => 'required|string',
            'evento_id' => 'required|integer',
            'nombre_evento' => 'required|string',
            'asistio' => 'required|boolean',
        ]);


        $asistencia = Asistencia::findOrFail($id);
        $asistencia->update($validated);

        return redirect()->back()->with('success', 'Asistencia actualizada exitosamente!!.');
    }


}

