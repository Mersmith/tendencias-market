<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
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
                'nombre' => 'required|min:3|max:255|unique:marcas,nombre,' . $id,
                'descripcion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        } else {
            return [
                'nombre' => 'required|min:3|max:255|unique:marcas',
                'descripcion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'descripcion' => 'descripción',
            'activo' => 'activo',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'No debe ser vacio.',
            'nombre.min' => 'Más de :min dígitos.',
            'nombre.max' => 'Menos de :max dígitos',
            'nombre.unique' => 'Este :attribute ya existe',


            'descripcion.required' => 'No debe ser vacio.',
            'descripcion.min' => 'Más de :min dígitos.',
            'descripcion.max' => 'Menos de :max dígitos',

            'activo.required' => 'No debe ser vacio.',
            'activo.numeric' => 'Debe ser un número.',
            'activo.regex' => 'Solo un dígito.',
        ];
    }

}
