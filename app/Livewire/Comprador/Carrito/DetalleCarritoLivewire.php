<?php

namespace App\Livewire\Comprador\Carrito;

use App\Http\Controllers\Comprador\CompradorCarritoController;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CarritoDetalle;
use Illuminate\Support\Facades\DB;
class DetalleCarritoLivewire extends Component
{
    public $carrito;
    public $cantidadItems;
    public $totalGeneral;

    public function mount()
    {
        $this->actualizarCarrito();
    }

    public function actualizarCarrito()
    {
        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        $user = Auth::user();
        if ($user) {
            $this->carrito = DB::table('carritos')
                ->where('user_id', $user->id)
                ->first();

            if ($this->carrito) {

                $detalles = app(CompradorCarritoController::class)
                    ->getEcommerceCarritoDetalle($almacenEcommerceId, $listaPrecioEtiquetaId, $this->carrito->id);

                if ($detalles && $detalles->isNotEmpty()) {
                    $this->cantidadItems = $detalles->count();
                    $this->totalGeneral = $detalles->reduce(function ($carry, $detalle) {
                        return $carry + ($detalle->cantidad * $detalle->precio_normal);
                    }, 0);

                    $this->carrito->detalle = $detalles;
                } else {
                    // Si no hay detalles en el carrito
                    $this->cantidadItems = 0;
                    $this->totalGeneral = 0;
                    $this->carrito->detalle = collect();
                }
            } else {
                $this->cantidadItems = 0;
                $this->totalGeneral = 0;
                $this->carrito->detalle = collect();
            }
        }
    }

    public function incrementarCantidad($detalleId)
    {
        $detalle = CarritoDetalle::find($detalleId);
        if ($detalle) {
            $detalle->cantidad++;
            $detalle->save();
            $this->actualizarCarrito();
        }
    }

    public function disminuirCantidad($detalleId)
    {
        $detalle = CarritoDetalle::find($detalleId);
        if ($detalle && $detalle->cantidad > 1) {
            $detalle->cantidad--;
            $detalle->save();
            $this->actualizarCarrito();
        }
    }

    public function eliminarDetalle($detalleId)
    {
        $detalle = CarritoDetalle::find($detalleId);
        if ($detalle) {
            $detalle->delete();
            $this->actualizarCarrito();
        }
    }

    public function render()
    {
        return view('livewire.comprador.carrito.detalle-carrito-livewire');
    }
}
