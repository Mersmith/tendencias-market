<?php

namespace App\Http\Controllers\Erp\Marca;

;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarcaRequest;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function vistaTodas()
    {
        $marcas = Marca::all();
        return view('erp.marca.todas', compact('marcas'));
    }

    public function vistaCrear()
    {
        return view('erp.marca.crear');
    }

    public function crear(MarcaRequest $request)
    {
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->activo = $request->activo;
        $marca->save();

        return redirect()->route('erp.marca.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaEditar($id)
    {
        $marca = Marca::find($id);
        return view('erp.marca.editar', compact('marca'));
    }

    public function editar(MarcaRequest $request, $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->activo = $request->activo;
        $marca->save();

        return redirect()->route('erp.marca.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $marca = Marca::find($id);
        $marca->delete();

        return redirect()->route('erp.marca.vista.todas')->with('alerta', 'Eliminado');
    }
}
