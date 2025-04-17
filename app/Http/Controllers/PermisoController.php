<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $permisos = Permission::all();

        return view('sistema.user.permisos', compact('permisos'));
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
        //
        $permission = Permission::create(['name' => $request->input('nombre')]);

        return back();
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
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Recuperar el permiso por ID
        $permission = Permission::findOrFail($id);
        // Validar los datos del formulario
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:permissions,name,' . $permission->id],
        ]);

        // Actualizar el nombre del permiso
        $permission->update(['name' => $request->input('nombre')]);

        // Redirigir con un mensaje de éxito
        return back()->with('success', 'Permiso actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Buscar el permiso por ID
        $permission = Permission::find($id);

        // Verificar si el permiso existe
        if (!$permission) {
            return redirect()->route('permisos.index')->with('error', 'El permiso no existe.');
        }

        // Eliminar el permiso
        $permission->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('permisos.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
