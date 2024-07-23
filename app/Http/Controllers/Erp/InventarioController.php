<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function getEcommerceInicioProductosConStockCategoriaAlmacenListaPrecio($almacen_ecommerce, $categoriaId, $lista_precio_etiqueta)
    {
        $productos = Inventario::with([
            'variacion',
            'variacion.producto.imagens',
            'variacion.color',
            'variacion.talla',
            'variacion.producto.listaPrecios',
            'variacion.producto.descuentos',
            'variacion.producto.categoria'
        ])
            ->where('almacen_id', $almacen_ecommerce)
            ->where('stock', '>', 0)
            ->whereHas('variacion.producto.categoria', function ($query) use ($categoriaId) {
                $query->where('id', $categoriaId);
            })
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($inventario) use ($lista_precio_etiqueta) {
                // PRECIO ETIQUETA
                $precioEtiqueta = $inventario->variacion->producto->listaPrecios->firstWhere('lista_precio_id', $lista_precio_etiqueta);
                $precio = $precioEtiqueta ? $precioEtiqueta->precio : null;
                $precio_antiguo = $precioEtiqueta ? $precioEtiqueta->precio_antiguo : null;
                $simbolo = $precioEtiqueta ? $precioEtiqueta->simbolo : null;

                // PRECIO OFERTA
                $descuento = $inventario->variacion->producto->descuentos->firstWhere('lista_precio_id', $lista_precio_etiqueta);
                $precio_oferta = null;
                $porcentaje_descuento = null;
                $fecha_fin = null;

                if ($descuento && $descuento->fecha_fin > now() && $descuento->porcentaje_descuento > 0) {
                    $precio_oferta = round($precio - ($precio * $descuento->porcentaje_descuento / 100), 2);
                    $porcentaje_descuento = $descuento->porcentaje_descuento;
                    $fecha_fin = $descuento->fecha_fin;
                }

                // IMAGENES
                $imagen = $inventario->variacion->producto->imagens->first();
                $imagenData = $imagen ? [
                    'url' => $imagen->url,
                    'titulo' => $imagen->titulo,
                    'descripcion' => $imagen->descripcion,
                ] : null;

                // Construir URL completa
                $producto_url = url("product/{$inventario->variacion->producto->id}/{$inventario->variacion->producto->slug}");

                return [
                    'inventario_id' => $inventario->id,
                    'producto_id' => $inventario->variacion->producto->id,
                    'producto_nombre' => $inventario->variacion->producto->nombre,
                    'producto_url' => $producto_url,
                    'variacion_id' => $inventario->variacion_id,
                    'marca' => $inventario->variacion->producto->marca->nombre,
                    'color_nombre' => $inventario->variacion->color->nombre ?? null,
                    'talla_nombre' => $inventario->variacion->talla->nombre ?? null,
                    'stock' => $inventario->stock,
                    'stock_minimo' => $inventario->stock_minimo,
                    'precio_venta' => $precio,
                    'precio_oferta' => $precio_oferta,
                    'precio_antiguo' => $precio_antiguo,
                    'simbolo' => $simbolo,
                    'descuento' => $porcentaje_descuento,
                    'fecha_fin' => $fecha_fin,
                    'imagen' => $imagenData,
                ];
            })
            ->filter(function ($producto) {
                return $producto['precio_venta'] > 0;
            })
            ->unique('producto_id')
            ->values()
            ->toArray();

        return $productos;
    }
}
