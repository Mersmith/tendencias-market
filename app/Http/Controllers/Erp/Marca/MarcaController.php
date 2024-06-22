<?php

namespace App\Http\Controllers\Erp\Marca;
;

use App\Http\Controllers\Controller;
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

    public function crear(Request $request)
    {
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->save();

        return redirect()->route('marca.vista.todas')->with('mensajeCrud', 'Se creo correctamente.');
    }

    public function vistaVer($id)
    {
        $marca = Marca::find($id);
        return view('erp.marca.ver', compact('marca'));
    }

    public function vistaEditar($id)
    {
        $marca = Marca::find($id);
        return view('erp.marca.editar', compact('marca'));
    }

    public function editar(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->save();

        return redirect()->route('marca.vista.todas')->with('mensajeCrud', 'Se edito correctamente.');
    }

    public function eliminar($id)
    {
        $marca = Marca::find($id);
        $marca->delete();

        return redirect()->route('marca.vista.todas')->with('mensajeCrud', 'Se elimino correctamente.');
    }
}
