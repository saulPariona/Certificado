<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddPonenteRequest extends FormRequest
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
            'ponente' => 'required|exists:users,id',
            'ponencia' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ponente.required' => 'El ponente es obligatorio',
            'ponente.exists' => 'El ponente no existe',
            'ponencia.required' => 'La ponencia es obligatoria',

        ];
    }
}
