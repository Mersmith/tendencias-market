<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\EnlacesRapidos;
use Illuminate\Http\Request;

class EnlacesRapidosController extends Controller
{
    public function getEcommerceEnlaceRapido($id)
    {
        $categorias = EnlacesRapidos::find($id);
        if ($categorias) {
            $categorias->enlaces = json_decode($categorias->enlaces, true);
        } else {
            $categorias = null;
        }

        return $categorias;
    }
}
