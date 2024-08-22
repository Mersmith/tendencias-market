<?php

namespace App\Http\Controllers\Ecommerce\Producto;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EcommercePaginaController extends Controller
{
    public function __invoke($id, $slug = null)
    {
        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        $data = $this->getEcommercePaginaProducto($id, $almacenEcommerceId, $listaPrecioEtiquetaId);

        // Si no se encuentran variaciones o imágenes, redirigir a una página 404 o mostrar error.
        if (empty($data['variaciones']) || $data['variaciones']->isEmpty() || empty($data['imagenes']) || $data['imagenes']->isEmpty()) {
            abort(404); // Redirigir a una página 404
        }

        $data_productos_variaciones = $data['variaciones'];

        $data_primero_producto = $data_productos_variaciones->first();
        $data_imagenes = $data['imagenes'];

        $tipo_variacion = "SIN-VARIACION";
        $variacion_agrupada = collect([]);
        $color_seleccionado = null;
        $talla_seleccionado = null;

        if (!$data_primero_producto || ($slug && $slug !== $data_primero_producto->producto_slug)) {
            return redirect()->route('ecommerce.producto.vista.ver', [
                'id' => $data_primero_producto->producto_id ?? $id,
                'slug' => $data_primero_producto->producto_slug ?? $slug
            ]);
        }

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

        return view('ecommerce.producto.producto-pagina', [
            'producto' => $data_primero_producto,
            'imagenes' => $data_imagenes,
            'tipo_variacion' => $tipo_variacion,
            'variacion_agrupada' => $variacion_agrupada,
            'color_seleccionado' => $color_seleccionado,
            'talla_seleccionado' => $talla_seleccionado,
        ]);
    }

    public function getEcommercePaginaProducto($productoId, $almacenEcommerceId, $listaPrecioEtiquetaId)
    {
        /*
        1. Si el producto no tiene lista de precio, no trae sus variaciones.
        2. Si el producto no tiene descuento, igual lo trae.
        3. Si del producto, su variacion no tiene stock en inventario, no trae dicha variacion.
        4. Si del producto, su variacion no tiene almacen asignado en inventario, no trae dicha variacion.
        5. Si el producto, no tiene imagenes, traes su variaciones sin imagenes.
        */

        $data_productos_variaciones = DB::table('productos')
            ->join('variacions', 'productos.id', '=', 'variacions.producto_id')
            ->join('inventarios', 'variacions.id', '=', 'inventarios.variacion_id')
            ->join('producto_lista_precios', function ($join) use ($listaPrecioEtiquetaId) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', $listaPrecioEtiquetaId)
                    ->where('producto_lista_precios.precio', '>', 0);
            })
            ->leftJoin('producto_descuentos', function ($join) use ($listaPrecioEtiquetaId) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', $listaPrecioEtiquetaId)
                    ->where('producto_descuentos.fecha_fin', '>', now());
            })
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->select(
                //'inventarios.id as inventario_id',
                //'inventarios.almacen_id',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'productos.id as producto_id',
                'productos.nombre as producto_nombre',
                'productos.descripcion as producto_descripcion',
                'productos.slug as producto_slug',
                'productos.variacion_color',
                'productos.variacion_talla',
                'variacions.id as variacion_id',
                'variacions.activo as variacion_activo',
                'variacions.color_id',
                'variacions.talla_id',
                'colors.nombre as color_nombre',
                'colors.codigo_color',
                'tallas.nombre as talla_nombre',
                'marcas.nombre as marca_nombre',               
                'producto_lista_precios.precio_antiguo',
                'producto_lista_precios.precio as precio_normal',
                DB::raw('IF(producto_descuentos.porcentaje_descuento > 0 AND producto_descuentos.fecha_fin > NOW(), ROUND(producto_lista_precios.precio - (producto_lista_precios.precio * producto_descuentos.porcentaje_descuento / 100), 2), NULL) as precio_oferta'),
                'producto_descuentos.porcentaje_descuento',
                'producto_descuentos.fecha_fin as descuento_fecha_fin'
            )
            ->where('productos.id', $productoId)
            ->where('inventarios.almacen_id', $almacenEcommerceId)
            ->where('inventarios.stock', '>', 0)
            ->get();

        $data_imagenes = [];
        if ($data_productos_variaciones->isNotEmpty()) {
            $data_imagenes = DB::table('imagens')
                ->join('imagenables', 'imagens.id', '=', 'imagenables.imagen_id')
                ->where('imagenables.imagenable_id', $productoId)
                ->where('imagenables.imagenable_type', 'App\Models\Producto')
                ->select('imagens.*')
                ->get();
        }

        return [
            'variaciones' => $data_productos_variaciones->isNotEmpty() ? $data_productos_variaciones : [],
            'imagenes' => $data_imagenes,
        ];
    }
}
