<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;

class CompradorCompraController extends Controller
{
    public function ver()
    {
        return view('comprador.compra.compra-pagina');
    }     
}
