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
                    [$min, $max] = explode(' - ', str_replace(['S/', 'Desde'], '', $rango));
                    $query->orWhereBetween('precio', [(int) $min, $max ? (int) $max : PHP_INT_MAX]);
                }
            });
        }

        return $query->get();
    }
}
