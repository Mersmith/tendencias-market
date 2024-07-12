<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListaPrecioRequest;
use App\Models\ListaPrecio;
use Illuminate\Http\Request;

class ListaPrecioController extends Controller
{
    public function vistaTodas()
    {
        $lista_precios = ListaPrecio::all();
        return view('erp.lista-precio.todas', compact('lista_precios'));
    }

    public function vistaCrear()
    {
        return view('erp.lista-precio.crear');
    }

    public function crear(ListaPrecioRequest $request)
    {
        $lista_precio = new ListaPrecio();
        $lista_precio->nombre = $request->nombre;
        $lista_precio->activo = $request->activo;
        $lista_precio->save();

        return redirect()->route('erp.lista-precio.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaEditar($id)
    {
        $lista_precio = ListaPrecio::find($id);
        return view('erp.lista-precio.editar', compact('lista_precio'));
    }

    public function editar(ListaPrecioRequest $request, $id)
    {
        $lista_precio = ListaPrecio::findOrFail($id);
        $lista_precio->nombre = $request->nombre;
        $lista_precio->activo = $request->activo;
        $lista_precio->save();

        return redirect()->route('erp.lista-precio.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $lista_precio = ListaPrecio::find($id);
        $lista_precio->delete();

        return redirect()->route('erp.lista-precio.vista.todas')->with('alerta', 'Eliminado');
    }
}
