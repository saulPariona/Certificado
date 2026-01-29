<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCertificadoBaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // solo personas logeadas y siendo administrador
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'base' => 'required|file|image|max:4096', // el file es un archivo y el image es una imagen
        ];
    }
    public function messages()
    {
        return [
            'base.required' => 'El certificado base es obligatorio',
            'base.file' => 'El certificado base debe ser un archivo',
            'base.image' => 'El certificado base debe ser una imagen',
            'base.max' => 'El certificado base debe tener un tamaño maximo de 4MB',
        ];
    }
}
