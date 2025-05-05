<?php

namespace App\Http\Controllers;

use App\Models\Expositor;
use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Storage;

class ExpositorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expositores = Expositor::with('eventos')->get();

        // Depura los datos


        $eventos = Evento::all();
        return view('expositores.index', compact('expositores', 'eventos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar datos generales del expositor
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'eventos' => 'required|array|min:1',
            'eventos.*.id_evento' => 'required|exists:eventos,id_evento',
            'eventos.*.tema' => 'required|string|max:255',
            'imagen_perfil' => 'nullable|image|max:2048',
        ]);

        // Crear expositor
        $expositor = Expositor::create($request->only([
            'nombre',
            'especialidad',
            'institucion',
            'contacto'
        ]));

        // Guardar imagen de perfil si existe
        if ($request->hasFile('imagen_perfil')) {
            $path = $request->file('imagen_perfil')->store('expositores', 'public');
            $expositor->update(['imagen_perfil' => $path]);
        }

        // Asociar eventos con temas
        $eventosConTemas = [];
        foreach ($request->eventos as $evento) {
            $eventosConTemas[$evento['id_evento']] = ['tema' => $evento['tema']];
        }
        $expositor->eventos()->sync($eventosConTemas);

        return redirect()->route('expositores.index')->with('success', 'Expositor creado correctamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expositor = Expositor::with('eventos')->findOrFail($id);
        return response()->json([
            'expositor' => $expositor,
            'eventos' => $expositor->eventos,
            'tema' => $expositor->eventos->first()?->pivot->tema ?? ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'eventos' => 'required|array|min:1',
            'eventos.*.id_evento' => 'required|exists:eventos,id_evento',
            'eventos.*.tema' => 'required|string|max:255',
            'imagen_perfil' => 'nullable|image|max:2048',
        ]);

        $expositor = Expositor::findOrFail($id);
        $expositor->update($request->only([
            'nombre',
            'especialidad',
            'institucion',
            'contacto'
        ]));

        if ($request->hasFile('imagen_perfil')) {
            if ($expositor->imagen_perfil) {
                Storage::disk('public')->delete($expositor->imagen_perfil);
            }
            $path = $request->file('imagen_perfil')->store('expositores', 'public');
            $expositor->update(['imagen_perfil' => $path]);
        }

        $eventosConTemas = [];
        foreach ($request->eventos as $evento) {
            $eventosConTemas[$evento['id_evento']] = ['tema' => $evento['tema']];
        }
        $expositor->eventos()->sync($eventosConTemas);

        return redirect()->route('expositores.index')->with('success', 'Expositor actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $expositor = Expositor::findOrFail($id);
        // Eliminar imagen si existe
        if ($expositor->imagen_perfil) {
            Storage::disk('public')->delete($expositor->imagen_perfil);
        }

        $expositor->delete();

        return redirect()->route('expositores.index')->with('success', 'Expositor eliminado correctamente.');
    }
    /*public function show(string $id)
    {
        $expositor = Expositor::with('eventos')->findOrFail($id);
        return response()->json([
            'expositor' => $expositor,
            'eventos' => $expositor->eventos
        ]);
    }*/
    public function show(string $id)
    {
        $expositor = Expositor::with(['eventos' => function ($query) {
            $query->select('eventos.id_evento', 'eventos.nombre', 'eventos_expositores.tema');
        }])->findOrFail($id);

        return response()->json([
            'expositor' => $expositor,
            'eventos' => $expositor->eventos->map(function ($evento) {
                return [
                    'nombre_evento' => $evento->nombre,
                    'tema' => $evento->pivot->tema ?? 'N/A'
                ];
            })
        ]);
    }
}
