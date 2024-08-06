<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;

use App\Models\Vitrina;
use Illuminate\Http\Request;

class VitrinaController extends Controller
{
    public function getEcommerceVitrina($id)
    {
        $data = Vitrina::find($id);
        if ($data) {
            $data->imagenes = json_decode($data->imagenes, true);
        } else {
            $data = null;
        }

        return $data;
    }
}
