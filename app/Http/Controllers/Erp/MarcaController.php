<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarcaRequest;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function vistaTodas()
    {
        $marcas = Marca::withTrashed()->get();
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
        $marca = Marca::withTrashed()->find($id);
        return view('erp.marca.editar', compact('marca'));
    }

    public function editar(MarcaRequest $request, $id)
    {
        $marca = Marca::withTrashed()->findOrFail($id);
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->activo = $request->activo;
        $marca->save();

        return redirect()->route('erp.marca.vista.todas')->with('alerta', 'Actualizado');
    }

    public function restaurar($id)
    {
        $marca = Marca::withTrashed()->findOrFail($id);

        $marca->restore();

        return redirect()->route('erp.marca.vista.todas')->with('alerta', 'Actualizado');
    }

    public function eliminar($id)
    {
        $marca = Marca::withTrashed()->find($id);
        $marca->delete();

        return redirect()->route('erp.marca.vista.todas')->with('alerta', 'Eliminado');
    }

    public function getEcommerceProductosConStockMarcaAlmacenListaPrecio($almacenId, $listaPrecioId, $marcaId, $categorias = [], $precios = [])
    {
        $minPrecio = !empty($precios) ? min(array_column($precios, 'precio_inicio')) : null;
        $maxPrecio = !empty($precios) ? max(array_column($precios, 'precio_fin')) : null;

        $query = Producto::where('marca_id', $marcaId)
            ->whereHas('variaciones.inventarios', function ($query) use ($almacenId) {
                $query->where('almacen_id', $almacenId)
                    ->where('stock', '>', 0);
            })
            ->whereHas('listaPrecios', function ($query) use ($listaPrecioId, $minPrecio, $maxPrecio) {
                $query->where('lista_precio_id', $listaPrecioId)
                    ->where('precio', '>', 0);

                if ($minPrecio !== null) {
                    $query->where('precio', '>=', $minPrecio);
                }
                if ($maxPrecio !== null) {
                    $query->where('precio', '<=', $maxPrecio);
                }
            })
            ->with([
                'marca',
                'variaciones.inventarios' => function ($query) use ($almacenId) {
                    $query->where('almacen_id', $almacenId)
                        ->where('stock', '>', 0);
                },
                'imagens',
                'descuentos' => function ($query) use ($listaPrecioId) {
                    $query->where('lista_precio_id', $listaPrecioId)
                        ->where('fecha_fin', '>', now());
                },
                'listaPrecios' => function ($query) use ($listaPrecioId, $minPrecio, $maxPrecio) {
                    $query->where('lista_precio_id', $listaPrecioId)
                        ->where('precio', '>', 0);

                    if ($minPrecio !== null) {
                        $query->where('precio', '>=', $minPrecio);
                    }
                    if ($maxPrecio !== null) {
                        $query->where('precio', '<=', $maxPrecio);
                    }
                }
            ]);

        if (!empty($categorias)) {
            $query->whereIn('categoria_id', $categorias);
        }

        return $query->paginate(10);
    }
}
