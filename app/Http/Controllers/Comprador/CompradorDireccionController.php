<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use App\Models\Comprador;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompradorDireccionController extends Controller
{
    public function ver()
    {
        return view('comprador.direccion.direccion-pagina');
    }

}
