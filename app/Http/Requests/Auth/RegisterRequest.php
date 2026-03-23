<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password; //pregunta - rules/password

class RegisterRequest extends FormRequest /*Para capturar los errores en
las validaciones utilizamos FormRequest, que es una clase dedicada a validar y asi dejamos
un controller mas limpio. */

{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'surname_1' => ['required', 'string', 'max:50'],
            'surname_2' => ['nullable', 'string', 'max:50'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', Password::min(8)->numbers(),//minimo 8 caracteres al menos un numero
            ],
        ];
    }

    public function messages(): array
    {
       return [
            'name.required' => 'El nombre es obligatorio.',
            'surname_1.required' => 'El primer apellido es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'Ya existe un usuario registrado con ese correo.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.numbers' => 'La contraseña debe contener al menos un número.',
        ];
    }
}