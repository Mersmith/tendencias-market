<?php

namespace App\Livewire\Comprador\Carrito;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrito;
use App\Models\CarritoDetalle;
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
        $user = Auth::user();
        if ($user) {
            $this->carrito = Carrito::where('user_id', $user->id)
                ->with('detalle.variacion.producto.imagens')
                ->first();

            if ($this->carrito) {
                $this->cantidadItems = $this->carrito->detalle->count();
                $this->totalGeneral = $this->carrito->detalle->reduce(function ($carry, $detalle) {
                    return $carry + ($detalle->cantidad * $detalle->precio);
                }, 0);
            } else {
                $this->cantidadItems = 0;
                $this->totalGeneral = 0;
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
