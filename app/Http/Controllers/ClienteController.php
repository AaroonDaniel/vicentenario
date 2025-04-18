<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        //$this->middleware('can: Crear cliente')->only('create');
        //$this->middleware('can: Eliminar cliente')->only('create');
    }

    public function index()
    {
        $clientes = Client::all();
        return view('sistema.listCliente', compact('clientes'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sistema.addCliente');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            'dni' => 'required|numeric|unique:clients,dni|min:10',
            'apellido' => 'required|string|max:75',
            'nombre' =>'required|string|max:75',
            'email' => 'required|email|unique:clients,email|max:75',
            'telefono' => 'required|numeric|min:75',
        ]);
        $cliente = new Client();
        $cliente->dni = $request->input('dni');
        $cliente->apellido = $request->input('apellido');
        $cliente->nombre = $request->input('nombre');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado = $request->input('estado');
        $cliente->save();

        return back()->with('message','ok');
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
    public function edit(string $id)
    {
        $cliente = Client::find($id);

        return view('sistema.editCliente', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $cliente = Client::find($id);

        $cliente->dni = $request->input('dni');
        $cliente->apellido = $request->input('apellido');
        $cliente->nombre = $request->input('nombre');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->estado = $request->input('estado');
        $cliente->save();
        return back()->with('message', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Client::find($id);
        $cliente->delete();
        return back();
    }
}
