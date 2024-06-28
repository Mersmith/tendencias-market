<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoriaRequest;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoriaController extends Controller
{
    public function vistaTodas()
    {
        $subcategorias = Subcategoria::with('categoria')->orderBy('categoria_id')->get();
        return view('erp.subcategoria.todas', compact('subcategorias'));
    }

    public function vistaCrear()
    {
        $categorias = Categoria::all();
        return view('erp.subcategoria.crear', compact('categorias'));
    }

    public function crear(SubcategoriaRequest $request)
    {
        $subcategoria = new Subcategoria();
        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $subcategoria->slug = Str::slug($request->slug, '-');
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->icono = $request->icono;
        $subcategoria->activo = $request->activo;
        $subcategoria->save();

        return redirect()->route('erp.subcategoria.vista.todas')->with('alerta', 'Creado');
    }

    public function vistaVer($id)
    {
        $subcategoria = Subcategoria::find($id);
        return view('erp.subcategoria.ver', compact('subcategoria'));
    }

    public function vistaEditar($id)
    {
        $categorias = Categoria::all();
        $subcategoria = Subcategoria::find($id);
        return view('erp.subcategoria.editar', compact('subcategoria', 'categorias'));
    }

    public function editar(SubcategoriaRequest $request, $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $subcategoria->categoria_id = $request->categoria_id;
        $subcategoria->nombre = $request->nombre;
        $subcategoria->slug = Str::slug($request->slug, '-');
        $subcategoria->descripcion = $request->descripcion;
        $subcategoria->icono = $request->icono;
        $subcategoria->activo = $request->activo;
        $subcategoria->save();

        return redirect()->route('erp.subcategoria.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $subcategoria = Subcategoria::find($id);
        $subcategoria->delete();

        return redirect()->route('erp.subcategoria.vista.todas')->with('alerta', 'Eliminado');
    }
}
