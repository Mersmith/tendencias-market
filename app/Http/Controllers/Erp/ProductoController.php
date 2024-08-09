<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getEcommerceProducto($id)
    {
        $data_productos_variaciones = DB::table('productos')
            ->join('variacions', 'productos.id', '=', 'variacions.producto_id')
            ->join('inventarios', 'variacions.id', '=', 'inventarios.variacion_id')
            ->join('producto_lista_precios', function ($join) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', 3)
                    ->where('producto_lista_precios.precio', '>', 0);
            })
            ->leftJoin('producto_descuentos', function ($join) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', 3)
                    ->where('producto_descuentos.fecha_fin', '>', now());
            })
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            ->select(
                'productos.*',
                'variacions.id as variacion_id',
                'variacions.color_id',
                'variacions.talla_id',
                'variacions.activo as variacion_activo',
                'inventarios.id as inventario_id',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'producto_lista_precios.precio',
                'producto_lista_precios.precio_antiguo',
                'producto_lista_precios.simbolo',
                'producto_descuentos.porcentaje_descuento',
                'producto_descuentos.fecha_fin as descuento_fecha_fin',
                'colors.nombre as color_nombre',
                'tallas.nombre as talla_nombre'
            )
            ->where('productos.id', $id)
            ->where('inventarios.almacen_id', 1)
            ->where('inventarios.stock', '>', 0)
            ->get();

        $data_imagenes = [];
        if ($data_productos_variaciones) {
            $data_imagenes = DB::table('imagens')
                ->join('imagenables', 'imagens.id', '=', 'imagenables.imagen_id')
                ->where('imagenables.imagenable_id', $id)
                ->where('imagenables.imagenable_type', 'App\Models\Producto')
                ->select('imagens.*')
                ->get();
        }

        return [
            'variaciones' => $data_productos_variaciones,
            'imagenes' => $data_imagenes,
        ];
    }

}
