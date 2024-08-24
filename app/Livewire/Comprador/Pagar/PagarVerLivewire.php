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
    public $cupon_codigo;
    public $cupon_mensaje;
    public $cupon_descuento = 0;
    public $cupon_total_descuento = 0;
    public $cupon_tipo = "";
    public function aplicarCupon()
    {
        // Buscar el cupón en la base de datos
        $cupon = Cupon::where('codigo', $this->cupon_codigo)
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
                        $this->cupon_total_descuento = $cupon->descuento;
                        $this->cupon_tipo = "FIJO";
                    } elseif ($cupon->porcentaje_descuento) {
                        // Descuento en porcentaje
                        $this->cupon_descuento = $cupon->porcentaje_descuento;
                        $this->cupon_total_descuento = ($this->carritoTotalGeneral * ($cupon->porcentaje_descuento / 100));
                        $this->cupon_tipo = "PORCENTAJE";
                    }
                    $this->cupon_mensaje = 'Cupón aplicado con éxito.';
                } else {
                    $this->cupon_mensaje = 'El cupón ha agotado sus usos.';
                }
            } else {
                $this->cupon_mensaje = 'El cupón no es aplicable a los productos en tu carrito.';
            }
        } else {
            $this->cupon_mensaje = 'Cupón inválido o expirado.';
        }
    }

    public function eliminarCupon()
    {
        $this->cupon_descuento = 0;
        $this->cupon_mensaje = 'Cupón eliminado.';
        $this->cupon_codigo = '';
        $this->cupon_total_descuento = 0;
        $this->cupon_tipo = "";
    }

    public function render()
    {
        return view('livewire.comprador.pagar.pagar-ver-livewire');
    }
}
