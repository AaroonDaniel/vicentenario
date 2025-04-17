<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('sistema.user.roles', compact('roles'));
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
        $role = Role::create(['name' => $request->input('nombre')]);
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
    public function edit(Role $role)
    {
        //
        //$role = Role::find($id);
        if ($role->guard_name != 'sanctum') {
            return redirect()->route('roles.index')->with('warning', "Estás editando un rol con el guard {$role->guard_name}. Cambia el guard a sacntum.");
        } else {
            $permisos = Permission::all();
            return view('sistema.user.rolePermiso', compact('role', 'permisos'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $role->permissions()->sync($request->permisos);
        return redirect()->route('roles.edit', $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente');
    }

    public function switchGuard($id)
    {
        // Buscar el rol por ID
        $role = Role::find($id);

        if (!$role) {
            return back()->withErrors(['error' => 'El rol no existe.']);
        }

        // Alternar entre 'web' y 'sanctum'
        $newGuard = $role->guard_name === 'web' ? 'sanctum' : 'web';
        $role->guard_name = $newGuard;
        $role->save();

        // Redirigir con un mensaje de éxito
        return back()->with('message', "Cambio realizado: El guard ahora es {$newGuard}.");
    }
}
