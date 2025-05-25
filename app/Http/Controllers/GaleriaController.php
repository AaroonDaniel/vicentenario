<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\Evento;

class GaleriaController extends Controller
{
    public function index()
    {
        $galerias = Galeria::latest()->get(); // Puedes ordenar o filtrar como gustes
        return view('galeria.index', compact('galerias'));
    }

    public function create()
    {
        $eventos = Evento::all();
        return view('galeria.create', compact('eventos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'descripcion' => 'nullable|string',
            'evento_id' => 'required|exists:eventos,id_evento',
            'fecha' => 'required|date',
        ]);

        // Guardar imagen
        $path = $request->file('imagen')->store('galeria', 'public');

        Galeria::create([
            'titulo' => $request->titulo,
            'imagen' => $path,
            'descripcion' => $request->descripcion,
            'evento_id' => $request->evento_id,
            'fecha' => $request->fecha,
        ]);

        return redirect()->route('galeria.create')->with('success', 'Imagen guardada exitosamente.');
    }

    public function show($id)
    {
        $galeria = Galeria::findOrFail($id);
        return view('galeria.show', compact('galeria'));
    }



}
