<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;

class CompradorCarritoController extends Controller
{
    public function ver()
    {
        return view('comprador.carrito.carrito-pagina');
    }
}
