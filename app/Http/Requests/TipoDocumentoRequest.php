<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoDocumentoRequest extends FormRequest
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
        $id = $this->id;

        if ($id) {
            return [
                'nombre' => 'required|min:3|max:255|unique:tipo_documentos,nombre,' . $id,
            ];
        } else {
            return [
                'nombre' => 'required|min:3|max:255|unique:tipo_documentos',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'No debe ser vacio.',
            'nombre.min' => 'Más de :min dígitos.',
            'nombre.max' => 'Menos de :max dígitos',
            'nombre.unique' => 'Este :attribute ya existe',
        ];
    }
}
