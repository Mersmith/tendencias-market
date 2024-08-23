<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompradorPerfilController extends Controller
{
    public function ver()
    {
        return view('comprador.perfil.perfil-pagina');
    }
}
