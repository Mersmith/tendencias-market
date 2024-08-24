<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Comprador\CompradorCarritoController;

class CompradorPagarController extends Controller
{
    public function ver()
    {
        $carrito = null;
        $cantidadItems = 0;
        $totalGeneral = 0;
        $totalDescuento = 0;

        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        $user = Auth::user();
        if ($user) {
            $carrito = DB::table('carritos')
                ->where('user_id', $user->id)
                ->first();

            if ($carrito) {
                $detalles = app(CompradorCarritoController::class)
                    ->getEcommerceCarritoDetalle($almacenEcommerceId, $listaPrecioEtiquetaId, $carrito->id);

                if ($detalles && $detalles->isNotEmpty()) {
                    $cantidadItems = $detalles->count();

                    $totalGeneral = $detalles->reduce(function ($carry, $detalle) {
                        // Usa el precio_oferta si existe, de lo contrario usa precio_normal
                        $precioFinal = $detalle->precio_oferta ?? $detalle->precio_normal;

                        return $carry + ($detalle->cantidad * $precioFinal);
                    }, 0);

                    $totalDescuento = $detalles->reduce(function ($carry, $detalle) {
                        // Si hay un precio_oferta, calcular el descuento
                        if ($detalle->precio_oferta) {
                            $descuento = $detalle->precio_normal - $detalle->precio_oferta;
                            return $carry + ($detalle->cantidad * $descuento);
                        }

                        return $carry;
                    }, 0);

                    $carrito->detalle = $detalles;
                } else {
                    $carrito->detalle = collect();
                }
            }
        }

        return view('comprador.pagar.pagar-pagina', compact('carrito', 'cantidadItems', 'totalGeneral', 'totalDescuento'));
    }

}
