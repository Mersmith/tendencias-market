<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function getEcommerceProductosConStockCategoriaAlmacenListaPrecio($categoriaId, $marcas = [], $precios = [])
    {
        $query = Producto::where('categoria_id', $categoriaId)
            ->whereHas('variaciones.inventarios', function ($query) {
                $query->where('almacen_id', 1)
                    ->where('stock', '>', 0);
            })
            ->with([
                'marca',
                'variaciones' => function ($query) {
                    $query->whereHas('inventarios', function ($subQuery) {
                        $subQuery->where('almacen_id', 1)
                            ->where('stock', '>', 0);
                    });
                },
                'imagens',
                'descuentos' => function ($query) {
                    $query->where('lista_precio_id', 3);
                },
                'listaPrecios' => function ($query) {
                    $query->where('lista_precio_id', 3);
                }
            ]);

        if (!empty($marcas)) {
            $query->whereIn('marca_id', $marcas);
        }

        if (!empty($precios)) {
            $query->where(function ($query) use ($precios) {
                foreach ($precios as $rango) {
                    $precio_inicio = $rango['precio_inicio'];
                    $precio_fin = $rango['precio_fin'];

                    $query->orWhereHas('listaPrecios', function ($query) use ($precio_inicio, $precio_fin) {
                        if ($precio_fin !== null) {
                            $query->whereBetween('precio', [$precio_inicio, $precio_fin]);
                        } else {
                            $query->where('precio', '>=', $precio_inicio);
                        }
                    });
                }
            });
        }

        return $query->get();
    }
}
