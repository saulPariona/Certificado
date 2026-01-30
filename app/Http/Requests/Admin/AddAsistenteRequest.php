<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddAsistenteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'asistente' => 'required|exists:users,id', // tiene que existir y estar en la tabla users en la columna id
        ];
    }
    public function messages(): array
    {
        return [
            'asistente.required' => 'El asistente es requerido',
            'asistente.exists' => 'El asistente no existe',
        ];
    }
}
