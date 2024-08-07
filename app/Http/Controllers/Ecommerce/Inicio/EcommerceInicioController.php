<?php

namespace App\Http\Controllers\Ecommerce\Inicio;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Erp\AvisoController;
use App\Http\Controllers\Erp\EnlacesRapidosController;
use App\Http\Controllers\Erp\GridController;
use App\Http\Controllers\Erp\InventarioController;
use App\Http\Controllers\Erp\MostradorController;
use App\Http\Controllers\Erp\SliderController;
use App\Http\Controllers\Erp\TemporizadorController;
use App\Http\Controllers\Erp\VitrinaController;
use App\Models\Banner;
use Illuminate\Http\Request;

class EcommerceInicioController extends Controller
{
    public function __invoke()
    {
        $data_baner_1 = Banner::find(1);
        $data_banner_2 = Banner::find(2);
        $data_banner_3 = Banner::find(3);

        $data_slider_principal_1 = app(SliderController::class)->getEcommerceSlidersPrincipal(1);

        $data_mostrador_1 = app(MostradorController::class)->getEcommerceMostrador(1);
        $data_mostrador_2 = app(MostradorController::class)->getEcommerceMostrador(2);
        $data_mostrador_3 = app(MostradorController::class)->getEcommerceMostrador(3);

        $data_aviso_1 = app(AvisoController::class)->getEcommerceAviso(1);
        $data_aviso_2 = app(AvisoController::class)->getEcommerceAviso(2);

        $data_grid_1 = app(GridController::class)->getEcommerceGrid(1);
        $data_grid_2 = app(GridController::class)->getEcommerceGrid(2);
        $data_grid_3 = app(GridController::class)->getEcommerceGrid(3);

        $almacen_ecommerce = 1;
        $lista_precio_etiqueta = 3;
        $categoria_id = 1;
        $dias_expirar = 2;

        $data_productos = app(InventarioController::class)->getEcommerceProductosCategoria($almacen_ecommerce, $categoria_id, $lista_precio_etiqueta);
        $data_productos_descuentos = app(InventarioController::class)->getEcommerceProductosDescuento($almacen_ecommerce, $lista_precio_etiqueta);

        $data_enlaces_rapidos_1 = app(EnlacesRapidosController::class)->getEcommerceEnlaceRapido(1);

        $data_vitrina_1 = app(VitrinaController::class)->getEcommerceVitrina(1);

        $data_temporizador_1 = app(TemporizadorController::class)->getEcommerceTemporizador(1);
        $dataSliderImagenTresElementosTiempo = app(TemporizadorController::class)->getEcommerceTemporizador(2);

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
                'data_productos',
                'data_productos_descuentos',
                'data_aviso_2',
                'data_enlaces_rapidos_1'
            )
        );
    }
}
