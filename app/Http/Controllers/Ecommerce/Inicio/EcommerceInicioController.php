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
            "fecha_finaliza" => "2025-07-11"
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

        return view('ecommerce.inicio.index', compact('imagenBanner_1', 'sliders', 'tiendas', 'dataGridImagenSeisElementos_2', 'dataSliderImagenDosElementosTiempo', 'dataSliderImagenCuatroElementos'));
    }
}
