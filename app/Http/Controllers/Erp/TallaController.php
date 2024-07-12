<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Http\Requests\TallaRequest;
use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    public function vistaTodas()
    {
        $tallas = Talla::all();
        return view('erp.talla.todas', compact('tallas'));
    }

    public function vistaCrear()
    {
        return view('erp.talla.crear');
    }

    public function crear(TallaRequest $request)
    {
        $talla = new Talla();
        $talla->nombre = $request->nombre;
        $talla->activo = $request->activo;
        $talla->save();

        return redirect()->route('erp.talla.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaEditar($id)
    {
        $talla = Talla::find($id);
        return view('erp.talla.editar', compact('talla'));
    }

    public function editar(TallaRequest $request, $id)
    {
        $talla = Talla::findOrFail($id);
        $talla->nombre = $request->nombre;
        $talla->activo = $request->activo;
        $talla->save();

        return redirect()->route('erp.talla.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $talla = Talla::find($id);
        $talla->delete();

        return redirect()->route('erp.talla.vista.todas')->with('alerta', 'Eliminado');
    }
}
