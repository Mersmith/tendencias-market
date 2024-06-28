<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlmacenRequest;
use App\Models\Almacen;
use App\Models\Sede;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{

    public function vistaTodas()
    {
        $almacenes = Almacen::with('sede')->orderBy('sede_id')->get();
        return view('erp.almacen.todas', compact('almacenes'));
    }

    public function vistaCrear()
    {
        $sedes = Sede::all();
        return view('erp.almacen.crear', compact('sedes'));
    }

    public function crear(AlmacenRequest $request)
    {
        $almacen = new Almacen();
        $almacen->sede_id = $request->sede_id;
        $almacen->nombre = $request->nombre;
        $almacen->ubicacion = $request->ubicacion;
        $almacen->activo = $request->activo;
        $almacen->save();

        return redirect()->route('erp.almacen.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaVer($id)
    {
        $almacen = Almacen::find($id);
        return view('erp.almacen.ver', compact('almacen'));
    }
    public function vistaEditar($id)
    {
        $sedes = Sede::all();
        $almacen = Almacen::find($id);
        return view('erp.almacen.editar', compact('almacen', 'sedes'));
    }

    public function editar(AlmacenRequest $request, $id)
    {
        $almacen = Almacen::findOrFail($id);

        $almacen->sede_id = $request->sede_id;
        $almacen->nombre = $request->nombre;
        $almacen->ubicacion = $request->ubicacion;
        $almacen->activo = $request->activo;
        $almacen->save();

        return redirect()->route('erp.almacen.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $almacen = Almacen::find($id);
        $almacen->delete();

        return redirect()->route('erp.almacen.vista.todas')->with('alerta', 'Eliminado');
    }
}
