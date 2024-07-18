<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function getEcommerceProductosConStockCategoriaAlmacenListaPrecio($categoriaId)
    {
        return Producto::where('categoria_id', $categoriaId)
            ->whereHas('variaciones.inventarios', function ($query) {
                $query->where('almacen_id', 1)
                    ->where('stock', '>', 0);
            })
            ->with([
                'variaciones' => function ($query) {
                    $query->whereHas('inventarios', function ($subQuery) {
                        $subQuery->where('almacen_id', 1)
                            ->where('stock', '>', 0);
                    })
                        ->with([
                            'inventarios' => function ($subQuery) {
                                $subQuery->where('almacen_id', 1)
                                    ->where('stock', '>', 0);
                            }
                        ])
                        ->take(1);
                },
                'imagens',
                'descuentos' => function ($query) {
                    $query->where('lista_precio_id', 3);
                },
                'listaPrecios' => function ($query) {
                    $query->where('lista_precio_id', 3);
                }
            ])
            ->get();
    }
}
