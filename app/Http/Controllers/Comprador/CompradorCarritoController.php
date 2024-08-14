<?php

namespace App\Http\Controllers\Comprador;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\CarritoDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompradorCarritoController extends Controller
{
    public function ver()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
        $carrito = null;
        if ($user) {


            // Obtener el carrito del usuario con sus detalles
            $carrito = Carrito::where('user_id', $user->id)
                ->with('detalle.variacion.producto') // Cargar las relaciones necesarias
                ->first();

            if ($carrito) {
                // Cantidad de ítems (detalles) en el carrito
                $cantidadItems = $carrito->detalle->count();

                // Calcula el total general (suma de cantidad * precio por unidad)
                $totalGeneral = $carrito->detalle->reduce(function ($carry, $detalle) {
                    return $carry + ($detalle->cantidad * $detalle->precio);
                }, 0);
            }

            //dd($carrito);
        }

        return view('comprador.carrito.carrito-pagina', [
            'carrito' => $carrito,
            'cantidadItems' => $cantidadItems,
            'totalGeneral' => $totalGeneral
        ]);
    }

    public function actualizarCantidad(Request $request, $id)
    {
        $detalle = CarritoDetalle::findOrFail($id);

        if ($request->cantidad > 0) {
            $detalle->cantidad = $request->cantidad;
            $detalle->save();
            return response()->json(['success' => true]);
        } else {
            $detalle->delete();
            return response()->json(['success' => true]);
        }
    }

    public function eliminarDetalle($id)
    {
        $detalle = CarritoDetalle::findOrFail($id);
        $detalle->delete();

        return response()->json(['success' => true]);
    }

}
