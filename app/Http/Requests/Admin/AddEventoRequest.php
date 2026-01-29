<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddEventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // si esta autenticado y es admin, se le permite hacer la peticion
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'fecha' => 'required | date',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'fecha.required' => 'La fecha es obligatoria',
            'fecha.date' => 'La fecha debe ser una fecha valida',
            'fecha.after' => 'La fecha debe ser mayor a la fecha actual',
        ];
    }
}
