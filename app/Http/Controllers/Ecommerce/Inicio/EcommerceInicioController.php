<?php

namespace App\Http\Controllers\Ecommerce\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\Slider;
use App\Models\Mostrador;
use App\Models\Aviso;
use App\Models\Grid;
use App\Models\SliderProductos;
use App\Models\EnlacesRapidos;
use App\Models\Vitrina;
use App\Models\Temporizador;

class EcommerceInicioController extends Controller
{
    public function __invoke()
    {
        $data_baner_1 = Banner::find(1);
        $data_banner_2 = Banner::find(2);
        $data_banner_3 = Banner::find(3);

        $data_slider_principal_1 = $this->getEcommerceSlidersPrincipal(1);

        $data_mostrador_1 = $this->getEcommerceMostrador(1);
        $data_mostrador_2 = $this->getEcommerceMostrador(2);
        $data_mostrador_3 = $this->getEcommerceMostrador(3);

        $data_aviso_1 = $this->getEcommerceAviso(1);
        $data_aviso_2 = $this->getEcommerceAviso(2);

        $data_grid_1 = $this->getEcommerceGrid(1);
        $data_grid_2 = $this->getEcommerceGrid(2);
        $data_grid_3 = $this->getEcommerceGrid(3);

        $data_slide_producto = $this->getEcommerceSliderProductos(1);

        $data_slide_producto_descuentos = $this->getEcommerceSliderProductos(2);

        $data_enlaces_rapidos_1 = $this->getEcommerceEnlaceRapido(1);

        $data_vitrina_1 = $this->getEcommerceVitrina(1);

        $data_temporizador_1 = $this->getEcommerceTemporizador(1);
        $dataSliderImagenTresElementosTiempo = $this->getEcommerceTemporizador(2);

        return view(
            'ecommerce.inicio.index',
            compact(
                'data_baner_1',
                'data_banner_2',
                'data_banner_3',
                'data_slider_principal_1',
                'data_vitrina_1',
                'data_mostrador_1',
                'data_mostrador_2',
                'data_mostrador_3',
                'data_temporizador_1',
                'dataSliderImagenTresElementosTiempo',
                'data_aviso_1',
                'data_grid_1',
                'data_grid_2',
                'data_grid_3',
                'data_slide_producto',
                'data_slide_producto_descuentos',
                'data_aviso_2',
                'data_enlaces_rapidos_1'
            )
        );
    }

    public function getEcommerceSlidersPrincipal($id)
    {
        $sliders = Slider::find($id);
        if ($sliders) {
            $sliders->imagenes = json_decode($sliders->imagenes, true);
        } else {
            $sliders = null;
        }

        return $sliders;
    }

    public function getEcommerceMostrador($id)
    {
        $mostrador_1 = Mostrador::find($id);
        if ($mostrador_1) {
            $mostrador_1->imagenes = json_decode($mostrador_1->imagenes, true);
        } else {
            $mostrador_1 = null;
        }

        return $mostrador_1;
    }

    public function getEcommerceAviso($id)
    {
        $grid_1 = Aviso::find($id);
        if ($grid_1) {
            $grid_1->imagenes = json_decode($grid_1->imagenes, true);
        } else {
            $grid_1 = null;
        }

        return $grid_1;
    }

    public function getEcommerceGrid($id)
    {
        $grid_1 = Grid::find($id);
        if ($grid_1) {
            $grid_1->imagenes = json_decode($grid_1->imagenes, true);
        } else {
            $grid_1 = null;
        }

        return $grid_1;
    }

    public function getEcommerceEnlaceRapido($id)
    {
        $categorias = EnlacesRapidos::find($id);
        if ($categorias) {
            $categorias->enlaces = json_decode($categorias->enlaces, true);
        } else {
            $categorias = null;
        }

        return $categorias;
    }

    public function getEcommerceVitrina($id)
    {
        $data = Vitrina::find($id);
        if ($data) {
            $data->imagenes = json_decode($data->imagenes, true);
        } else {
            $data = null;
        }

        return $data;
    }

    public function getEcommerceTemporizador($id)
    {
        $data = Temporizador::where('id', $id)
            ->where('fecha_fin', '>', now())
            ->where('activo', true)
            ->first();

        if ($data) {
            $data->imagenes = json_decode($data->imagenes, true);
        } else {
            $data = null;
        }

        return $data;
    }

    public function getEcommerceSliderProductos($id)
    {
        $sliderProducto = SliderProductos::find($id);

        if ($sliderProducto) {
            $almacenEcommerceId = $sliderProducto->almacen_ecommerce_id;
            $listaPrecioEtiquetaId = $sliderProducto->lista_precio_etiqueta_id;
            $categoriaId = $sliderProducto->categoria_id;

            $productoData = null;

            if ($categoriaId) {
                $productoData =
                    $this->getEcommerceProductosCategoria($almacenEcommerceId, $categoriaId, $listaPrecioEtiquetaId);
            } elseif ($sliderProducto->descuento) {
                $productoData =
                    $this->getEcommerceProductosDescuento($almacenEcommerceId, $listaPrecioEtiquetaId);
            }

            if ($productoData) {
                return [
                    'id' => $id,
                    'slider' => $sliderProducto,
                    'productos' => $productoData,
                ];
            }

            return $sliderProducto;
        }

        return null;
    }

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
}
