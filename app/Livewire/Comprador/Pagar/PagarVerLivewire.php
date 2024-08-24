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
    public $cupon_tipo = "";
    public function aplicarCupon()
    {
        // Buscar el cupón en la base de datos
        $cupon = Cupon::where('codigo', $this->codigoCupon)
            ->where('activo', true)
            ->where('fecha_expiracion', '>', now())
            ->first();

        // Verificar si el cupón es válido
        if ($cupon) {
            // Verificar si el cupón está asignado a un producto o categoría
            $esAplicable = false;

            if ($cupon->producto_id) {
                // El cupón es aplicable solo a un producto específico
                $esAplicable = $this->carrito->detalle->contains('producto_id', $cupon->producto_id);
            } elseif ($cupon->categoria_id) {
                // El cupón es aplicable solo a una categoría específica
                $esAplicable = $this->carrito->detalle->contains('categoria_id', $cupon->categoria_id);
            } else {
                // El cupón es general y se aplica a cualquier producto o categoría
                $esAplicable = true;
            }

            if ($esAplicable) {
                // Verificar si el cupón tiene usos restantes
                if ($cupon->usos_restantes > 0) {
                    // Aplicar el descuento
                    if ($cupon->descuento) {
                        // Descuento fijo
                        $this->cupon_descuento = $cupon->descuento;
                        $this->cupon_tipo = "FIJO";
                    } elseif ($cupon->porcentaje_descuento) {
                        // Descuento en porcentaje
                        $this->cupon_descuento = $cupon->porcentaje_descuento;
                        $this->cupon_tipo = "PORCENTAJE";
                    }
                    $this->mensajeCupon = 'Cupón aplicado con éxito.';
                } else {
                    $this->mensajeCupon = 'El cupón ha agotado sus usos.';
                }
            } else {
                $this->mensajeCupon = 'El cupón no es aplicable a los productos en tu carrito.';
            }
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
