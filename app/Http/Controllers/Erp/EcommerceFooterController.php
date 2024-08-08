<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\EcommerceFooter;
use Illuminate\Http\Request;

class EcommerceFooterController extends Controller
{
    public function getEcommerceFooter($id)
    {
        $footer = EcommerceFooter::find(1);
       
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
