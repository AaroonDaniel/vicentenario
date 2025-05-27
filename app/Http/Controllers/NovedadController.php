<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Novedad;
use Illuminate\Support\Facades\Storage;
class NovedadController extends Controller
{


    public function index()
    {
        $novedades = Novedad::latest()->paginate(10);
        return view('novedades.index', compact('novedades'));
    }

    public function create()
    {
        $novedades = Novedad::all();
        return view('novedades.create', compact('novedades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        Novedad::create($data);

        return redirect()->route('novedades.index')->with('success', 'Novedad creada con éxito');
    }

    public function show($id)
    {
        $novedad = Novedad::findOrFail($id);
        return response()->json($novedad);
    }


public function show1($id)
{
    $novedad = \App\Models\Novedad::findOrFail($id);

    // Obtener otras novedades (excluyendo la actual)
    $novedades = \App\Models\Novedad::where('id', '!=', $id)->latest()->take(3)->get();

    return view('ultimo', compact('novedad', 'novedades'));
}



    public function edit(Novedad $novedad)
    {
        $novedades = Novedad::all();
        return view('novedades.edit', compact('novedad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|max:2048',
        ]);
        
        $novedad = Novedad::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('novedades', 'public');
        }

        $novedad->update($data);

        return redirect()->route('novedades.index')->with('success', 'Novedad actualizada');
    }

    public function destroy($id)
    {
        $novedad = Novedad::findOrFail($id);
        $novedad->delete();

        return response()->json(['success' => true]);
    }





}