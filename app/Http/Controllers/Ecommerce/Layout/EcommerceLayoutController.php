<?php

namespace App\Http\Controllers\Ecommerce\Layout;

use App\Http\Controllers\Controller;
use App\Models\EcommerceFooter;
class EcommerceLayoutController extends Controller
{
    public function getEcommerceFooter($id)
    {
        $footer = EcommerceFooter::where('id', $id)
            ->where('activo', true)
            ->first();

        if ($footer) {
            $footer->enlaces_rapidos = json_decode($footer->enlaces_rapidos, true);
            $footer->redes_sociales = json_decode($footer->redes_sociales, true);
            $footer->terminos = json_decode($footer->terminos, true);
        } else {
            $footer = null;
        }

        return $footer;
    }
}
