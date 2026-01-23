<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // si es true, significa que el usuario esta autorizado para hacer la peticion
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email', // required significa que el campo es obligatorio, email significa que el campo debe ser un email, esto es antes de pasar al controlador, tabla users y columna email
            'password' => 'required', // required significa que el campo es obligatorio
        ];
        //return parent::rules(); // esto es para que se muestren las reglas por defecto
    }
    public function messages(): array
    {
        return [
            'email.required' => 'El email es obligatorio', // required significa que el campo es obligatorio
            'email.email' => 'El email debe tener @ y (.)', // email significa que el campo debe ser un email
            'email.exists' => 'El email no existe', // exists significa que el email debe existir en la tabla users
            'password.required' => 'La contraseña es obligatoria', // required significa que el campo es obligatorio
        ];
        //return parent::messages(); // esto es para que se muestren los mensajes por defecto
    }
}
