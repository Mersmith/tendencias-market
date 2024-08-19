<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CarritoDetalleController extends Controller
{
    public function getEcommerceCarritoDetalle($almacenId, $listaPrecioId, $carritoId)
    {
        // Subconsulta para obtener el ID de la primera imagen para cada producto
        $subquery = DB::table('imagenables')
            ->join('imagens', 'imagenables.imagen_id', '=', 'imagens.id')
            ->select('imagenables.imagenable_id', DB::raw('MIN(imagens.id) as primera_imagen_id'))
            ->where('imagenables.imagenable_type', 'App\Models\Producto') // Tipo de imagenable
            ->groupBy('imagenables.imagenable_id');

        // Subconsulta para obtener la URL de la primera imagen
        $imagenSubquery = DB::table('imagens')
            ->joinSub($subquery, 'primera_imagen', function ($join) {
                $join->on('imagens.id', '=', 'primera_imagen.primera_imagen_id');
            })
            ->select('primera_imagen.imagenable_id', 'imagens.url as imagen_url');

        // Consulta principal
        $detalles = DB::table('carrito_detalles')
            ->join('variacions', 'carrito_detalles.variacion_id', '=', 'variacions.id')
            ->join('productos', 'variacions.producto_id', '=', 'productos.id')
            ->join('producto_lista_precios', function ($join) use ($listaPrecioId) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', $listaPrecioId)
                    ->where('producto_lista_precios.precio', '>', 0);
            })
            ->leftJoin('producto_descuentos', function ($join) use ($listaPrecioId) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', $listaPrecioId)
                    ->where('producto_descuentos.fecha_fin', '>', now());
            })
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->leftJoinSub($imagenSubquery, 'primer_imagen', function ($join) {
                $join->on('productos.id', '=', 'primer_imagen.imagenable_id');
            })
            ->leftJoin('inventarios', function ($join) use ($almacenId) {
                $join->on('variacions.id', '=', 'inventarios.variacion_id')
                    ->where('inventarios.almacen_id', $almacenId)
                    ->where('inventarios.stock', '>', 0);
            })
            ->where('carrito_detalles.carrito_id', $carritoId)
            ->select(
                'carrito_detalles.carrito_id',
                'carrito_detalles.id as carrito_detalle_id',
                'carrito_detalles.variacion_id',
                'primer_imagen.imagen_url',
                'productos.nombre as producto_nombre',
                'marcas.nombre as marca_nombre',
                'colors.nombre as color_nombre',
                'tallas.nombre as talla_nombre',
                'carrito_detalles.cantidad',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'producto_lista_precios.precio_antiguo',
                'producto_lista_precios.precio as precio_normal',
                DB::raw('IF(producto_descuentos.porcentaje_descuento > 0 AND producto_descuentos.fecha_fin > NOW(), ROUND(producto_lista_precios.precio - (producto_lista_precios.precio * producto_descuentos.porcentaje_descuento / 100), 2), NULL) as precio_oferta'),
                'producto_descuentos.porcentaje_descuento',
                'producto_descuentos.fecha_fin as descuento_fecha_fin',
            )
            ->get();

        return $detalles;
    }

}
