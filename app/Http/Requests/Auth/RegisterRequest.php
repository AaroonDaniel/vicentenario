<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8) // Mínimo 8 caracteres
                    ->mixedCase() // Al menos una mayúscula y una minúscula
                    ->numbers() // Al menos un número
                    ->symbols() // Al menos un carácter especial
                    ->uncompromised(), // Verifica que la contraseña no esté comprometida
            ],
            'gender' => ['required', 'string', 'in:male,female,other'], // Validación para género
            'country' => ['required', 'string', 'max:255'], // Validación para país
            'city' => ['required', 'string', 'max:255'], // Validación para ciudad
        ];
    }
}