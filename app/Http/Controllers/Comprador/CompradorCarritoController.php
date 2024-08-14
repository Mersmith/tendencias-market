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

            //dd($carrito);
        }

        return view('comprador.carrito.carrito-pagina', [
            'carrito' => $carrito,
        ]);
    }

    public function actualizarCantidad(Request $request, $id)
    {
        $detalle = CarritoDetalle::findOrFail($id);

        // Actualizar la cantidad sólo si es mayor que 0
        if ($request->cantidad > 0) {
            $detalle->cantidad = $request->cantidad;
            $detalle->save();
        } else {
            // Si la cantidad es 0 o menos, eliminar el ítem del carrito
            $detalle->delete();
        }

        return redirect()->back()->with('success', 'La cantidad del producto ha sido actualizada.');
    }

    public function eliminarDetalle($id)
    {
        $detalle = CarritoDetalle::findOrFail($id);
        $detalle->delete();

        return redirect()->back()->with('success', 'El producto ha sido eliminado del carrito.');
    }
}
