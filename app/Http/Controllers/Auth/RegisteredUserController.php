<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use WisdomDiala\Countrypkg\Models\Country;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Generar un CAPTCHA simple (por ejemplo, una suma)
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        $captchaResult = $num1 + $num2;

        // Almacenar el resultado en la sesión
        Session::put('captcha_result', $captchaResult);

        // Obtener todos los países
        $countries = Country::all();

        // Pasar los números del CAPTCHA y los países a la vista
        return view('auth.register', [
            'captchaNum1' => $num1,
            'captchaNum2' => $num2,
            'countries' => $countries,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        // Validar el formulario
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'in:male,female,other'], // Validación para género
            'country' => ['required', 'string', 'max:255'], // Validación para país
            'city' => ['required', 'string', 'max:255'], // Validación para ciudad
            'captcha' => ['required', 'numeric'], // Validación para el CAPTCHA
        ];



        $validator = Validator::make($request->all(), $rules);

        // Validar el CAPTCHA
        $captchaResult = Session::get('captcha_result');
        if ($request->captcha != $captchaResult) {
            $validator->errors()->add('captcha', 'El CAPTCHA es incorrecto.');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Si el CAPTCHA es correcto, continuar con el registro
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender, // Nuevo campo
            'country' => $request->country, // Nuevo campo
            'city' => $request->city, // Nuevo campo
        ]);

        $user->assignRole('Usuario casual');

        // Disparar el evento de registro
        event(new Registered($user));

        // Autenticar al usuario
        Auth::login($user);

        // Limpiar el CAPTCHA de la sesión después de usarlo
        Session::forget('captcha_result');

        // Redirigir al usuario después del registro
        return redirect(RouteServiceProvider::HOME)->with('success', '¡Registro exitoso!');
    }
}
