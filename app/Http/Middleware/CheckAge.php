<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario es administrador
        if (auth()->check() && auth()->user()->email === "admin@gmail.com") {
            return $next($request); // Permite continuar con la solicitud
        }

        // Redirige a la página principal si no es administrador
        return redirect('/');
    }
}