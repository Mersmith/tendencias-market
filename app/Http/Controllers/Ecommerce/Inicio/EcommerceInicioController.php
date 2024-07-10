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
        
        return view('ecommerce.inicio.index', compact('imagenBanner_1'));
    }
}
