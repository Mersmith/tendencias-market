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
        $cantidadItems = 0;
        $totalGeneral = 0;

        if ($user) {
            // Obtener el carrito del usuario con sus detalles
            $carrito = Carrito::where('user_id', $user->id)
                ->with('detalle.variacion.producto.imagens') // Cargar las relaciones necesarias
                ->first();

            if ($carrito) {
                // Cantidad de ítems (detalles) en el carrito
                $cantidadItems = $carrito->detalle->count();

                // Calcula el total general (suma de cantidad * precio por unidad)
                $totalGeneral = $carrito->detalle->reduce(function ($carry, $detalle) {
                    return $carry + ($detalle->cantidad * $detalle->precio);
                }, 0);
            }
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
        $carrito = Carrito::where('user_id', Auth::id())->first();

        // Actualiza la cantidad del detalle
        if ($request->cantidad > 0) {
            $detalle->cantidad = $request->cantidad;
            $detalle->save();
        } else {
            // Elimina el detalle si la cantidad es menor o igual a 0
            $detalle->delete();
        }

        // Actualiza la cantidad de ítems y el total general
        $cantidadItems = $carrito->detalle->count();
        $totalGeneral = $carrito->detalle->reduce(function ($carry, $detalle) {
            return $carry + ($detalle->cantidad * $detalle->precio);
        }, 0);

        return response()->json([
            'success' => true,
            'cantidadItems' => $cantidadItems,
            'totalGeneral' => $totalGeneral
        ]);
    }

    public function eliminarDetalle($id)
    {
        $detalle = CarritoDetalle::findOrFail($id);
        $carrito = $detalle->carrito; // Obtén el carrito asociado al detalle

        $detalle->delete();

        // Actualiza los datos del carrito
        $cantidadItems = $carrito->detalle->count();
        $totalGeneral = $carrito->detalle->reduce(function ($carry, $detalle) {
            return $carry + ($detalle->cantidad * $detalle->precio);
        }, 0);

        return response()->json([
            'success' => true,
            'cantidadItems' => $cantidadItems,
            'totalGeneral' => $totalGeneral
        ]);
    }


}
