<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Inventario;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventarioController extends Controller
{
    public function getEcommerceProductosCategoria($almacenId, $categoriaId, $listaPrecioId)
    {
        // Subconsulta para obtener el ID de la primera imagen para cada producto
        $subquery = DB::table('imagenables')
            ->join('imagens', 'imagenables.imagen_id', '=', 'imagens.id')
            ->select('imagenables.imagenable_id', DB::raw('MIN(imagens.id) as primera_imagen_id'))
            ->where('imagenables.imagenable_type', 'App\\Models\\Producto')
            ->groupBy('imagenables.imagenable_id');

        // Subconsulta para obtener la URL de la primera imagen
        $imagenSubquery = DB::table('imagens')
            ->joinSub($subquery, 'primera_imagen', function ($join) {
                $join->on('imagens.id', '=', 'primera_imagen.primera_imagen_id');
            })
            ->select('primera_imagen.imagenable_id', 'imagens.url as imagen_url');

        // Consulta principal
        $query = DB::table('inventarios')
            ->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->join('productos', 'variacions.producto_id', '=', 'productos.id')
            ->join('producto_lista_precios', function ($join) use ($listaPrecioId) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', '=', $listaPrecioId)
                    ->where('producto_lista_precios.precio', '>', 0);
            })
            ->leftJoin('producto_descuentos', function ($join) use ($listaPrecioId) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', '=', $listaPrecioId)
                    ->where('producto_descuentos.fecha_fin', '>', now());
            })
            //->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            //->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->leftJoinSub($imagenSubquery, 'imagen_subquery', function ($join) {
                $join->on('productos.id', '=', 'imagen_subquery.imagenable_id');
            })
            ->where('inventarios.almacen_id', $almacenId)
            ->where('inventarios.stock', '>', 0)
            ->where('productos.categoria_id', $categoriaId)
            ->select(
                'productos.id as producto_id',
                //DB::raw('MAX(inventarios.id) as inventario_id'),
                //DB::raw('MAX(inventarios.almacen_id) as almacen_id'),
                //DB::raw('MAX(inventarios.stock) as stock'),
                //DB::raw('MAX(inventarios.stock_minimo) as stock_minimo'),
                //DB::raw('MAX(variacions.id) as variacion_id'),
                'imagen_subquery.imagen_url',
                DB::raw('MAX(productos.nombre) as producto_nombre'),
                DB::raw('MAX(productos.slug) as producto_url'),
                DB::raw('MAX(marcas.nombre) as marca_nombre'),
                //DB::raw('MAX(colors.nombre) as color_nombre'),
                //DB::raw('MAX(tallas.nombre) as talla_nombre'),
                DB::raw('MAX(producto_lista_precios.precio_antiguo) as precio_antiguo'),
                DB::raw('MAX(producto_lista_precios.precio) as precio_normal'),
                DB::raw('IF(MAX(producto_descuentos.porcentaje_descuento) > 0 AND MAX(producto_descuentos.fecha_fin) > NOW(), ROUND(MAX(producto_lista_precios.precio) - (MAX(producto_lista_precios.precio) * MAX(producto_descuentos.porcentaje_descuento) / 100), 2), NULL) as precio_oferta'),
                DB::raw('MAX(producto_descuentos.porcentaje_descuento) as porcentaje_descuento'),
                //DB::raw('MAX(producto_descuentos.fecha_fin) as descuento_fecha_fin')
            )
            ->groupBy('productos.id')
            ->orderBy('productos.id', 'desc')
            ->limit(18)
            ->get();

        return $query;
    }

    public function getEcommerceProductosDescuento($almacenId, $listaPrecioId)
    {
        // Subconsulta para obtener el ID de la primera imagen para cada producto
        $subquery = DB::table('imagenables')
            ->join('imagens', 'imagenables.imagen_id', '=', 'imagens.id')
            ->select('imagenables.imagenable_id', DB::raw('MIN(imagens.id) as primera_imagen_id'))
            ->where('imagenables.imagenable_type', 'App\\Models\\Producto')
            ->groupBy('imagenables.imagenable_id');

        // Subconsulta para obtener la URL de la primera imagen
        $imagenSubquery = DB::table('imagens')
            ->joinSub($subquery, 'primera_imagen', function ($join) {
                $join->on('imagens.id', '=', 'primera_imagen.primera_imagen_id');
            })
            ->select('primera_imagen.imagenable_id', 'imagens.url as imagen_url');

        $query = DB::table('inventarios')
            ->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->join('productos', 'variacions.producto_id', '=', 'productos.id')
            ->join('producto_lista_precios', function ($join) use ($listaPrecioId) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', '=', $listaPrecioId)
                    ->where('producto_lista_precios.precio', '>', 0);
            })
            ->leftJoin('producto_descuentos', function ($join) use ($listaPrecioId) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', '=', $listaPrecioId)
                    ->whereDate('producto_descuentos.fecha_fin', '>', now()->format('Y-m-d'));
            })
            //->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            //->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->leftJoinSub($imagenSubquery, 'imagen_subquery', function ($join) {
                $join->on('productos.id', '=', 'imagen_subquery.imagenable_id');
            })
            ->where('inventarios.almacen_id', $almacenId)
            ->where('inventarios.stock', '>', 0)
            ->whereNotNull('producto_descuentos.porcentaje_descuento')
            ->select(
                'productos.id as producto_id',
                //DB::raw('MAX(inventarios.id) as inventario_id'),
                //DB::raw('MAX(inventarios.almacen_id) as almacen_id'),
                //DB::raw('MAX(inventarios.stock) as stock'),
                //DB::raw('MAX(inventarios.stock_minimo) as stock_minimo'),
                //DB::raw('MAX(variacions.id) as variacion_id'),
                'imagen_subquery.imagen_url',
                DB::raw('MAX(productos.nombre) as producto_nombre'),
                DB::raw('MAX(productos.slug) as producto_url'),
                DB::raw('MAX(marcas.nombre) as marca_nombre'),
                //DB::raw('MAX(colors.nombre) as color_nombre'),
                //DB::raw('MAX(tallas.nombre) as talla_nombre'),
                DB::raw('MAX(producto_lista_precios.precio_antiguo) as precio_antiguo'),
                DB::raw('MAX(producto_lista_precios.precio) as precio_normal'),
                DB::raw('IF(MAX(producto_descuentos.porcentaje_descuento) > 0 AND MAX(producto_descuentos.fecha_fin) > NOW(), ROUND(MAX(producto_lista_precios.precio) - (MAX(producto_lista_precios.precio) * MAX(producto_descuentos.porcentaje_descuento) / 100), 2), NULL) as precio_oferta'),
                DB::raw('MAX(producto_descuentos.porcentaje_descuento) as porcentaje_descuento'),
                //DB::raw('MAX(producto_descuentos.fecha_fin) as descuento_fecha_fin')
            )
            ->groupBy('productos.id')
            ->orderBy('productos.id', 'desc')
            //->limit(18)
            ->get();

        return $query;

    }

    public function getEcommerceProductosDescuentoDiasExpirar($almacen_ecommerce, $lista_precio_etiqueta, $dias_expirar)
    {
        $fecha_expirar = Carbon::now()->addDays($dias_expirar)->format('Y-m-d');

        $query = DB::table('inventarios')
            ->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->join('productos', 'variacions.producto_id', '=', 'productos.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            ->leftJoin('producto_lista_precios', function ($join) use ($lista_precio_etiqueta) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', '=', $lista_precio_etiqueta);
            })
            ->leftJoin('producto_descuentos', function ($join) use ($lista_precio_etiqueta, $fecha_expirar) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', '=', $lista_precio_etiqueta)
                    ->whereDate('producto_descuentos.fecha_fin', '=', $fecha_expirar);
            })
            ->leftJoin('imagenables', function ($join) {
                $join->on('productos.id', '=', 'imagenables.imagenable_id')
                    ->where('imagenables.imagenable_type', '=', 'App\\Models\\Producto');
            })
            ->leftJoin('imagens', 'imagenables.imagen_id', '=', 'imagens.id')
            ->where('inventarios.almacen_id', $almacen_ecommerce)
            ->where('inventarios.stock', '>', 0)
            ->whereNotNull('producto_descuentos.porcentaje_descuento')
            ->select(
                'inventarios.id as inventario_id',
                'inventarios.almacen_id',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'variacions.id as variacion_id',
                'productos.id as producto_id',
                'productos.nombre as producto_nombre',
                'productos.slug',
                'marcas.nombre as marca_nombre',
                'colors.nombre as color_nombre',
                'tallas.nombre as talla_nombre',
                'producto_lista_precios.precio as precio_venta',
                'producto_lista_precios.precio_antiguo as precio_antiguo',
                'producto_lista_precios.simbolo as simbolo',
                'producto_descuentos.porcentaje_descuento as descuento',
                'producto_descuentos.fecha_fin as fecha_fin',
                'imagens.url as imagen_url',
                'imagens.titulo as imagen_titulo',
                'imagens.descripcion as imagen_descripcion'
            )
            ->orderBy('inventarios.id', 'desc')
            ->get();

        $productos = $query->map(function ($item) {
            $precio = $item->precio_venta;
            $precio_antiguo = $item->precio_antiguo;
            $simbolo = $item->simbolo;

            $precio_oferta = null;
            $porcentaje_descuento = null;
            $fecha_fin = null;

            if ($item->fecha_fin && $item->descuento > 0) {
                $precio_oferta = round($precio - ($precio * $item->descuento / 100), 2);
                $porcentaje_descuento = $item->descuento;
                $fecha_fin = $item->fecha_fin;
            }

            $producto_url = url("product/{$item->producto_id}/{$item->slug}");

            $imagenData = $item->imagen_url ? [
                'url' => $item->imagen_url,
                'titulo' => $item->imagen_titulo,
                'descripcion' => $item->imagen_descripcion,
            ] : null;

            return [
                'inventario_id' => $item->inventario_id,
                'almacen_id' => $item->almacen_id,
                'variacion_id' => $item->variacion_id,
                'producto_id' => $item->producto_id,
                'producto_nombre' => $item->producto_nombre,
                'producto_url' => $producto_url,
                'marca' => $item->marca_nombre,
                'color_nombre' => $item->color_nombre,
                'talla_nombre' => $item->talla_nombre,
                'stock' => $item->stock,
                'stock_minimo' => $item->stock_minimo,
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

    public function getEcommerceProductosDescuentoExpiraHoy($almacen_ecommerce, $lista_precio_etiqueta)
    {
        $query = DB::table('inventarios')
            ->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->join('productos', 'variacions.producto_id', '=', 'productos.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            ->leftJoin('producto_lista_precios', function ($join) use ($lista_precio_etiqueta) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', '=', $lista_precio_etiqueta);
            })
            ->leftJoin('producto_descuentos', function ($join) use ($lista_precio_etiqueta) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', '=', $lista_precio_etiqueta)
                    ->whereDate('producto_descuentos.fecha_fin', '=', now()->format('Y-m-d'));
            })
            ->leftJoin('imagenables', function ($join) {
                $join->on('productos.id', '=', 'imagenables.imagenable_id')
                    ->where('imagenables.imagenable_type', '=', 'App\\Models\\Producto');
            })
            ->leftJoin('imagens', 'imagenables.imagen_id', '=', 'imagens.id')
            ->where('inventarios.almacen_id', $almacen_ecommerce)
            ->where('inventarios.stock', '>', 0)
            ->whereNotNull('producto_descuentos.porcentaje_descuento')
            ->select(
                'inventarios.id as inventario_id',
                'inventarios.almacen_id',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'variacions.id as variacion_id',
                'productos.id as producto_id',
                'productos.nombre as producto_nombre',
                'productos.slug',
                'marcas.nombre as marca_nombre',
                'colors.nombre as color_nombre',
                'tallas.nombre as talla_nombre',
                'producto_lista_precios.precio as precio_venta',
                'producto_lista_precios.precio_antiguo as precio_antiguo',
                'producto_lista_precios.simbolo as simbolo',
                'producto_descuentos.porcentaje_descuento as descuento',
                'producto_descuentos.fecha_fin as fecha_fin',
                'imagens.url as imagen_url',
                'imagens.titulo as imagen_titulo',
                'imagens.descripcion as imagen_descripcion'
            )
            ->orderBy('inventarios.id', 'desc')
            ->get();

        $productos = $query->map(function ($item) {
            $precio = $item->precio_venta;
            $precio_antiguo = $item->precio_antiguo;
            $simbolo = $item->simbolo;

            $precio_oferta = null;
            $porcentaje_descuento = null;
            $fecha_fin = null;

            if ($item->descuento && $item->fecha_fin == now()->format('Y-m-d') && $item->descuento > 0) {
                $precio_oferta = round($precio - ($precio * $item->descuento / 100), 2);
                $porcentaje_descuento = $item->descuento;
                $fecha_fin = $item->fecha_fin;
            }

            $producto_url = url("product/{$item->producto_id}/{$item->slug}");

            $imagenData = $item->imagen_url ? [
                'url' => $item->imagen_url,
                'titulo' => $item->imagen_titulo,
                'descripcion' => $item->imagen_descripcion,
            ] : null;

            return [
                'inventario_id' => $item->inventario_id,
                'almacen_id' => $item->almacen_id,
                'variacion_id' => $item->variacion_id,
                'producto_id' => $item->producto_id,
                'producto_nombre' => $item->producto_nombre,
                'producto_url' => $producto_url,
                'marca' => $item->marca_nombre,
                'color_nombre' => $item->color_nombre,
                'talla_nombre' => $item->talla_nombre,
                'stock' => $item->stock,
                'stock_minimo' => $item->stock_minimo,
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

    public function getEcommerceProductosCategoriaDescuento($almacen_ecommerce, $categoriaId, $lista_precio_etiqueta)
    {
        $query = DB::table('inventarios')
            ->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->join('productos', 'variacions.producto_id', '=', 'productos.id')
            ->join('marcas', 'productos.marca_id', '=', 'marcas.id')
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
            ->leftJoin('producto_lista_precios', function ($join) use ($lista_precio_etiqueta) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', '=', $lista_precio_etiqueta);
            })
            ->leftJoin('producto_descuentos', function ($join) use ($lista_precio_etiqueta) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', '=', $lista_precio_etiqueta)
                    ->whereDate('producto_descuentos.fecha_fin', '>', now()->format('Y-m-d'));
            })
            ->leftJoin('imagenables', function ($join) {
                $join->on('productos.id', '=', 'imagenables.imagenable_id')
                    ->where('imagenables.imagenable_type', '=', 'App\\Models\\Producto');
            })
            ->leftJoin('imagens', 'imagenables.imagen_id', '=', 'imagens.id')
            ->where('inventarios.almacen_id', $almacen_ecommerce)
            ->where('inventarios.stock', '>', 0)
            ->where('productos.categoria_id', $categoriaId)
            ->whereNotNull('producto_descuentos.porcentaje_descuento')
            ->select(
                'inventarios.id as inventario_id',
                'inventarios.almacen_id',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'variacions.id as variacion_id',
                'productos.id as producto_id',
                'productos.nombre as producto_nombre',
                'productos.slug',
                'marcas.nombre as marca_nombre',
                'colors.nombre as color_nombre',
                'tallas.nombre as talla_nombre',
                'producto_lista_precios.precio as precio_venta',
                'producto_lista_precios.precio_antiguo as precio_antiguo',
                'producto_lista_precios.simbolo as simbolo',
                'producto_descuentos.porcentaje_descuento as descuento',
                'producto_descuentos.fecha_fin as fecha_fin',
                'imagens.url as imagen_url',
                'imagens.titulo as imagen_titulo',
                'imagens.descripcion as imagen_descripcion'
            )
            ->orderBy('inventarios.id', 'desc')
            ->get();

        $productos = $query->map(function ($item) {
            $precio = $item->precio_venta;
            $precio_antiguo = $item->precio_antiguo;
            $simbolo = $item->simbolo;

            $precio_oferta = null;
            $porcentaje_descuento = null;
            $fecha_fin = null;

            if ($item->descuento && $item->fecha_fin == now()->format('Y-m-d') && $item->descuento > 0) {
                $precio_oferta = round($precio - ($precio * $item->descuento / 100), 2);
                $porcentaje_descuento = $item->descuento;
                $fecha_fin = $item->fecha_fin;
            }

            $producto_url = url("product/{$item->producto_id}/{$item->slug}");

            $imagenData = $item->imagen_url ? [
                'url' => $item->imagen_url,
                'titulo' => $item->imagen_titulo,
                'descripcion' => $item->imagen_descripcion,
            ] : null;

            return [
                'inventario_id' => $item->inventario_id,
                'almacen_id' => $item->almacen_id,
                'variacion_id' => $item->variacion_id,
                'producto_id' => $item->producto_id,
                'producto_nombre' => $item->producto_nombre,
                'producto_url' => $producto_url,
                'marca' => $item->marca_nombre,
                'color_nombre' => $item->color_nombre,
                'talla_nombre' => $item->talla_nombre,
                'stock' => $item->stock,
                'stock_minimo' => $item->stock_minimo,
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
                    'almacen_id' => $inventario->almacen->id,
                    'variacion_id' => $inventario->variacion_id,
                    'producto_id' => $inventario->variacion->producto->id,
                    'producto_nombre' => $inventario->variacion->producto->nombre,
                    'producto_url' => $producto_url,
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
