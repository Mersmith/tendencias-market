<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function getEcommerceSlidersPrincipal()
    {
        $sliders = Slider::find(1);
        if ($sliders) {
            $sliders->imagenes = json_decode($sliders->imagenes, true);
        } else {
            $sliders = null;
        }

        return $sliders;
    }
}
