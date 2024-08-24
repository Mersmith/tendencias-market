<?php

namespace App\Livewire\Comprador\Pagar;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CarritoDetalle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Comprador\CompradorCarritoController;

class PagarVerLivewire extends Component
{
    public $carrito;
    public $carritoCantidadItems;
    public $carritoTotalGeneral;
    public $carritoTotalDescuento;

    public function render()
    {
        return view('livewire.comprador.pagar.pagar-ver-livewire');
    }
}
