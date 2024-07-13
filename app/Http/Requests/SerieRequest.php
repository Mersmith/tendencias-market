<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SerieRequest extends FormRequest
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
                'tipo_documento_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:series,nombre,' . $id,
                'correlativo' => 'required|integer|min:0',
                'descripcion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        } else {
            return [
                'sede_id' => 'required',
                'tipo_documento_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:series',
                'correlativo' => 'required|integer|min:0',
                'descripcion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'sede_id' => 'sede',
            'tipo_documento_id' => 'tipo documento',
            'nombre' => 'serie',
            'correlativo' => 'correlativo',
            'descripcion' => 'descripción',
            'activo' => 'activo',
        ];
    }

    public function messages()
    {
        return [
            'sede_id' => 'Debe seleccionar.',

            'tipo_documento_id' => 'Debe seleccionar.',

            'nombre.required' => 'No debe ser vacio.',
            'nombre.min' => 'Más de :min dígitos.',
            'nombre.max' => 'Menos de :max dígitos',
            'nombre.unique' => 'Esta :attribute ya existe',

            'correlativo.required' => 'No debe ser vacio.',
            'correlativo.integer' => 'Debe ser número entero',
            'correlativo.min' => 'Más de :min dígitos.',

            'descripcion.required' => 'No debe ser vacio.',
            'descripcion.min' => 'Más de :min dígitos.',
            'descripcion.max' => 'Menos de :max dígitos',

            'activo.required' => 'No debe ser vacio.',
            'activo.numeric' => 'Debe ser un número.',
            'activo.regex' => 'Solo un dígito.',
        ];
    }
}
