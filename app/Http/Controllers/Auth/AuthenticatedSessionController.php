<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login'); // Muestra la vista de login
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Autentica al usuario
        $request->authenticate();

        // Regenera la sesión para evitar ataques de fijación de sesión
        $request->session()->regenerate();

        // Verifica si el usuario es administrador
        if (auth()->user()->email === "admin@gmail.com") {
            return redirect('/admin'); // Redirige al panel de administración
        }

        // Si no es administrador, redirige a la página principal
        return redirect('/'); // Redirige a la página principal
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirige a la página principal después del logout
    }
}