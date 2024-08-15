<?php

namespace App\Http\Controllers\Ecommerce\Producto;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Erp\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcommercePaginaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        $data = app(ProductoController::class)->getEcommercePaginaProducto($id, $almacenEcommerceId, $listaPrecioEtiquetaId);

        $data_productos_variaciones = $data['variaciones'];
        $data_primero_producto = $data_productos_variaciones->first();
        $data_imagenes = $data['imagenes'];

        $tipo_variacion = "SIN-VARIACION";
        $variacion_agrupada = collect([]);
        $color_seleccionado = null;
        $talla_seleccionado = null;

        if ($data_productos_variaciones) {
            $variacionColor = $data_primero_producto->variacion_color;
            $variacionTalla = $data_primero_producto->variacion_talla;

            if ($variacionColor && $variacionTalla) {
                $tipo_variacion = "VARIA-COLOR-TALLA";
                $variacion_agrupada = $data_productos_variaciones->groupBy('color_id');
                $color_seleccionado = $variacion_agrupada->keys()->first();
                $talla_seleccionado = $variacion_agrupada[$color_seleccionado]->first()->talla_id;
            } elseif ($variacionColor) {
                $tipo_variacion = "VARIA-COLOR";
                $variacion_agrupada = $data_productos_variaciones->groupBy('color_id');
                $color_seleccionado = $variacion_agrupada->keys()->first();
                $talla_seleccionado = null;
            } elseif ($variacionTalla) {
                $tipo_variacion = "VARIA-TALLA";
                $variacion_agrupada = $data_productos_variaciones->groupBy('talla_id');
                $color_seleccionado = null;
                $talla_seleccionado = $variacion_agrupada->keys()->first();
            } else {
                $tipo_variacion = "SIN-VARIACION";
                $variacion_agrupada = collect([$data_primero_producto]);
            }
        }

        if (!$data_primero_producto || ($slug && $slug !== $data_primero_producto->slug)) {
            return redirect()->route('ecommerce.producto.vista.ver', [
                'id' => $data_primero_producto->id ?? $id,
                'slug' => $data_primero_producto->slug ?? $slug
            ]);
        }

        //dd($data_primero_producto);

        return view('ecommerce.producto.producto-pagina', [
            'producto' => $data_primero_producto,
            'imagenes' => $data_imagenes,
            'tipo_variacion' => $tipo_variacion,
            'variacion_agrupada' => $variacion_agrupada,
            'color_seleccionado' => $color_seleccionado,
            'talla_seleccionado' => $talla_seleccionado,
        ]);
    }
}
