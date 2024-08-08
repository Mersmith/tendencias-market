<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\SliderProductos;
use Illuminate\Http\Request;

class SliderProductosController extends Controller
{
    public function getEcommerceSliderProductos($id)
    {
        $sliderProducto = SliderProductos::find($id);

        if (!$sliderProducto) {
            return null;
        }

        $almacenEcommerceId = $sliderProducto->almacen_ecommerce_id;
        $listaPrecioEtiquetaId = $sliderProducto->lista_precio_etiqueta_id;
        $categoriaId = $sliderProducto->categoria_id;

        if ($categoriaId) {
            return app(InventarioController::class)
                ->getEcommerceProductosCategoria($almacenEcommerceId, $categoriaId, $listaPrecioEtiquetaId);
        }

        if ($sliderProducto->descuento) {
            return app(InventarioController::class)
                ->getEcommerceProductosDescuento($almacenEcommerceId, $listaPrecioEtiquetaId);
        }

        return null;
    }
}
