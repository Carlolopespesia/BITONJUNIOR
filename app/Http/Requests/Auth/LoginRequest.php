<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest /*Para el login utilizamos tambien FormRequest
para validar que los campos son obligatorios y que dicho usuario ya este regsitrado previamente.*/ 
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email:rfc,dns'],/*Aqui le estamos poniendo la regla de
            que valie el formato estandar de email, y compruebe que el dominio tenga DNS válidos */
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El formato del correo electrónico no es válido.', //Preguntar si es para comprobar que exista el email en la bdd
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}