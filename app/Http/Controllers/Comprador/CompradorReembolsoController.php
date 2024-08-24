<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CompradorReembolsoController extends Controller
{
    public function ver()
    {
        return view('comprador.reembolso.reembolso-pagina');
    }

}
