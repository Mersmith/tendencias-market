<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuiaSalidaDirectoRequest extends FormRequest
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
            'descripcion' => 'required|string',
            'observacion' => 'nullable|string',
            'fecha_salida' => 'required|date',
            'estado' => 'required|in:Aprobado,Rechazado,Observado,Eliminado',
            'sede_id' => 'required',
            'almacen_id' => 'required',
            'serie_id' => 'required',
            'detalles' => 'required|array|min:1',
            'detalles.*.cantidad' => 'required|integer|min:1',
        ];
    }

    public function attributes(): array
    {
        return [
            'descripcion' => 'descripción',
            'observacion' => 'observacion',
            'fecha_salida' => 'fecha salida',
            'subcategoria_id' => 'subcategoria',
            'estado' => 'estado',
            'sede_id' => 'sede',
            'almacen_id' => 'almacén',
            'serie_id' => 'serie',
            'detalles' => 'detalle',
            'detalles.*.cantidad' => 'cantidad',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'No debe ser vacio.',
            'descripcion.string' => 'Debe ser texto.',

            'observacion.string' => 'Debe ser texto.',

            'fecha_salida.required' => 'No debe ser vacio.',
            'fecha_salida.date' => 'Debe ser fecha.',

            'estado.required' => 'No debe ser vacio.',

            'sede_id.required' => 'No debe ser vacio.',
            'almacen_id.required' => 'No debe ser vacio.',
            'serie_id.required' => 'No debe ser vacio.',

            'detalles.required' => 'No debe ser vacio.',
        ];
    }
}
