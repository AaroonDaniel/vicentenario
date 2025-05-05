<?php
// app/Http/Controllers/UserAgendaController.php
namespace App\Http\Controllers;
use Illuminate\Http\Request;     
use App\Models\UserAgenda;
use Illuminate\Support\Facades\Auth;

class UserAgendaController extends Controller
{
    //
    public function index()
    {
        return view('agenda.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
        ]);

        $userId = auth()->id();

        // Validar si ya existe el evento
        $existe = UserAgenda::where('titulo', $request->titulo)
            ->where('hora_inicio', $request->hora_inicio)
            ->where('user_id', $userId)
            ->exists();

        if ($existe) {
            return response()->json([
                'success' => false,
                'message' => 'Este evento ya fue agregado a tu calendario.'
            ], 200);
        }

        UserAgenda::create([
            'user_id' => $userId,
            'evento_id' => $request->evento_id, // Asegúrate de que venga en la petición
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'descripcion' => $request->descripcion,
            'ubicacion' => $request->ubicacion,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Evento guardado correctamente.'
        ], 200);
    }

    public function getEventos()
    {
        $eventos = UserAgenda::where('user_id', auth()->id())->get();

        $eventosTransformados = $eventos->map(function ($evento) {
            return [
                'id' => $evento->id,
                'title' => $evento->titulo,
                'start' => $evento->fecha . 'T' . $evento->hora_inicio,

                'end' => $evento->hora_fin ? $evento->fecha . 'T' . $evento->hora_fin : null,
                'descripcion' => $evento->descripcion,
                'ubicacion' => $evento->ubicacion,
            ];
        });

        return response()->json($eventosTransformados);
    }

    public function update(Request $request, $id)
    {
        $evento = UserAgenda::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
        ]);

        $evento->update([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'descripcion' => $request->descripcion,
            'ubicacion' => $request->ubicacion,
        ]);

        return response()->json(['success' => true, 'message' => 'Evento actualizado correctamente.']);
    }

    public function destroy($id)
    {
        $evento = UserAgenda::where('user_id', auth()->id())->findOrFail($id);
        $evento->delete();

        return response()->json(['success' => true, 'message' => 'Evento eliminado correctamente.']);
    }
}