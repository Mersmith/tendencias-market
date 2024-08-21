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

        if ($sliderProducto) {
            $almacenEcommerceId = $sliderProducto->almacen_ecommerce_id;//1
            $listaPrecioEtiquetaId = $sliderProducto->lista_precio_etiqueta_id;//3
            $categoriaId = $sliderProducto->categoria_id;//1

            //dd($almacenEcommerceId, $listaPrecioEtiquetaId, $categoriaId);

            $productoData = null;

            if ($categoriaId) {
                $productoData = app(InventarioController::class)
                    ->getEcommerceProductosCategoria($almacenEcommerceId, $categoriaId, $listaPrecioEtiquetaId);
            } elseif ($sliderProducto->descuento) {
                $productoData = app(InventarioController::class)
                    ->getEcommerceProductosDescuento($almacenEcommerceId, $listaPrecioEtiquetaId);
            }

            if ($productoData) {
                return [
                    'slider' => $sliderProducto,
                    'productos' => $productoData,
                ];
            }

            return $sliderProducto;
        }

        return null;
    }

}
