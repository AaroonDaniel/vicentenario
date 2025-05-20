<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Evento;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('evento')->get(); // Carga videos con su evento
        $eventos = Evento::all(); // Lista de eventos para el formulario

        return view('Multimedia.index', compact('videos', 'eventos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'url' => 'required|url',
            'descripcion' => 'required|string',
            'evento_id' => 'required|exists:eventos,id_evento',
            'fecha'        => 'required|date',
        ]);

        Video::create($validated);

        return redirect()->back()->with('success', 'Video agregado exitosamente.');
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'url' => 'required|url',
            'descripcion' => 'required|string',
            'evento_id' => 'required|exists:eventos,id_evento',
            'fecha' => 'required|date',
        ]);

        dd($validated); // 👈 Revisa si los datos llegan bien

        $video->update($validated);

        return redirect()->back()->with('success', 'Video actualizado correctamente.');
    }


    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->back()->with('success', 'Video eliminado correctamente.');
    }


    public function show(Video $video)
    {
        $video->load('evento'); // Cargar relación evento

        return response()->json([
            'id' => $video->id,
            'titulo' => $video->titulo,
            'url' => $video->url,
            'descripcion' => $video->descripcion,
            'evento_id' => $video->evento_id,
            'created_at' => $video->created_at,
            'updated_at' => $video->updated_at,
            'nombre' => $video->evento->nombre ?? 'Sin evento',
            'fecha' => $video->fecha,
        ]);
    }


    public function create()
    {
        $eventos = Evento::all(); // Para asociar un evento al crear
        return view('Multimedia.create', compact('eventos'));
    }

    public function edit(Video $video)
    {
        $eventos = Evento::all(); // Para el dropdown de eventos
        return view('Multimedia.edit', compact('video', 'eventos'));
    }

}
