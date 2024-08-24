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
