<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\Aviso;
use Illuminate\Http\Request;

class AvisoController extends Controller
{
    public function getEcommerceAviso($id)
    {
        $grid_1 = Aviso::find($id);
        if ($grid_1) {
            $grid_1->imagenes = json_decode($grid_1->imagenes, true);
        } else {
            $grid_1 = null;
        }

        return $grid_1;
    }
}
