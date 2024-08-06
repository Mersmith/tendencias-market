<?php

namespace App\Http\Controllers\Ecommerce\Inicio;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Erp\AvisoController;
use App\Http\Controllers\Erp\EnlacesRapidosController;
use App\Http\Controllers\Erp\GridController;
use App\Http\Controllers\Erp\InventarioController;
use App\Http\Controllers\Erp\MostradorController;
use App\Http\Controllers\Erp\SliderController;
use App\Models\Banner;
use App\Models\EnlacesRapidos;
use Illuminate\Http\Request;

class EcommerceInicioController extends Controller
{
    public function __invoke()
    {
        $almacen_ecommerce = 1;
        $lista_precio_etiqueta = 3;
        $categoriaId = 2;

        $producto_almacen_ecommerce = app(InventarioController::class)->getEcommerceInicioProductosConStockCategoriaAlmacenListaPrecio($almacen_ecommerce, $categoriaId, $lista_precio_etiqueta);

        $sliders = app(SliderController::class)->getEcommerceSlidersPrincipal(1);

        $imagenBanner_1 = Banner::find(1);
        $imagenBanner_2 = Banner::find(2);
        $imagenBanner_3 = Banner::find(3);
        $mostrador_1 = app(MostradorController::class)->getEcommerceMostrador(1);
        $mostrador_2 = app(MostradorController::class)->getEcommerceMostrador(2);
        $mostrador_3 = app(MostradorController::class)->getEcommerceMostrador(3);

        $imagenesGridPublicidad_1 = app(GridController::class)->getEcommerceGrid(1);
        $imagenesGridPublicidad_2 = app(GridController::class)->getEcommerceGrid(2);

        $dataSliderImagenCuatroElementos = app(AvisoController::class)->getEcommerceAviso(1);
        $dataSliderImagenCincoElementos = app(AvisoController::class)->getEcommerceAviso(2);

        $categorias = app(EnlacesRapidosController::class)->getEcommerceEnlaceRapido(1);

        $tiendas = [
            [
                'id' => 1,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/tiendas/botones/Retail@140h.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/tiendas/botones/Retail@160h-movil.jpg'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 2,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/tiendas/botones/Sodimac@140h.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/tiendas/botones/Sodimac@160h-movil.jpg'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 3,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/tiendas/botones/Tottus@140h.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/tiendas/botones/Tottus@160h-movil.jpg'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 4,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/tiendas/botones/Linio@140h.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/tiendas/botones/Linio@160h-movil.jpg'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 4,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/tiendas/botones/Linio@140h.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/tiendas/botones/Linio@160h-movil.jpg'),
                'link' => 'https://www.google.com1',
            ]
        ];

        $dataSliderImagenDosElementosTiempo = [
            "data" => [
                [
                    "id" => 1,
                    "imagen" => asset('assets/ecommerce/imagenes/oferta-limitada/oferta-limitada-dos/DD2pods-dk-01-tablet-201223-af.webp'),
                    "link" => "www.google.com1"
                ],
                [
                    "id" => 2,
                    "imagen" => asset('assets/ecommerce/imagenes/oferta-limitada/oferta-limitada-dos/DD2pods-dk-02-samsung-201223-af.webp'),
                    "link" => "www.google.com2"
                ],
                [
                    "id" => 2,
                    "imagen" => asset('assets/ecommerce/imagenes/oferta-limitada/oferta-limitada-dos/DD2pods-dk-02-samsung-201223-af.webp'),
                    "link" => "www.google.com2"
                ]
            ],
            "tiempo_finaliza" => [
                "hora" => 10,
                "minuto" => 22,
                "segundo" => 43,
            ],
            "fecha_finaliza" => "2024-07-12"
        ];

        $dataSliderImagenTresElementosTiempo = [
            "data" => [
                [
                    "id" => 1,
                    "imagen" => asset('assets/ecommerce/imagenes/oferta-limitada/oferta-limitada-uno/DD3pods-dk-01-hisense-tv-121223-mdcb.webp'),
                    "link" => "www.google.com1"
                ],
                [
                    "id" => 2,
                    "imagen" => asset('assets/ecommerce/imagenes/oferta-limitada/oferta-limitada-uno/DD3pods-dk-02v.webp'),
                    "link" => "www.google.com2"
                ],
                [
                    "id" => 3,
                    "imagen" => asset('assets/ecommerce/imagenes/oferta-limitada/oferta-limitada-uno/DD3pods-dk-03-ofertas-111223-mdcb_.webp'),
                    "link" => "www.google.com2"
                ],
                [
                    "id" => 3,
                    "imagen" => asset('assets/ecommerce/imagenes/oferta-limitada/oferta-limitada-uno/DD3pods-dk-03-ofertas-111223-mdcb_.webp'),
                    "link" => "www.google.com2"
                ]
            ],
            "tiempo_finaliza" => [
                "hora" => 10,
                "minuto" => 22,
                "segundo" => 43,
            ],
            "fecha_finaliza" => "2024-07-13"
        ];

        return view(
            'ecommerce.inicio.index',
            compact(
                'imagenBanner_1',
                'imagenBanner_2',
                'imagenBanner_3',
                'sliders',
                'tiendas',
                'mostrador_1',
                'mostrador_2',
                'mostrador_3',
                'dataSliderImagenDosElementosTiempo',
                'dataSliderImagenTresElementosTiempo',
                'dataSliderImagenCuatroElementos',
                'imagenesGridPublicidad_1',
                'imagenesGridPublicidad_2',
                'producto_almacen_ecommerce',
                'dataSliderImagenCincoElementos',
                'categorias'
            )
        );
    }
}
