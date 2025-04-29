<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use WisdomDiala\Countrypkg\Models\Country;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Mostrar el formulario de edición de perfil (Blade).
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Cargar todos los países del paquete countrypkg
        $countries = Country::all();

        // Pasar las variables a la vista
        return view('profile.edit', compact('user', 'countries'));
        return view('profile.edit', [
            'user'            => $request->user(),
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status'          => session('status'),
        ]);
    }

    /**
     * Actualizar datos del perfil.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->user_id, 'user_id'),
            ],
            'gender' => ['nullable', 'in:male,female,other'],
            'country' => ['required', 'exists:countries,id'], // ← Aquí el cambio
            'city' => ['required', 'exists:states,id'],       // ← Si city también es NOT NULL
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'gender' => $validated['gender'] ?? null,
            'country' => $validated['country'],
            'city' => $validated['city'],
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Eliminar la cuenta.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
