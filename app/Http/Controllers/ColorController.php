<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function vistaTodas()
    {
        $colores = Color::all();
        return view('erp.color.todas', compact('colores'));
    }

    public function vistaCrear()
    {
        return view('erp.color.crear');
    }

    public function crear(ColorRequest $request)
    {
        $color = new Color();
        $color->nombre = $request->nombre;
        $color->codigo_color = $request->codigo_color;
        $color->activo = $request->activo;
        $color->save();

        return redirect()->route('erp.color.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaEditar($id)
    {
        $color = Color::find($id);
        return view('erp.color.editar', compact('color'));
    }

    public function editar(ColorRequest $request, $id)
    {
        $color = Color::findOrFail($id);
        $color->nombre = $request->nombre;
        $color->codigo_color = $request->codigo_color;
        $color->activo = $request->activo;
        $color->save();

        return redirect()->route('erp.color.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $color = Color::find($id);
        $color->delete();

        return redirect()->route('erp.color.vista.todas')->with('alerta', 'Eliminado');
    }
}
