<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    public function vistaTodas()
    {
        $categorias = Categoria::all();
        return view('erp.categoria.todas', compact('categorias'));
    }

    public function vistaCrear()
    {
        return view('erp.categoria.crear');
    }

    public function crear(CategoriaRequest $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->slug = Str::slug($request->slug, '-');
        $categoria->descripcion = $request->descripcion;
        $categoria->icono = $request->icono;
        $categoria->activo = $request->activo;
        $categoria->save();

        return redirect()->route('erp.categoria.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaVer($id)
    {
        $categoria = Categoria::find($id);
        return view('erp.categoria.ver', compact('categoria'));
    }

    public function vistaEditar($id)
    {
        $categoria = Categoria::find($id);
        return view('erp.categoria.editar', compact('categoria'));
    }

    public function editar(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->nombre = $request->nombre;
        $categoria->slug = Str::slug($request->slug, '-');
        $categoria->descripcion = $request->descripcion;
        $categoria->icono = $request->icono;
        $categoria->activo = $request->activo;
        $categoria->save();

        return redirect()->route('erp.categoria.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect()->route('erp.categoria.vista.todas')->with('alerta', 'Eliminado');
    }
}
