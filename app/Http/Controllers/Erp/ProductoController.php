<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function getEcommerceProductosConStockCategoriaAlmacenListaPrecio($almacenId, $listaPrecioId, $categoriaId, $marcas = [], $precios = [])
    {
        $minPrecio = !empty($precios) ? min(array_column($precios, 'precio_inicio')) : null;
        $maxPrecio = !empty($precios) ? max(array_column($precios, 'precio_fin')) : null;

        $query = Producto::where('categoria_id', $categoriaId)
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

        if (!empty($marcas)) {
            $query->whereIn('marca_id', $marcas);
        }

        //return $query->get();
        return $query->paginate(10);
    }
}
