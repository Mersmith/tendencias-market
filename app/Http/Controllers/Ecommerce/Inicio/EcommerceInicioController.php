<?php

namespace App\Http\Controllers\Ecommerce\Inicio;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Erp\InventarioController;
use App\Http\Controllers\Erp\MostradorController;
use App\Http\Controllers\Erp\SliderController;
use App\Models\Banner;
use App\Models\Categoria;
use App\Models\Inventario;
use App\Models\Mostrador;
use App\Models\Slider;
use Illuminate\Http\Request;

class EcommerceInicioController extends Controller
{
    public function __invoke()
    {
        $almacen_ecommerce = 1;
        $lista_precio_etiqueta = 3;
        $categoriaId = 2;

        $producto_almacen_ecommerce = app(InventarioController::class)->getEcommerceInicioProductosConStockCategoriaAlmacenListaPrecio($almacen_ecommerce, $categoriaId, $lista_precio_etiqueta);

        $sliders = app(SliderController::class)->getEcommerceSlidersPrincipal();

        $imagenBanner_1 = Banner::find(1);
        $mostrador_1 = app(MostradorController::class)->getEcommerceMostrador(1);
        $mostrador_2 = app(MostradorController::class)->getEcommerceMostrador(2);
        $mostrador_3 = app(MostradorController::class)->getEcommerceMostrador(3);
        //dd($mostrador_1);

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
            ]
        ];

        /*$dataGridImagenSeisElementos_2 = [
            [
                "id" => 1,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt28a5f9f365b085f4/6564d1a4ec79942074968838/CAT-01-DK-Navidad-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Navidad",
                "link" => "www.google.com1"
            ],
            [
                "id" => 2,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/bltf0da18330b0710bd/6564d1a4867c0b7a80389712/CAT-02-DK-Jugueteria-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Juguetería",
                "link" => "www.google.com1"
            ],
            [
                "id" => 3,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/bltd1017ab864b070f3/6564d1a42d2f23b9a1f3cabd/CAT-03-DK-televisores-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Televisores",
                "link" => "www.google.com1"
            ],
            [
                "id" => 4,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/bltc84c2c7239444b61/6564d1a494a247545d34bd0b/CAT-04-DK-Zapatillas-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Zapatillas",
                "link" => "www.google.com1"
            ],
            [
                "id" => 5,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt11798669aa073bd7/6564d1c194a24780a434bd13/CAT-05-DK-mascotas-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Mascotas",
                "link" => "www.google.com1"
            ],
            [
                "id" => 6,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/bltb082cfbbbda5fb2b/656788b841d574070dc8036e/CAT-06-DK-Regalos-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Regalos express",
                "link" => "www.google.com1"
            ],
            [
                "id" => 7,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt30469ed9e476e7cb/656788b85af539a4b359fd54/CAT-07-DK-lentes-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Lentes",
                "link" => "www.google.com1"
            ],
            [
                "id" => 8,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt076f5845f4dddd3a/6564d1c17e63e3639b10f343/CAT-07-DK-toallas-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Verano",
                "link" => "www.google.com1"
            ],
            [
                "id" => 9,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt0d347939c1df715e/6564d1e3d28c5a96aa3df1d1/CAT-09-DK-dermo-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Dermo y cuidado personal",
                "link" => "www.google.com1"
            ],
            [
                "id" => 10,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt31ad5b90a6f446ac/6564d1c1dd3986160014423a/CAT-06-DK-peds-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Pequeños electros",
                "link" => "www.google.com1"
            ],
            [
                "id" => 11,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/bltc75edf927ec6c327/6564d1e3399417574cb490cf/CAT-12-DK-muebles-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Muebles",
                "link" => "www.google.com1"
            ],
            [
                "id" => 12,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt8e53ffa543651d0c/6564d1c17539114c6bd05476/CAT-08-DK-Cenanavide%C3%B1a-221123-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Supermercado",
                "link" => "www.google.com1"
            ]
        ];*/

        $dataGridImagenSeisElementos_3 = [
            [
                "id" => 1,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/12-MarcaDestacada-dk-mb-SAMSUNG.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 2,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/15-MarcaDestacada-dk-mb-LENOVO.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 3,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/18-MarcaDestacada-dk-mb-ADIDAS.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 4,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/20-MarcaDestacada-dk-mb-NIKE.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 5,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/27-MarcaDestacada-dk-mb-DIADORA.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 6,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/MarcaDestacada-dk-mb-mountain_gear-07.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 7,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/05-MarcaDestacada-dk-mb-OSTER.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 8,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/21-MarcaDestacada-dk-mb-MANGO.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 9,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/09-MarcaDestacada-dk-mb-APPLE.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 10,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/28-MarcaDestacada-dk-mb-THENORTHFACE.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 11,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/02-MarcaDestacada-dk-mb-JVC.webp'),
                "link" => "www.google.com1"
            ],
            [
                "id" => 12,
                "imagen" => asset('assets/ecommerce/imagenes/marcas/22-MarcaDestacada-dk-mb-ALDO.webp'),
                "link" => "www.google.com1"
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
                ]
            ],
            "tiempo_finaliza" => [
                "hora" => 10,
                "minuto" => 22,
                "segundo" => 43,
            ],
            "fecha_finaliza" => "2024-07-13"
        ];

        $dataSliderImagenCuatroElementos = [
            [
                'id' => 1,
                'imagen' => asset('assets/ecommerce/imagenes/promociones/promocion-uno/HotSale-Hardsell-01-DK-MB-audio-JL.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 2,
                'imagen' => asset('assets/ecommerce/imagenes/promociones/promocion-uno/HotSale-Hardsell-02-DK-MB-videojuegos-JL.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 3,
                'imagen' => asset('assets/ecommerce/imagenes/promociones/promocion-uno/HotSale-Hardsell-03-DK-MB-smartwatch-JL.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 4,
                'imagen' => asset('assets/ecommerce/imagenes/promociones/promocion-uno/HotSale-Hardsell-04-DK-MB-tablets-JL.webp'),
                'link' => 'https://www.google.com1',
            ]
        ];

        $imagenesGridPublicidad_1 = [
            [
                'id' => 1,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-1-vestuario-171123-mdcb-50.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-1-vestuario-171123-mdcb-50-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 50,
            ],
            [
                'id' => 2,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-2-belleza-271123-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-2-belleza-271123-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ],
            [
                'id' => 3,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-3-accesorios-171123-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-3-accesorios-171123-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ]
        ];

        $imagenesGridPublicidad_2 = [
            [
                'id' => 1,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-1-sandalias-271123-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-1-sandalias-271123-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ],
            [
                'id' => 2,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-2-toallas-171223-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-2-toallas-171223-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ],
            [
                'id' => 3,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-3-dormitorios-271123-mdcb-50.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-3-dormitorios-271123-mdcb-50-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 50,
            ]
        ];

        $sliderImagenTresElementosPublicidadControles = [
            [
                'id' => 1,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-3-dormitorios-271123-mdcb-50.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-3-dormitorios-271123-mdcb-50-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 50,
            ],
            [
                'id' => 2,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-1-sandalias-271123-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-1-sandalias-271123-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ],
            [
                'id' => 3,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-2-toallas-171223-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-dos/mc-dk-2-2-toallas-171223-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ],
            [
                'id' => 4,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-1-vestuario-171123-mdcb-50.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-1-vestuario-171123-mdcb-50-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 50,
            ],
            [
                'id' => 5,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-2-belleza-271123-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-2-belleza-271123-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ],
            [
                'id' => 6,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-3-accesorios-171123-mdcb-25.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/grid-publicidad/grid-publicidad-uno/mc-dk-1-3-accesorios-171123-mdcb-25-movil.webp'),
                'link' => 'https://www.google.com1',
                'width' => 25,
            ]
        ];

        $dataSliderImagenCincoElementos = [
            [
                "id" => 1,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/bltfb012eaf82a838ab/655cce634c0b9a0ab3d5244e/01-Ecosistemas-CMR-web-2111-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "CMR Visa",
                "link" => "www.google.com1"
            ],
            [
                "id" => 2,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt99146fea275d653d/6548eebe1607a5040aa270d0/02-Ecosistema-OU-web-0611.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Oportunidades Únicas",
                "link" => "www.google.com1"
            ],
            [
                "id" => 3,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/bltea505e477b9988b4/6548eebd26f063040a8d6bb5/03-Ecosistemas-W44-CMRpuntos-DK-MB-af.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "CMR Puntos",
                "link" => "www.google.com1"
            ],
            [
                "id" => 4,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt44880c1349ca5e53/6548eebd61070f040a26e8f4/04-Ecosistemas-W44-Tottus-DK-MB-af.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Tottus APP",
                "link" => "www.google.com1"
            ],
            [
                "id" => 5,
                "imagen" => "https://images.falabella.com/v3/assets/bltf4ed0b9a176c126e/blt966cad44f739322a/655cc99136b545af00cd52b8/05-Ecosistema-SOAT-web-2111-RN.jpg?disable=upscale&format=webp&quality=70&width=1280",
                "nombre" => "Seguros Falabella",
                "link" => "www.google.com1"
            ]
        ];

        $categorias = [
            [
                'id' => 1,
                'titulo' => 'Productos Populares',
                'elementos' => [
                    ['nombre' => 'Muebles', 'link' => 'www.google.com'],
                    ['nombre' => 'Mancuernas', 'link' => 'www.google.com'],
                    ['nombre' => 'Refrigeradora side by side', 'link' => 'www.google.com'],
                    ['nombre' => 'Lavavajillas', 'link' => 'www.google.com'],
                    ['nombre' => 'Nintendo Switch', 'link' => 'www.google.com'],
                    ['nombre' => 'Muebles de sala', 'link' => 'www.google.com'],
                    ['nombre' => 'Plancha', 'link' => 'www.google.com'],
                    ['nombre' => 'Almohadas', 'link' => 'www.google.com'],
                    ['nombre' => 'Vestidos', 'link' => 'www.google.com'],
                    ['nombre' => 'Televisor LED', 'link' => 'www.google.com'],
                ],
            ],
            [
                'id' => 2,
                'titulo' => 'Categorías destacadas',
                'elementos' => [
                    ['nombre' => 'Zapatillas', 'link' => 'www.google.com'],
                    ['nombre' => 'Moda mujer', 'link' => 'www.google.com'],
                    ['nombre' => 'Celulares', 'link' => 'www.google.com'],
                    ['nombre' => 'Televisores', 'link' => 'www.google.com'],
                    ['nombre' => 'Electrohogar', 'link' => 'www.google.com'],
                    ['nombre' => 'Tecnología', 'link' => 'www.google.com'],
                    ['nombre' => 'Ventiladores', 'link' => 'www.google.com'],
                    ['nombre' => 'Laptops', 'link' => 'www.google.com'],
                    ['nombre' => 'Audífonos', 'link' => 'www.google.com'],
                    ['nombre' => 'Refrigerador', 'link' => 'www.google.com'],
                ],
            ],
            [
                'id' => 3,
                'titulo' => 'Marcas favoritas',
                'elementos' => [
                    ['nombre' => 'Mango', 'link' => 'www.google.com'],
                    ['nombre' => 'Cerave', 'link' => 'www.google.com'],
                    ['nombre' => 'Aldo', 'link' => 'www.google.com'],
                    ['nombre' => 'Olaplex', 'link' => 'www.google.com'],
                    ['nombre' => 'Samsung', 'link' => 'www.google.com'],
                    ['nombre' => 'Apple', 'link' => 'www.google.com'],
                    ['nombre' => 'Puma', 'link' => 'www.google.com'],
                    ['nombre' => 'The Ordinary', 'link' => 'www.google.com'],
                    ['nombre' => 'Sybilla', 'link' => 'www.google.com'],
                    ['nombre' => 'Adidas', 'link' => 'www.google.com'],
                ],
            ],
            [
                'id' => 4,
                'titulo' => 'Destacados',
                'elementos' => [
                    ['nombre' => 'Airpods', 'link' => 'www.google.com'],
                    ['nombre' => 'Xiaomi 12 Pro', 'link' => 'www.google.com'],
                    ['nombre' => 'Nike Air Force 1', 'link' => 'www.google.com'],
                    ['nombre' => 'iPhone 14', 'link' => 'www.google.com'],
                    ['nombre' => 'Laptop gamer', 'link' => 'www.google.com'],
                    ['nombre' => 'Samsung a53', 'link' => 'www.google.com'],
                    ['nombre' => 'Alexa', 'link' => 'www.google.com'],
                    ['nombre' => 'Motorola Moto g22', 'link' => 'www.google.com'],
                    ['nombre' => 'Samsung Galaxy a54', 'link' => 'www.google.com'],
                    ['nombre' => 'Cyber Wow', 'link' => 'www.google.com'],
                ],
            ],
        ];

        return view(
            'ecommerce.inicio.index',
            compact(
                'imagenBanner_1',
                'sliders',
                'tiendas',
                'mostrador_1',
                'mostrador_2',
                'mostrador_3',
                'dataGridImagenSeisElementos_3',
                'dataSliderImagenDosElementosTiempo',
                'dataSliderImagenTresElementosTiempo',
                'dataSliderImagenCuatroElementos',
                'imagenesGridPublicidad_1',
                'imagenesGridPublicidad_2',
                'producto_almacen_ecommerce',
                'sliderImagenTresElementosPublicidadControles',
                'dataSliderImagenCincoElementos',
                'categorias'
            )
        );
    }
}
