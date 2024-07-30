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
        $categorias = Categoria::orderBy('created_at', 'desc')->get();
        return view('erp.categoria.todas', compact('categorias'));
    }

    public function vistaCrear()
    {
        //$categorias = Categoria::all();

        return view('erp.categoria.crear');
    }

    public function crear(CategoriaRequest $request)
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
        //$categorias = Categoria::all();

        return view('erp.categoria.editar', compact('categoria'));
    }

    public function editar(CategoriaRequest $request, $id)
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

        return redirect()->route('erp.categoria.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect()->route('erp.categoria.vista.todas')->with('alerta', 'Eliminado');
    }

    public function getEcommerceCategoriaAnidadas()
    {
        $categoriasNivel1 = Categoria::whereNull('categoria_padre_id')->where('activo', 1)->orderBy('orden')->get();

        return $categoriasNivel1->map(function ($categoria) {
            return $this->formatearCategoria($categoria);
        });
    }

    private function formatearCategoria($categoria)
    {
        $subcategorias = $categoria->subcategorias->map(function ($subcategoria) {
            return $this->formatearCategoria($subcategoria);
        });

        return [
            'id' => $categoria->id,
            'nombre' => $categoria->nombre,
            'slug' => $categoria->slug,
            'descripcion' => $categoria->descripcion,
            'icono' => $categoria->icono,
            'imagen_ruta' => $categoria->imagen_ruta,
            'subcategorias' => $subcategorias,
        ];
    }


    public function getCategoriaFamiliaVertical(Categoria $categoria)
    {
        $familia = collect();

        // Agregar la categoría actual
        $familia->push($categoria);

        // Agregar la categoría padre si existe
        if ($categoria->categoriaPadre) {
            $familia->prepend($categoria->categoriaPadre);
        }

        // Agregar las subcategorias
        foreach ($categoria->subcategorias as $subcategoria) {
            $familia->push($subcategoria);
        }

        return $familia;
    }
}
