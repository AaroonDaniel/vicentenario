<?php

namespace App\Http\Controllers;

use App\Models\Cultura;
use App\Models\Historia;
use Illuminate\Http\Request;

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
        $historias = Historia::all();
        return view('culturas.create', compact('historias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_historia' => 'required|exists:historias,id_historia',
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'origen' => 'required',
        ]);

        Cultura::create($request->all());
        return redirect()->route('culturas.index')->with('success', 'Cultura creada exitosamente.');
    }
    public function show($id)
    {
        $cultura = Cultura::with('historia')->findOrFail($id);
        return response()->json($cultura);
    }

    public function edit(Cultura $cultura)
    {
        $historias = Historia::all();
        return view('culturas.edit', compact('cultura', 'historias'));
    }


    public function update(Request $request, $id)
    {
        $cultura = Cultura::findOrFail($id);
        $cultura->update($request->all());
    
        return redirect()->route('culturas.index')->with('success', 'Cultura actualizada correctamente');
    }
    

    public function destroy($id)
    {
        $cultura = Cultura::findOrFail($id);
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