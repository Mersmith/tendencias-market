<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompradorCarritoController extends Controller
{
    public function __invoke()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener el carrito del usuario con sus detalles
        $carrito = Carrito::where('user_id', $user->id)
            ->with('detalle.variacion.producto') // Cargar las relaciones necesarias
            ->first();

        //dd($carrito);

        return view('comprador.carrito.carrito-pagina', [
            'carrito' => $carrito,
        ]);
    }
}
