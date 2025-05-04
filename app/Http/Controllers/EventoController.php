<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Historia;
use App\Models\Cultura;
use App\Models\UserAgenda; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carga todas las relaciones de una sola vez
        $eventos = Evento::with(['culturas', 'historias'])->get();
        
        $userId = auth()->check() ? auth()->id() : null;

        $eventosAgendados = [];

        if (auth()->check()) {
            $eventosAgendados = UserAgenda::where('user_id', auth()->id())->pluck('evento_id')->toArray();
        }

        return view('evento.listEvento', compact('eventos', 'eventosAgendados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'direccion'    => 'required|string|max:255',
            'tipo'         => 'required|in:música,danza,teatro,gastronomía,arte,batallas,personajes históricos,movimientos,fechas importantes,ferias,conferencias,talleres,infantil',
            'fecha'        => 'required|date',
            'departamento' => 'required|string|max:255',
            'imagen'       => 'nullable|image|max:2048',
            'hora'         => 'nullable',
            'modalidad'    => 'nullable',
            'enlace'       => 'nullable',
            'enlaceFormulario'       => 'nullable'
        ]);

        
        $evento = new Evento();
        $evento->nombre       = $request->nombre;
        $evento->descripcion  = $request->descripcion;
        $evento->direccion    = $request->direccion;
        $evento->tipo         = $request->tipo;
        $evento->fecha        = $request->fecha;
        $evento->departamento = $request->departamento;
        $evento->hora         = $request->hora;
        $evento->modalidad    = $request->modalidad;
        $evento->enlace       =$request->enlace;
        $evento->enlaceFormulario =$request->enlaceFormulario;


        // Imagen
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('eventos', 'public');
            $evento->imagen_ruta = $path;
        }

        $evento->save();
        return redirect()->back()->with('success', 'Evento registrado exitosamente.');

        

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        $eventos = Evento::all();
        return view('eventos.edit', compact('eventos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'descripcion'  => 'required|string',
            'direccion'    => 'required|string|max:255',
            'tipo'         => 'required|in:música,danza,teatro,gastronomía,arte,batallas,personajes históricos,movimientos,fechas importantes,ferias,conferencias,talleres,infantil',
            'fecha'        => 'required|date',
            'departamento' => 'required|string|max:255',
            'imagen'       => 'nullable|image|max:2048',
            'hora'         => 'nullable',
            'modalidad'    => 'nullable',
            'enlace'       => 'nullable',
            'enlaceFormulario' => 'nullable'
        ]);

        $evento->fill($request->only([
            'nombre',
            'descripcion',
            'direccion',
            'tipo',
            'fecha',
            'departamento',
            'hora',
            'modalidad',
            'enlace',
            'enlaceFormulario'
        ]));

        if ($request->hasFile('imagen')) {
            if ($evento->imagen_ruta) {
                Storage::disk('public')->delete($evento->imagen_ruta);
            }
            $path = $request->file('imagen')->store('eventos', 'public');
            $evento->imagen_ruta = $path;
        }

        $evento->save();
        return redirect()
            ->route('eventos.index')
            ->with('success', 'Evento actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);

        if ($evento->imagen_ruta) {
            Storage::disk('public')->delete($evento->imagen_ruta);
        }

        $evento->delete();

        return response()->json(['success' => true]);
    }
}
