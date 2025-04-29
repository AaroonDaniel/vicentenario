<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // o tu lógica de autorización
    }

    public function rules()
    {
        $userId = $this->user()->id;

        return [
            'name'    => ['required','string','max:255'],
            'email'   => ['required','email','max:255', Rule::unique('users')->ignore($userId)],
            'gender'  => ['nullable','in:male,female,other'],
            'country' => ['nullable','string','max:255'],
            'city'    => ['nullable','string','max:255'],
        ];
    }
}
