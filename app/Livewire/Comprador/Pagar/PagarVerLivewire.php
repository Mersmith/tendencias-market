<?php

namespace App\Livewire\Comprador\Pagar;

use App\Models\Cupon;
use App\Models\Inventario;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use DB;
use Livewire\Attributes\On;

class PagarVerLivewire extends Component
{
    public $carrito;

    public $carritoCantidadItems;
    public $carritoTotalGeneral;
    public $carritoTotalDescuento;

    /* CUPON  */
    public $cupon_codigo;
    public $cupon_id;
    public $cupon_mensaje;
    public $cupon_descuento = 0;
    public $cuponTotalDescuento = 0;
    public $cupon_tipo = "";

    /* DELIVERY  */
    public $direccionEnvio;
    public $deliveryTotalCosto = 0;

    /* FORMULARIO DIRECCION */
    public $estadoModalEditar = false;
    public $estadoModalCrear = false;
    public $estadoModalSeleccionarDireccion = false;
    public $editar_direccion_id;
    public $direcciones;
    public $total_a_pagar = 0;

    public function mount()
    {
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direccionEnvio = $comprador->direcciones()->where('es_principal', true)->first();

            $this->total_a_pagar = $this->carritoTotalGeneral + $this->deliveryTotalCosto;
        } else {
            $this->direccionEnvio = null;
        }
    }

    public function abrirModalSeleccionarDireccion()
    {
        $this->estadoModalSeleccionarDireccion = true;

        $this->traerDireccionesCliente();
    }

    #[On('emitCompradorPagarRefreshDirecciones')]
    public function traerDireccionesCliente()
    {
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direcciones = $comprador->direcciones()->orderBy('es_principal', 'desc')->get();
        } else {
            $this->direcciones = collect();
        }
    }

    public function seleccionarDireccion($direccionId)
    {
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direccionEnvio = $comprador->direcciones()->find($direccionId);
        }

        $this->estadoModalSeleccionarDireccion = false;
    }

    public function editarDireccion($direccionId)
    {
        $this->estadoModalEditar = true;
        $this->editar_direccion_id = $direccionId;
    }

    #[On('emitCompradorPagarCerrarModalEditarDireccion')]
    public function cerrarModalEditar()
    {
        $this->estadoModalEditar = false;
    }

    #[On('emitCompradorPagarCerrarModalCrearDireccion')]
    public function cerrarModalCrear()
    {
        $this->estadoModalCrear = false;
    }
   
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
                        $this->cuponTotalDescuento = $cupon->descuento;
                        $this->cupon_tipo = "FIJO";
                    } elseif ($cupon->porcentaje_descuento) {
                        // Descuento en porcentaje
                        $this->cupon_descuento = $cupon->porcentaje_descuento;
                        $this->cuponTotalDescuento = ($this->carritoTotalGeneral * ($cupon->porcentaje_descuento / 100));
                        $this->cupon_tipo = "PORCENTAJE";
                    }
                    $this->cupon_id = $cupon->id;
                    $this->total_a_pagar = ($this->carritoTotalGeneral - $this->cuponTotalDescuento + $this->deliveryTotalCosto);
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
        $this->cuponTotalDescuento = 0;
        $this->cupon_tipo = "";
        $this->total_a_pagar = ($this->carritoTotalGeneral + $this->cuponTotalDescuento + $this->deliveryTotalCosto);
    }

    public function pagarAhora()
    {
        $user = Auth::user();

        // Verifica si el usuario está autenticado y tiene el rol de comprador
        if (!$user || !$user->hasRole('comprador')) {
            return;
        }

        // Iniciar una transacción para asegurar la consistencia de los datos
        DB::transaction(function () use ($user) {

            // Verificar que haya suficiente stock para cada detalle del carrito
            foreach ($this->carrito->detalle as $detalle) {
                $inventario = Inventario::where('almacen_id', 1)
                    ->where('variacion_id', $detalle->variacion_id)
                    ->first();

                if (!$inventario || $inventario->stock < $detalle->cantidad) {
                    // Si no hay suficiente stock, cancelar la operación
                    throw new \Exception("No hay suficiente stock para la variación {$detalle->variacion_id}.");
                }
            }

            // Verificar si el cupón es válido y tiene usos restantes
            if ($this->cupon_id) {
                $cupon = Cupon::find($this->cupon_id);
                if (!$cupon || !$cupon->activo || $cupon->usos_restantes <= 0) {
                    throw new \Exception("El cupón no es válido o ya ha sido utilizado el máximo número de veces.");
                }
            }

            // Crear la venta
            $venta = Venta::create([
                'user_id' => $user->id,
                'total' => $this->total_a_pagar,
                'costo_envio' => $this->deliveryTotalCosto,
                'cupon_id' => $this->cupon_id,
                'comprador_direccion_id' => $this->direccionEnvio->id,
            ]);

            // Iterar sobre los detalles del carrito y crear los detalles de la venta
            foreach ($this->carrito->detalle as $detalle) {
                // Crear el detalle de la venta
                VentaDetalle::create([
                    'venta_id' => $venta->id,
                    'variacion_id' => $detalle->variacion_id,
                    'cantidad' => $detalle->cantidad,
                    'precio' => $detalle->precio_oferta ?? $detalle->precio_normal,
                    'subtotal' => ($detalle->precio_oferta ?? $detalle->precio_normal) * $detalle->cantidad,
                ]);

                // Descontar el stock en el inventario
                Inventario::where('almacen_id', 1)
                    ->where('variacion_id', $detalle->variacion_id)
                    ->decrement('stock', $detalle->cantidad);
            }

            // Si se utilizó un cupón, actualizar los usos restantes
            if ($this->cupon_id) {
                $cupon->decrement('usos_restantes');

                // Asegurarse de que los usos restantes no excedan los usos totales
                if ($cupon->usos_restantes < 0) {
                    throw new \Exception("Error al aplicar el cupón: los usos restantes no pueden ser negativos.");
                }
            }
        });
    }

    public function render()
    {
        return view('livewire.comprador.pagar.pagar-ver-livewire');
    }
}
