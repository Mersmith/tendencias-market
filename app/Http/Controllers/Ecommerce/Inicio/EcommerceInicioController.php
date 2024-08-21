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
use Carbon\Carbon;
class EcommerceInicioController extends Controller
{
    public function __invoke()
    {
        $data_baner_1 = $this->getEcommerceBanner(1);
        $data_banner_2 = $this->getEcommerceBanner(2);
        $data_banner_3 = $this->getEcommerceBanner(3);
        $data_banner_4 = $this->getEcommerceBanner(4);
        $data_banner_5 = $this->getEcommerceBanner(5);

        $data_slider_principal_1 = $this->getEcommerceSlidersPrincipal(1);

        $data_vitrina_1 = $this->getEcommerceVitrina(1);

        $data_mostrador_1 = $this->getEcommerceMostrador(1);
        $data_mostrador_2 = $this->getEcommerceMostrador(2);
        $data_mostrador_3 = $this->getEcommerceMostrador(3);

        $data_aviso_1 = $this->getEcommerceAviso(1);
        $data_aviso_2 = $this->getEcommerceAviso(2);

        $data_grid_1 = $this->getEcommerceGrid(1);
        $data_grid_2 = $this->getEcommerceGrid(2);
        $data_grid_3 = $this->getEcommerceGrid(3);
        $data_grid_4 = $this->getEcommerceGrid(4);
        $data_grid_5 = $this->getEcommerceGrid(5);

        $data_temporizador_1 = $this->getEcommerceTemporizador(1);
        $data_temporizador_2 = $this->getEcommerceTemporizador(2);
        $data_temporizador_3 = $this->getEcommerceTemporizador(3);

        $data_slide_producto_1 = $this->getEcommerceSliderProductos(1);
        $data_slide_producto_2 = $this->getEcommerceSliderProductos(2);

        $data_slide_producto_descuentos = $this->getEcommerceSliderProductos(3);

        $data_enlaces_rapidos_1 = $this->getEcommerceEnlaceRapido(1);

        return view(
            'ecommerce.inicio.index',
            compact(
                'data_baner_1',
                'data_banner_2',
                'data_banner_3',
                'data_banner_4',
                'data_banner_5',
                'data_slider_principal_1',
                'data_vitrina_1',
                'data_mostrador_1',
                'data_mostrador_2',
                'data_mostrador_3',
                'data_temporizador_1',
                'data_temporizador_2',
                'data_temporizador_3',
                'data_aviso_1',
                'data_grid_1',
                'data_grid_2',
                'data_grid_3',
                'data_grid_4',
                'data_grid_5',
                'data_slide_producto_1',
                'data_slide_producto_2',
                'data_slide_producto_descuentos',
                'data_aviso_2',
                'data_enlaces_rapidos_1'
            )
        );
    }

    public function getEcommerceBanner($id)
    {
        $banner = Banner::where('id', $id)
            ->where('activo', true)
            ->first();

        return $banner;
    }

    public function getEcommerceSlidersPrincipal($id)
    {
        $sliders = Slider::where('id', $id)
            ->where('activo', true)
            ->first();
        if ($sliders) {
            $sliders->imagenes = json_decode($sliders->imagenes, true);
        } else {
            $sliders = null;
        }

        return $sliders;
    }

    public function getEcommerceMostrador($id)
    {
        $mostrador = Mostrador::where('id', $id)
            ->where('activo', true)
            ->first();
        if ($mostrador) {
            $mostrador->imagenes = json_decode($mostrador->imagenes, true);
        } else {
            $mostrador = null;
        }

        return $mostrador;
    }

    public function getEcommerceVitrina($id)
    {
        $vitrina = Vitrina::where('id', $id)
            ->where('activo', true)
            ->first();
        if ($vitrina) {
            $vitrina->imagenes = json_decode($vitrina->imagenes, true);
        } else {
            $vitrina = null;
        }

        return $vitrina;
    }

    public function getEcommerceAviso($id)
    {
        $aviso = Aviso::where('id', $id)
            ->where('activo', true)
            ->first();
        if ($aviso) {
            $aviso->imagenes = json_decode($aviso->imagenes, true);
        } else {
            $aviso = null;
        }

        return $aviso;
    }

    public function getEcommerceGrid($id)
    {
        $grid = Grid::where('id', $id)
            ->where('activo', true)
            ->first();
        if ($grid) {
            $grid->imagenes = json_decode($grid->imagenes, true);
        } else {
            $grid = null;
        }

        return $grid;
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

    public function getEcommerceTemporizador($id)
    {
        $temporizador = Temporizador::where('id', $id)
            ->where('fecha_fin', '>', now())
            ->where('activo', true)
            ->first();

        if ($temporizador) {
            $temporizador->imagenes = json_decode($temporizador->imagenes, true);

            // Calcular la cantidad de días restantes
            $fecha_fin = Carbon::parse($temporizador->fecha_fin);
            $dias_restantes = now()->diffInDays($fecha_fin);

            // Redondear a entero
            $temporizador->dias = (int) $dias_restantes;
        } else {
            $temporizador = null;
        }

        return $temporizador;
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
        /*
        1. Si trae producto, por más que no tenga imagen.
        2. No trae producto, si no tiene su lista de precio id.
        3. Si trae producto, tenga o no tenga descuento.
        4. Si tiene descuento, trae el precio_oferta ya calculado, y si no tiene no lo trae.
        */

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
            ->select('primera_imagen.imagenable_id', 'imagens.url as imagen_url', 'imagens.descripcion as imagen_descripcion');

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
                'imagen_subquery.imagen_descripcion',
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
        /*
        1. Si trae producto, por más que no tenga imagen.
        2. No trae producto, si no tiene su lista de precio id.
        3. Si trae producto, que tengan solo descuento.
        4. Si tiene descuento, trae el precio_oferta ya calculado, y si no tiene no lo trae.
        */

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
            ->select('primera_imagen.imagenable_id', 'imagens.url as imagen_url', 'imagens.descripcion as imagen_descripcion');

        $query = DB::table('inventarios')
            ->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->join('productos', 'variacions.producto_id', '=', 'productos.id')
            ->join('producto_lista_precios', function ($join) use ($listaPrecioId) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', '=', $listaPrecioId)
                    ->where('producto_lista_precios.precio', '>', 0);
            })
            ->join('producto_descuentos', function ($join) use ($listaPrecioId) {
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
            ->select(
                'productos.id as producto_id',
                //DB::raw('MAX(inventarios.id) as inventario_id'),
                //DB::raw('MAX(inventarios.almacen_id) as almacen_id'),
                //DB::raw('MAX(inventarios.stock) as stock'),
                //DB::raw('MAX(inventarios.stock_minimo) as stock_minimo'),
                //DB::raw('MAX(variacions.id) as variacion_id'),
                'imagen_subquery.imagen_url',
                'imagen_subquery.imagen_descripcion',
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
}
