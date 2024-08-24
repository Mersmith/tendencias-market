<?php

namespace App\Livewire\Comprador\Pagar;

use App\Models\Cupon;
use Livewire\Component;

class PagarVerLivewire extends Component
{
    public $carrito;
    public $carritoCantidadItems;
    public $carritoTotalGeneral;
    public $carritoTotalDescuento;

    public $codigoCupon;
    public $mensajeCupon;

    public $cupon_descuento = 0;

    public function aplicarCupon()
    {
        $cupon = Cupon::where('codigo', $this->codigoCupon)
            ->where('activo', true)
            ->where('fecha_expiracion', '>', now())
            ->first();

        if ($cupon) {
            $descuento = $cupon->descuento;
            $this->cupon_descuento = $descuento;
            $this->mensajeCupon = 'Cupón aplicado con éxito.';
        } else {
            $this->mensajeCupon = 'Cupón inválido o expirado.';
        }
    }

    public function eliminarCupon()
    {
        $this->cupon_descuento = 0;
        $this->mensajeCupon = 'Cupón eliminado.';
        $this->codigoCupon = '';
    }

    public function render()
    {
        return view('livewire.comprador.pagar.pagar-ver-livewire');
    }
}
