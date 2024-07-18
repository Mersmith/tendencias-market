<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubcategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoriaController extends Controller
{
    public function vistaTodas()
    {
        $categoriasPadres = Categoria::whereNull('categoria_padre_id')->get();
        $subcategorias = Categoria::whereIn('categoria_padre_id', $categoriasPadres->pluck('id'))->get();

        return view('erp.subcategoria.todas', compact('subcategorias'));
    }

    public function vistaCrear()
    {
        $categorias = Categoria::whereNull('categoria_padre_id')->get();

        return view('erp.subcategoria.crear', compact('categorias'));
    }

    public function crear(SubcategoriaRequest $request)
    {
        $categoria = new Categoria();
        $categoria->codigo = $request->codigo;
        $categoria->nombre = $request->nombre;
        $categoria->slug = Str::slug($request->slug, '-');
        $categoria->descripcion = $request->descripcion;
        $categoria->icono = $request->icono;
        $categoria->activo = $request->activo;
        $categoria->categoria_padre_id = $request->categoria_padre_id;
        $categoria->orden = $request->orden;
        $categoria->save();

        return redirect()->route('erp.subcategoria.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaVer($id)
    {
        $subcategoria = Categoria::find($id);
        return view('erp.subcategoria.ver', compact('subcategoria'));
    }

    public function vistaEditar($id)
    {
        $categorias = Categoria::whereNull('categoria_padre_id')->get();
        $subcategoria = Categoria::find($id);
        return view('erp.subcategoria.editar', compact('subcategoria', 'categorias'));
    }

    public function editar(SubcategoriaRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->codigo = $request->codigo;
        $categoria->nombre = $request->nombre;
        $categoria->slug = Str::slug($request->slug, '-');
        $categoria->descripcion = $request->descripcion;
        $categoria->icono = $request->icono;
        $categoria->activo = $request->activo;
        $categoria->categoria_padre_id = $request->categoria_padre_id;
        $categoria->orden = $request->orden;
        $categoria->save();

        return redirect()->route('erp.subcategoria.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect()->route('erp.subcategoria.vista.todas')->with('alerta', 'Eliminado');
    }
}
