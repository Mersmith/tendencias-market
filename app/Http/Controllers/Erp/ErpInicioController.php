<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ErpInicioController extends Controller
{
    public function __invoke()
    {
        return view('erp.inicio.index');
    }
}
