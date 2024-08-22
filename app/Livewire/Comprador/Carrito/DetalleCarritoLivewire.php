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
    public $totalDescuento;

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
                    //dd($detalles);
                    $this->cantidadItems = $detalles->count();

                    $this->totalGeneral = $detalles->reduce(function ($carry, $detalle) {
                        // Usa el precio_oferta si existe, de lo contrario usa precio_normal
                        $precioFinal = $detalle->precio_oferta ?? $detalle->precio_normal;

                        return $carry + ($detalle->cantidad * $precioFinal);
                    }, 0);

                    $this->totalDescuento = $detalles->reduce(function ($carry, $detalle) {
                        // Si hay un precio_oferta, calcular el descuento
                        if ($detalle->precio_oferta) {
                            $descuento = $detalle->precio_normal - $detalle->precio_oferta;
                            return $carry + ($detalle->cantidad * $descuento);
                        }

                        return $carry;
                    }, 0);

                    $this->carrito->detalle = $detalles;
                } else {
                    // Si no hay detalles en el carrito
                    $this->cantidadItems = 0;
                    $this->totalGeneral = 0;
                    $this->totalDescuento = 0;
                    $this->carrito->detalle = collect();
                }
            } else {
                $this->cantidadItems = 0;
                $this->totalGeneral = 0;
                $this->totalDescuento = 0;
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
