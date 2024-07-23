<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function getEcommerceProductosConStockCategoriaAlmacenListaPrecio($almacenId, $listaPrecioId, $categoriaId, $marcas = [], $precios = [])
    {
        $query = Producto::where('categoria_id', $categoriaId)
            ->whereHas('variaciones.inventarios', function ($query) use ($almacenId) {
                $query->where('almacen_id', $almacenId)
                    ->where('stock', '>', 0);
            })
            ->whereHas('listaPrecios', function ($query) use ($listaPrecioId) {
                $query->where('lista_precio_id', $listaPrecioId)
                    ->where('precio', '>', 0);
            })
            ->with([
                'marca',
                'variaciones.inventarios' => function ($query) use ($almacenId) {
                    $query->where('almacen_id', $almacenId)
                        ->where('stock', '>', 0);
                },
                'imagens',
                'descuentos' => function ($query) use ($listaPrecioId) {
                    $query->where('lista_precio_id', $listaPrecioId)->where('fecha_fin', '>', now());
                },
                'listaPrecios' => function ($query) use ($listaPrecioId) {
                    $query->where('lista_precio_id', $listaPrecioId)
                        ->where('precio', '>', 0);
                }
            ]);

        if (!empty($marcas)) {
            $query->whereIn('marca_id', $marcas);
        }

        if (!empty($precios)) {
            $query->where(function ($query) use ($precios) {
                foreach ($precios as $rango) {
                    $precioInicio = $rango['precio_inicio'];
                    $precioFin = $rango['precio_fin'];

                    $query->orWhereHas('listaPrecios', function ($query) use ($precioInicio, $precioFin) {
                        if ($precioFin !== null) {
                            $query->whereBetween('precio', [$precioInicio, $precioFin]);
                        } else {
                            $query->where('precio', '>=', $precioInicio);
                        }
                    });
                }
            });
        }

        return $query->get();
    }
}
