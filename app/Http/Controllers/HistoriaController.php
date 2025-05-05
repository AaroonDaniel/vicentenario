<?php

namespace App\Http\Controllers;

use App\Models\Cultura;
use App\Models\Historia;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    // Mostrar vista
    public function index()
    {
        $historias = Historia::all();
        return view('historia.historias', compact('historias'));
    }
    //
    public function create()
    {
        $historias = Historia::all();
        return view('historias.create', compact('historias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'fuentes' => 'required',
            'puntuacion' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        Historia::create($data);

        return redirect()->route('historias.index')->with('success', 'Historia creada exitosamente.');
    }

    public function show($id)
    {
        $historia = Historia::findOrFail($id);
        return response()->json($historia);
    }



    //
    public function edit(Historia $historia)
    {
        $historias = Historia::all();
        return view('historias.edit', compact('historia'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'fuentes' => 'required',
            'puntuacion' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $historia = Historia::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('historias', 'public');
        }

        $historia->update($data);

        return redirect()->route('historias.index')->with('success', 'Historia actualizada correctamente');
    }

    //
    public function destroy($id)
    {
        $historia = Historia::findOrFail($id);
        $historia->delete();

        return response()->json(['success' => true]);
    }
}
