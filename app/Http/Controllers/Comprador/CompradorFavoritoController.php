<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorito;
use App\Models\FavoritoDetalle;
class CompradorFavoritoController extends Controller
{
    public function ver()
    {
        return view('comprador.favorito.favorito-pagina');
    }

    public function getCompradorFavorito($almacenId, $listaPrecioId, $favoritoId)
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
        $detalles = DB::table('favorito_detalles')
            ->join('productos', function ($join) {
                $join->on('favorito_detalles.producto_id', '=', 'productos.id')
                    ->where('productos.activo', true);
            })
            ->join('variacions', function ($join) {
                $join->on('productos.id', '=', 'variacions.producto_id')
                    ->where('variacions.activo', true);
            })
            ->join('inventarios', function ($join) use ($almacenId) {
                $join->on('variacions.id', '=', 'inventarios.variacion_id')
                    ->where('inventarios.almacen_id', $almacenId)
                    ->where('inventarios.stock', '>', 0);
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
            //->leftJoin('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->leftJoinSub($imagenSubquery, 'primer_imagen', function ($join) {
                $join->on('productos.id', '=', 'primer_imagen.imagenable_id');
            })
            ->where('favorito_detalles.favorito_id', $favoritoId)
            ->select(
                DB::raw('MAX(favorito_detalles.favorito_id) as favorito_id'),
                DB::raw('MAX(favorito_detalles.id) as favorito_detalle_id'),
                'productos.id as producto_id',
                DB::raw('MAX(productos.nombre) as producto_nombre'),
                'primer_imagen.imagen_url',
                DB::raw('MAX(productos.slug) as producto_url'),
                DB::raw('MAX(marcas.nombre) as marca_nombre'),
                DB::raw('MAX(colors.nombre) as color_nombre'),
                DB::raw('MAX(tallas.nombre) as talla_nombre'),
                DB::raw('MAX(producto_lista_precios.precio_antiguo) as precio_antiguo'),
                DB::raw('MAX(producto_lista_precios.precio) as precio_normal'),
                DB::raw('IF(MAX(producto_descuentos.porcentaje_descuento) > 0 AND MAX(producto_descuentos.fecha_fin) > NOW(), ROUND(MAX(producto_lista_precios.precio) - (MAX(producto_lista_precios.precio) * MAX(producto_descuentos.porcentaje_descuento) / 100), 2), NULL) as precio_oferta'),
                DB::raw('MAX(producto_descuentos.porcentaje_descuento) as porcentaje_descuento'),
                DB::raw('MAX(producto_descuentos.fecha_fin) as descuento_fecha_fin')
            )
            ->groupBy('productos.id')
            ->get();

        $detalles_general = DB::table('favorito_detalles')
            ->where('favorito_detalles.favorito_id', $favoritoId)
            ->select(
                'favorito_detalles.id as favorito_detalle_id',
            )
            ->get();

        // Obtener los IDs de favorito_detalle que están en $detalles
        $detalles_existentes_ids = $detalles->pluck('favorito_detalle_id')->toArray();

        // Obtener los IDs de favorito_detalle que están en $detalles_general pero no en $detalles
        $detalles_a_eliminar = $detalles_general->pluck('favorito_detalle_id')
            ->diff($detalles_existentes_ids)
            ->toArray();

        // Eliminar los detalles que no están en $detalles
        if (!empty($detalles_a_eliminar)) {
            DB::table('favorito_detalles')
                ->whereIn('id', $detalles_a_eliminar)
                ->delete();
        }

        return $detalles;
    }    

    public function limpiarFavoritos($almacenEcommerceId, $listaPrecioEtiquetaId)
    {
        $user = Auth::user();

        if ($user) {
            // Obtener el ID del carrito o favorito del usuario
            $favorito = Favorito::where('user_id', $user->id)->first();

            if ($favorito) {
                // Obtener todos los productos favoritos del usuario (disponibles y no disponibles)
                $favoritoDetalles = FavoritoDetalle::where('favorito_id', $favorito->id)
                    ->pluck('producto_id');

                // Consulta para obtener los productos disponibles de los favoritos
                $favoritoDetalles_disponibles = DB::table('productos')
                    ->join('variacions', function ($join) {
                        $join->on('productos.id', '=', 'variacions.producto_id')
                            ->where('variacions.activo', true);
                    })
                    ->join('inventarios', 'variacions.id', '=', 'inventarios.variacion_id')
                    ->join('producto_lista_precios', function ($join) use ($listaPrecioEtiquetaId) {
                        $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                            ->where('producto_lista_precios.lista_precio_id', $listaPrecioEtiquetaId)
                            ->where('producto_lista_precios.precio', '>', 0);
                    })
                    ->select('productos.id as producto_id')
                    ->whereIn('productos.id', $favoritoDetalles)
                    ->where('productos.activo', true)
                    ->where('inventarios.almacen_id', $almacenEcommerceId)
                    ->where('inventarios.stock', '>', 0)
                    ->groupBy('productos.id')
                    ->pluck('producto_id');

                // Filtrar $favoritoDetalles para eliminar aquellos que no están en $favoritoDetalles_disponibles
                $favoritoDetallesFiltrados = $favoritoDetalles->intersect($favoritoDetalles_disponibles);

                // Obtener los IDs de productos no disponibles
                $productosNoDisponibles = $favoritoDetalles->diff($favoritoDetalles_disponibles);

                // Eliminar los detalles no disponibles
                FavoritoDetalle::where('favorito_id', $favorito->id)
                    ->whereIn('producto_id', $productosNoDisponibles)
                    ->delete();
            }
        }
    }

    

}
