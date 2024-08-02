<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Mostrador;
use Illuminate\Http\Request;

class MostradorController extends Controller
{
    public function getEcommerceMostrador($id)
    {
        $mostrador_1 = Mostrador::find($id);
        if ($mostrador_1) {
            $mostrador_1->imagenes = json_decode($mostrador_1->imagenes, true);
        } else {
            $mostrador_1 = null;
        }

        return $mostrador_1;
    }
}
