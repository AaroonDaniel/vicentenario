<?php

namespace App\Http\Controllers;

use App\Models\Cultura;
use App\Models\Historia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CulturaController extends Controller
{
    public function index()
    {
        $culturas = Cultura::with('historia')->get(); 
        $historias = Historia::all(); 

        return view('Culturas.index', compact('culturas', 'historias'));
    }

    public function create()
    {
        $culturas = Cultura::all();
        return view('culturas.create', compact('culturas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_historia' => 'required|exists:historias,id_historia',
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'origen' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        Cultura::create($data);
        return redirect()->route('culturas.index')->with('success', 'Cultura creada exitosamente.');
    }

    public function show($id)
    {
        $cultura = Cultura::with('historia')->findOrFail($id);
        return response()->json($cultura);
    }

    public function edit(Cultura $cultura)
    {
        $culturas = Cultura::all();
        return view('culturas.edit', compact('cultura', 'historias'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_historia' => 'required|exists:historias,id_historia',
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'origen' => 'required',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $cultura = Cultura::findOrFail($id);
        $data = $request->all();

        // Si hay una nueva imagen, guardarla
        if ($request->hasFile('imagen')) {
            // Opcionalmente, eliminar la imagen anterior si existe
            if ($cultura->imagen) {
                Storage::disk('public')->delete($cultura->imagen);
            }
            
            $data['imagen'] = $request->file('imagen')->store('culturas', 'public');
        }

        $cultura->update($data);
        
        return redirect()->route('culturas.index')->with('success', 'Cultura actualizada correctamente');
    }
    
    public function destroy($id)
    {
        $cultura = Cultura::with('historia')->findOrFail($id);
        $cultura->delete();

        return response()->json(['success' => true]);
    }
}

/*
class CulturaController extends Controller
{
    //
    public function index()
    {
        $cultura = Cultura::all();
        return view('cultura.index', compact('cultura'));
    }

}
*/