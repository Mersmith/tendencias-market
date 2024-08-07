<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\Temporizador;
use Illuminate\Http\Request;

class TemporizadorController extends Controller
{
    public function getEcommerceTemporizador($id)
    {
        $data = Temporizador::find($id);
        if ($data) {
            $data->imagenes = json_decode($data->imagenes, true);
        } else {
            $data = null;
        }

        return $data;
    }
}
