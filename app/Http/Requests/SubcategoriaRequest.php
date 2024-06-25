<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class SubcategoriaRequest extends FormRequest
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
                'categoria_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:subcategorias,nombre,' . $id,
                'slug' => 'required|min:3|max:255|unique:subcategorias,slug,' . $id,
                'descripcion' => 'required|min:3|max:255',
                //'icono' => 'min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        } else {
            return [
                'categoria_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:subcategorias',
                'slug' => 'required|min:3|max:255|unique:subcategorias',
                'descripcion' => 'required|min:3|max:255',
                //'icono' => 'min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'categoria_id' => 'categoria',
            'nombre' => 'nombre',
            'slug' => 'url',
            'descripcion' => 'descripción',
            'icono' => 'icono',
            'activo' => 'activo',
        ];
    }

    public function messages()
    {
        return [
            'categoria_id' => 'Debe seleccionar.',
            'nombre.required' => 'No debe ser vacio.',
            'nombre.min' => 'Más de :min dígitos.',
            'nombre.max' => 'Menos de :max dígitos',
            'nombre.unique' => 'Este :attribute ya existe',

            'slug.required' => 'No debe ser vacio.',
            'slug.min' => 'Más de :min dígitos.',
            'slug.max' => 'Menos de :max dígitos',
            'slug.unique' => 'Este :attribute ya existe',

            'descripcion.required' => 'No debe ser vacio.',
            'descripcion.min' => 'Más de :min dígitos.',
            'descripcion.max' => 'Menos de :max dígitos',

            'icono.min' => 'Más de :min dígitos.',
            'icono.max' => 'Menos de :max dígitos',

            'activo.required' => 'No debe ser vacio.',
            'activo.numeric' => 'Debe ser un número.',
            'activo.regex' => 'Solo un dígito.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug),
        ]);
    }
}
