<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlmacenRequest extends FormRequest
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
                'sede_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:almacens,nombre,' . $id,
                'ubicacion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        } else {
            return [
                'sede_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:almacens',
                'ubicacion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'sede_id' => 'categoria',
            'nombre' => 'sede',
            'ubicacion' => 'ubicación',
            'activo' => 'activo',
        ];
    }

    public function messages()
    {
        return [
            'sede_id' => 'Debe seleccionar.',

            'nombre.required' => 'No debe ser vacio.',
            'nombre.min' => 'Más de :min dígitos.',
            'nombre.max' => 'Menos de :max dígitos',
            'nombre.unique' => 'Esta :attribute ya existe',

            'ubicacion.required' => 'No debe ser vacio.',
            'ubicacion.min' => 'Más de :min dígitos.',
            'ubicacion.max' => 'Menos de :max dígitos',

            'activo.required' => 'No debe ser vacio.',
            'activo.numeric' => 'Debe ser un número.',
            'activo.regex' => 'Solo un dígito.',
        ];
    }
}
