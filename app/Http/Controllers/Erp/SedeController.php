<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Http\Requests\SedeRequest;
use App\Models\Sede;
use Illuminate\Http\Request;

class SedeController extends Controller
{
    public function vistaTodas()
    {
        $sedes = Sede::all();
        return view('erp.sede.todas', compact('sedes'));
    }

    public function vistaCrear()
    {
        return view('erp.sede.crear');
    }

    public function crear(SedeRequest $request)
    {
        $sede = new Sede();
        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;
        $sede->activo = $request->activo;
        $sede->save();

        return redirect()->route('erp.sede.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaEditar($id)
    {
        $sede = Sede::find($id);
        return view('erp.sede.editar', compact('sede'));
    }

    public function editar(SedeRequest $request, $id)
    {
        $sede = Sede::findOrFail($id);
        $sede->nombre = $request->nombre;
        $sede->direccion = $request->direccion;
        $sede->activo = $request->activo;
        $sede->save();

        return redirect()->route('erp.sede.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $sede = Sede::find($id);
        $sede->delete();

        return redirect()->route('erp.sede.vista.todas')->with('alerta', 'Eliminado');
    }
}
