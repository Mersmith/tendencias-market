<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProductoRequest extends FormRequest
{
    protected $productoId;

    public function __construct($productoId = null)
    {
        $this->productoId = $productoId;
    }

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
        $id = $this->productoId;

        if ($id) {
            return [
                'categoria_id' => 'required',
                'marca_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:productos,nombre,' . $id,
                'slug' => 'required|min:3|max:255|unique:productos,slug,' . $id,
                'descripcion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        } else {
            return [
                'categoria_id' => 'required',
                'marca_id' => 'required',
                'nombre' => 'required|min:3|max:255|unique:productos',
                'slug' => 'required|min:3|max:255|unique:productos',
                'descripcion' => 'required|min:3|max:255',
                'activo' => 'required|numeric|regex:/^\d{1}$/',
            ];
        }
    }

    public function attributes(): array
    {
        return [
            'categoria_id' => 'subcategoria',
            'marca_id' => 'marca',
            'nombre' => 'nombre',
            'slug' => 'url',
            'descripcion' => 'descripción',
            'activo' => 'activo',
        ];
    }

    public function messages()
    {
        return [
            'categoria_id.required' => 'No debe ser vacio.',
            'marca_id.required' => 'No debe ser vacio.',

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
