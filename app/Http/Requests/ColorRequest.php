<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
                'nombre' => 'required|min:3|max:255|unique:colors,nombre,' . $id,
                'codigo_color' => 'required|min:3|max:255|unique:colors,codigo_color,' . $id,
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        } else {
            return [
                'nombre' => 'required|min:3|max:255|unique:colors',
                'codigo_color' => 'required|min:3|max:255|unique:colors',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'color',
            'codigo_color' => 'codigo de color',
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

            'codigo_color.required' => 'No debe ser vacio.',
            'codigo_color.min' => 'Más de :min dígitos.',
            'codigo_color.max' => 'Menos de :max dígitos',
            'codigo_color.unique' => 'Este :attribute ya existe',

            'activo.required' => 'No debe ser vacio.',
            'activo.numeric' => 'Debe ser un número.',
            'activo.regex' => 'Solo un dígito.',
        ];
    }
}
