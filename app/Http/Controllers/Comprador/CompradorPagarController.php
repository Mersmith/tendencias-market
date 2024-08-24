<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompradorPagarController extends Controller
{
    public function ver()
    {
        return view('comprador.pagar.pagar-pagina');
    }

}
