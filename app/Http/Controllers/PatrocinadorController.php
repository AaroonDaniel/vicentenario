<?php

namespace App\Http\Controllers;

use App\Models\Patrocinador;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatrocinadorController extends Controller
{
    public function index()
    {
        $patrocinadores = Patrocinador::with('eventos')->get();
        $eventos = Evento::orderBy('nombre')->get(); // Agregar esta línea para que 'eventos' esté disponible en la vista
        return view('patrocina.index', compact('patrocinadores', 'eventos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'razon_social' => 'required|string|max:255',
            'institucion' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'eventos' => 'nullable|array',
            'eventos.*.monto' => 'nullable|numeric|min:0',
        ]);

        $data = $request->only(['razon_social', 'institucion']);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('patrocinadores', 'public');
        }

        $patrocinador = Patrocinador::create($data);

        // Asociar eventos seleccionados con monto
        if ($request->has('eventos')) {
            $eventoData = [];
            foreach ($request->eventos as $evento) {
                if (!empty($evento['id_evento'])) {
                    $eventoData[$evento['id_evento']] = [
                        'monto' => $evento['monto'] ?? 0,
                    ];
                }
            }
            $patrocinador->eventos()->sync($eventoData);
        }


        return redirect()->route('patrocinadores.index')->with('success', 'Patrocinador creado exitosamente.');
    }

    public function edit($id_patrocinador)
    {
        $patrocinador = Patrocinador::with('eventos')->find($id_patrocinador);

        if (!$patrocinador) {
            return response()->json(['error' => 'Patrocinador no encontrado'], 404);
        }

        return response()->json($patrocinador);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'razon_social' => 'required|string|max:255',
            'institucion' => 'nullable|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'eventos' => 'nullable|array',
            'eventos.*.id_evento' => 'required|exists:eventos,id_evento',
            'eventos.*.monto' => 'nullable|numeric|min:0',
        ]);

        $patrocinador = Patrocinador::findOrFail($id);

        // Actualizar datos básicos
        $data = $request->only(['razon_social', 'institucion']);

        // Manejar imagen
        if ($request->hasFile('imagen')) {
            if ($patrocinador->imagen) {
                Storage::disk('public')->delete($patrocinador->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('patrocinadores', 'public');
        }

        $patrocinador->update($data);

        // Actualizar eventos con montos
        if ($request->has('eventos')) {
            $eventoData = [];
            foreach ($request->eventos as $evento) {
                $eventoData[$evento['id_evento']] = [
                    'monto' => $evento['monto'] ?? 0,
                ];
            }
            $patrocinador->eventos()->sync($eventoData);
        }

        return redirect()->route('patrocinadores.index')->with('success', 'Patrocinador actualizado exitosamente.');
    }


    public function destroy(Request $request, $id)
    {
        $patrocinador = Patrocinador::with('eventos')->find($id);

        if (!$patrocinador) {
            return response()->json([
                'error' => 'Patrocinador no encontrado.'
            ], 404);
        }

        // Verifica si hay eventos y no se forzó la eliminación
        if ($patrocinador->eventos->isNotEmpty() && !$request->input('force')) {
            return response()->json([
                'error' => 'Este patrocinador tiene eventos asociados. ¿Deseas eliminarlo de todas formas?',
                'has_events' => true
            ], 400);
        }

        try {
            if ($patrocinador->imagen) {
                Storage::disk('public')->delete($patrocinador->imagen);
            }
            $patrocinador->delete();

            return response()->json([
                'success' => 'Patrocinador eliminado exitosamente.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Ocurrió un error al eliminar el patrocinador.'
            ], 500);
        }
    }
}
