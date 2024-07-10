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

        return view('ecommerce.inicio.index', compact('imagenBanner_1', 'sliders'));
    }
}
