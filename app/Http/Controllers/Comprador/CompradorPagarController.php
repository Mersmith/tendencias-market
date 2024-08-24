<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Comprador\CompradorCarritoController;

class CompradorPagarController extends Controller
{
    public function ver()
    {
        $carrito = null;
        $cantidadItems = 0;
        $totalGeneral = 0;
        $totalDescuento = 0;

        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        $user = Auth::user();
        if ($user) {
            $carrito = DB::table('carritos')
                ->where('user_id', $user->id)
                ->first();

            if ($carrito) {
                $detalles = $this->getEcommercePagarDetalle($almacenEcommerceId, $listaPrecioEtiquetaId, $carrito->id);

                if ($detalles && $detalles->isNotEmpty()) {
                    $cantidadItems = $detalles->count();

                    $totalGeneral = $detalles->reduce(function ($carry, $detalle) {
                        // Usa el precio_oferta si existe, de lo contrario usa precio_normal
                        $precioFinal = $detalle->precio_oferta ?? $detalle->precio_normal;

                        return $carry + ($detalle->cantidad * $precioFinal);
                    }, 0);

                    $totalDescuento = $detalles->reduce(function ($carry, $detalle) {
                        // Si hay un precio_oferta, calcular el descuento
                        if ($detalle->precio_oferta) {
                            $descuento = $detalle->precio_normal - $detalle->precio_oferta;
                            return $carry + ($detalle->cantidad * $descuento);
                        }

                        return $carry;
                    }, 0);

                    $carrito->detalle = $detalles;
                } else {
                    $carrito->detalle = collect();
                }
            }
        }

        return view('comprador.pagar.pagar-pagina', compact('carrito', 'cantidadItems', 'totalGeneral', 'totalDescuento'));
    }

    public function getEcommercePagarDetalle($almacenId, $listaPrecioId, $carritoId)
    {
        /*
        1. Si la variacion no tiene stock, no trae.
        */

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
            ->join('variacions', function ($join) {
                $join->on('carrito_detalles.variacion_id', '=', 'variacions.id')
                    ->where('variacions.activo', true);
            })
            ->join('inventarios', function ($join) use ($almacenId) {
                $join->on('variacions.id', '=', 'inventarios.variacion_id')
                    ->where('inventarios.almacen_id', $almacenId)
                    ->where('inventarios.stock', '>', 0);
            })
            ->join('productos', function ($join) {
                $join->on('variacions.producto_id', '=', 'productos.id')
                    ->where('productos.activo', true);
            })
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
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->leftJoinSub($imagenSubquery, 'primer_imagen', function ($join) {
                $join->on('productos.id', '=', 'primer_imagen.imagenable_id');
            })
            ->where('carrito_detalles.carrito_id', $carritoId)
            ->select(
                'carrito_detalles.carrito_id',
                'carrito_detalles.id as carrito_detalle_id',
                'carrito_detalles.variacion_id',
                'primer_imagen.imagen_url',
                'productos.id as producto_id',
                'productos.nombre as producto_nombre',
                'categorias.id as categoria_id',
                'marcas.nombre as marca_nombre',
                'colors.nombre as color_nombre',
                'tallas.nombre as talla_nombre',
                'carrito_detalles.cantidad',
                'inventarios.id as inventario_id',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'producto_lista_precios.precio_antiguo',
                'producto_lista_precios.precio as precio_normal',
                DB::raw('IF(producto_descuentos.porcentaje_descuento > 0 AND producto_descuentos.fecha_fin > NOW(), ROUND(producto_lista_precios.precio - (producto_lista_precios.precio * producto_descuentos.porcentaje_descuento / 100), 2), NULL) as precio_oferta'),
                'producto_descuentos.porcentaje_descuento',
                'producto_descuentos.fecha_fin as descuento_fecha_fin',
            )
            ->get();

        $detalles_general = DB::table('carrito_detalles')
            ->select(
                'carrito_detalles.id as carrito_detalle_id',
            )
            ->get();

        // Obtener los IDs de carrito_detalle que están en $detalles
        $detalles_existentes_ids = $detalles->pluck('carrito_detalle_id')->toArray();

        // Obtener los IDs de carrito_detalle que están en $detalles_general pero no en $detalles
        $detalles_a_eliminar = $detalles_general->pluck('carrito_detalle_id')
            ->diff($detalles_existentes_ids)
            ->toArray();

        // Eliminar los detalles que no están en $detalles
        if (!empty($detalles_a_eliminar)) {
            DB::table('carrito_detalles')
                ->whereIn('id', $detalles_a_eliminar)
                ->delete();
        }

        return $detalles;
    }

}
