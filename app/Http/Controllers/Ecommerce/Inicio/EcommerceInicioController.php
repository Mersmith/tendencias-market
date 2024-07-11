<?php

namespace App\Http\Controllers\Ecommerce\Inicio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EcommerceInicioController extends Controller
{
    public function __invoke()
    {
        $imagenBanner_1 = [
            "imagenComputadora" => asset('assets/ecommerce/imagenes/banners/banner-uno/CROSSBANNER-CMRVISA-FCOM-AHORRO_OU-NOV23-DK-3360X100.webp'),
            "imagenMovil" => asset('assets/ecommerce/imagenes/banners/banner-uno/CROSSBANNER-CMRVISA-FCOM-AHORRO_OU-NOV23-DK-3360X100-movil.webp'),
            "link" => "https://www.google.com1"
        ];

        $imagenBanner_2 = [
            "imagenComputadora" => asset('assets/ecommerce/imagenes/banners/banner-dos/Huincha-DK-CSI-Apple-Samsung-111223-mdcb.webp'),
            "imagenMovil" => asset('assets/ecommerce/imagenes/banners/banner-dos/Huincha-MB-CSI-Apple-Samsung-111223-mdcb-movil.webp'),
            "link" => "https://www.google.com1"
        ];

        $imagenBanner_3 = [
            "imagenComputadora" => asset('assets/ecommerce/imagenes/banners/banner-tres/Huincha-DK-ventilador-181223-AF.webp'),
            "imagenMovil" => asset('assets/ecommerce/imagenes/banners/banner-tres/Huincha-DK-ventilador-181223-AF-movil.webp'),
            "link" => "https://www.google.com1"
        ];

        $sliders = [
            [
                'id' => 1,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/sliders/01-vitrina-dk-regalos-navidad-041223-mdcb.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/sliders/01-vitrina-dk-regalos-navidad-041223-mdcb-movil.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 2,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/sliders/02-vitrina-dk-juguetes-061223-RN.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/sliders/02-vitrina-dk-juguetes-061223-RN-movil.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 3,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/sliders/03-vitrina-dk-celulares-051223-RN.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/sliders/03-vitrina-dk-celulares-051223-RN-movil.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 4,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/sliders/04-vitrina-dk-TVS-0412-JL.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/sliders/04-vitrina-dk-TVS-0412-JL-movil.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 5,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/sliders/05-vitrina-dk-navidad-laptops-0412-af.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/sliders/05-vitrina-dk-navidad-laptops-0412-af-movil.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 6,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/sliders/06-Vitrina-DK-LineaBlanca-041123-AF.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/sliders/06-Vitrina-DK-LineaBlanca-041123-AF-movil.webp'),
                'link' => 'https://www.google.com1',
            ],
            [
                'id' => 7,
                'imagenComputadora' => asset('assets/ecommerce/imagenes/sliders/07-Vitrina-DK-dormitorio-0412-JL.webp'),
                'imagenMovil' => asset('assets/ecommerce/imagenes/sliders/07-Vitrina-DK-dormitorio-0412-JL-movil.webp'),
                'link' => 'https://www.google.com1',
            ]
        ];

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

        $dataGridImagenSeisElementos_2 = [
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

        $productos_1 = [
            [
                'id' => 1,
                'productId' => "19615156",
                'displayName' => "Zapatillas urbanas Hombre  Shuffle Puma",
                'brand' => "PUMA",
                'ofertaPrice' => "149",
                'originalPrice' => "229",
                'oldPrice' => "329",
                'symbol' => "S/ ",
                'discount' => "-35%",
                'url' => "http://localhost:3000/producto/19615156/Zapatillas-urbanas-Hombre-Shuffle-Puma/19615161",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19615161_1"
            ],
            [
                'id' => 2,
                'productId' => "19828926",
                'displayName' => "Zapatillas Running",
                'brand' => "ADIDAS",
                'ofertaPrice' => "129",
                'originalPrice' => "209",
                'symbol' => "S/ ",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19828926/Zapatillas-Running-Mujer-adidas-Duramo-RC/19828928",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19828928_1"
            ],
            [
                'id' => 3,
                'productId' => "19850949",
                'displayName' => "Zapatillas Deportivas Mujer Reflect Lite Wn's",
                'brand' => "PUMA",
                'ofertaPrice' => "149",
                'originalPrice' => "219",
                'symbol' => "S/ ",
                'discount' => "-32%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19850949/Zapatillas-Deportivas-Mujer-Reflect-Lite-Wn's/19850950",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19850950_1",
                'card' => true
            ],
            [
                'id' => 4,
                'productId' => "19836018",
                'displayName' => "Zapatillas Urbanas Mujer Adidas Breaknet 2.0",
                'brand' => "ADIDAS",
                'ofertaPrice' => "149",
                'originalPrice' => "229",
                'symbol' => "S/ ",
                'discount' => "-35%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19836018/Zapatillas-Urbanas-Mujer-Adidas-Breaknet-2.0/19836020",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19836020_1"
            ],
            [
                'id' => 5,
                'productId' => "19836018",
                'displayName' => "Zapatillas urbanas Hombre  Shuffle Puma",
                'brand' => "PUMA",
                'ofertaPrice' => "149",
                'originalPrice' => "229",
                'symbol' => "S/ ",
                'discount' => "-35%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19615166/Zapatillas-urbanas-Hombre-Shuffle-Puma/19615171",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19615171_1"
            ],
            [
                'id' => 6,
                'productId' => "19105710",
                'displayName' => "Zapatillas Urbanas Mujer Puma Smash Platform V2 L",
                'brand' => "PUMA",
                'ofertaPrice' => "179",
                'originalPrice' => "279",
                'symbol' => "S/ ",
                'discount' => "-36%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19105710/Zapatillas-Urbanas-Mujer-Puma-Smash-Platform-V2-L/19105716",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19105716_1"
            ],
            [
                'id' => 7,
                'productId' => "19501227",
                'displayName' => "Zapatillas Urbanas Hombre adidas Breaknet 2.0",
                'brand' => "ADIDAS",
                'ofertaPrice' => "149",
                'originalPrice' => "229",
                'symbol' => "S/ ",
                'discount' => "-35%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19501227/Zapatillas-Urbanas-Hombre-adidas-Breaknet-2.0/19501231",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19501231_1"
            ],
            [
                'id' => 8,
                'productId' => "19501235",
                'displayName' => "Zapatillas Urbanas Hombre Breaknet 2.0 Adidas",
                'brand' => "ADIDAS",
                'ofertaPrice' => "149",
                'originalPrice' => "229",
                'symbol' => "S/ ",
                'discount' => "-35%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19501235/Zapatillas-Urbanas-Hombre-Breaknet-2.0-Adidas/19501240",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19501240_1"
            ],
            [
                'id' => 9,
                'productId' => "19501219",
                'displayName' => "Zapatillas Urbanas Hombre adidas Breaknet 2.0",
                'brand' => "ADIDAS",
                'ofertaPrice' => "149",
                'originalPrice' => "229",
                'symbol' => "S/ ",
                'discount' => "-35%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19501219/Zapatillas-Urbanas-Hombre-adidas-Breaknet-2.0/19501224",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19501224_1"
            ],
            [
                'id' => 10,
                'productId' => "19828875",
                'displayName' => "Zapatillas Running  Hombre adidas Duramo RC",
                'brand' => "ADIDAS",
                'ofertaPrice' => "149",
                'originalPrice' => "209",
                'symbol' => "S/ ",
                'discount' => "-38%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19828875/Zapatillas-Running-Hombre-adidas-Duramo-RC/19828881",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19828881_1"
            ],
            [
                'id' => 11,
                'productId' => "19105718",
                'displayName' => "Zapatillas Urbanas Mujer Puma Smash Platform V2 L",
                'brand' => "PUMA",
                'ofertaPrice' => "179",
                'originalPrice' => "279",
                'symbol' => "S/ ",
                'discount' => "-36%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19105718/Zapatillas-Urbanas-Mujer-Puma-Smash-Platform-V2-L/19105724",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19105724_1"
            ],
            [
                'id' => 12,
                'productId' => "119725140",
                'displayName' => "Zapatillas Urbanas Mujer Nike Court Vision Legacy Lift",
                'brand' => "NIKE",
                'ofertaPrice' => "439",
                'originalPrice' => "469",
                'symbol' => "S/ ",
                'discount' => "-6%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/119725140/Zapatillas-Urbanas-Mujer-Nike-Court-Vision-Legacy-Lift/119725141",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/gsc_119725140_2457158_1"
            ],
            [
                'id' => 13,
                'productId' => "19001059",
                'displayName' => "Zapatillas Urbanas Mujer adidas Originals Nizza Trek",
                'brand' => "NIKE",
                'ofertaPrice' => "227.40",
                'originalPrice' => "379",
                'symbol' => "S/ ",
                'discount' => "-40%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19001059/Zapatillas-Urbanas-Mujer-adidas-Originals-Nizza-Trek/19001061",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19001061_1"
            ],
            [
                'id' => 14,
                'productId' => "19863222",
                'displayName' => "Zapatillas Deportivas Hombre FTR Connect FS",
                'brand' => "PUMA",
                'ofertaPrice' => "139",
                'originalPrice' => "219",
                'symbol' => "S/ ",
                'discount' => "-37%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19863222/Zapatillas-Deportivas-Hombre-FTR-Connect-FS/19863227",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19863227_1"
            ],
            [
                'id' => 15,
                'productId' => "18303936",
                'displayName' => "Zapatillas urbanas Mujer Veja RC052762",
                'brand' => "VEJA",
                'ofertaPrice' => "649",
                'originalPrice' => "799",
                'symbol' => "S/ ",
                'discount' => "-37%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/18303936/Zapatillas-urbanas-Mujer-Veja-RC052762/18303937",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/18303937_1"
            ],
            [
                'id' => 16,
                'productId' => "122939617",
                'displayName' => "ZAPATILLA ASICS DE VOLEY / NETBURNER BALLISTIC FF 3",
                'brand' => "ASICS",
                'ofertaPrice' => "779",
                'originalPrice' => "869",
                'symbol' => "S/ ",
                'discount' => "-10%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/122939617/ZAPATILLA-ASICS-DE-VOLEY-NETBURNER-BALLISTIC-FF-3/122939618",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/gsc_122939617_3483460_1"
            ],
            [
                'id' => 17,
                'productId' => "19828899",
                'displayName' => "Zapatillas Running  Mujer adidas Duramo RC",
                'brand' => "ADIDAS",
                'ofertaPrice' => "129",
                'originalPrice' => "209",
                'symbol' => "S/ ",
                'discount' => "-38%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19828899/Zapatillas-Running-Mujer-adidas-Duramo-RC/19828901",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19828901_1"
            ],
            [
                'id' => 18,
                'productId' => "123923763",
                'displayName' => "Nike Air Max Alpha Trainer 5  DM0829-102",
                'brand' => "NIKE",
                'ofertaPrice' => "399",
                'originalPrice' => "559",
                'symbol' => "S/ ",
                'discount' => "-38%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/123923761/Nike-Air-Max-Alpha-Trainer-5-DM0829-102/123923763",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/gsc_123923761_3783441_1"
            ],
            [
                'id' => 19,
                'productId' => "123922516",
                'displayName' => "Nike Air Max INTRLK Lite  DV5695 -100",
                'brand' => "NIKE",
                'ofertaPrice' => "349",
                'originalPrice' => "499",
                'symbol' => "S/ ",
                'discount' => "-30%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/123922516/Nike-Air-Max-INTRLK-Lite-DV5695-100/123922517",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/gsc_123922516_3782770_1"
            ],
            [
                'id' => 20,
                'productId' => "121748294",
                'displayName' => "Zapatillas Urbanas Jordan Retro 1 Mid Negro Amarillo (GS)",
                'brand' => "AIR JORDAN",
                'ofertaPrice' => "699",
                'originalPrice' => "749",
                'symbol' => "S/ ",
                'discount' => "-7%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/121748293/Zapatillas-Urbanas-Jordan-Retro-1-Mid-Negro-Amarillo-(GS)/121748294",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/gsc_121748293_3167534_1"
            ],
            [
                'id' => 21,
                'productId' => "19130474",
                'displayName' => "Zapatillas urbanas Mujer Recife Veja",
                'brand' => "VEJA",
                'ofertaPrice' => "649",
                'originalPrice' => "799",
                'symbol' => "S/ ",
                'discount' => "-7%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19130474/Zapatillas-urbanas-Mujer-Recife-Veja/19130475",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19130475_1"
            ],
            [
                'id' => 22,
                'productId' => "19616302",
                'displayName' => "Zapatillas Deportivas Running Hombre Puma FTR Connect FS",
                'brand' => "PUMA",
                'ofertaPrice' => "139",
                'originalPrice' => "219",
                'symbol' => "S/ ",
                'discount' => "-37%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19616302/Zapatillas-Deportivas-Running-Hombre-Puma-FTR-Connect-FS/19616305",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19616305_1"
            ],
            [
                'id' => 23,
                'productId' => "19839767",
                'displayName' => "Zapatillas Urbanas Hombre Adidas Originals Superstar",
                'brand' => "ADIDAS ORIGINALS",
                'ofertaPrice' => "300.30",
                'originalPrice' => "429",
                'symbol' => "S/ ",
                'discount' => "-30%",
                'url' => "https://www.falabella.com.pe/falabella-pe/product/19839762/Zapatillas-Urbanas-Hombre-Adidas-Originals-Superstar/19839767",
                'image' => "https://falabella.scene7.com/is/image/FalabellaPE/19839767_1"
            ],
        ];

        return view(
            'ecommerce.inicio.index',
            compact(
                'imagenBanner_1',
                'imagenBanner_2',
                'imagenBanner_3',
                'sliders',
                'tiendas',
                'dataGridImagenSeisElementos_2',
                'dataSliderImagenDosElementosTiempo',
                'dataSliderImagenTresElementosTiempo',
                'dataSliderImagenCuatroElementos',
                'imagenesGridPublicidad_1',
                'imagenesGridPublicidad_2',
                'productos_1'
            )
        );
    }
}
