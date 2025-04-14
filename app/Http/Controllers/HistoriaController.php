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
        ]);
        Historia::create($request->all());
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
        $historia = Historia::findOrFail($id);
        $historia->update($request->all());
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

