<?php

namespace App\Livewire\Comprador\Pagar;

use App\Models\Cupon;
use App\Models\Inventario;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\CompradorDireccion;
use DB;

class PagarVerLivewire extends Component
{
    public $carrito;

    public $carritoCantidadItems;
    public $carritoTotalGeneral;
    public $carritoTotalDescuento;

    /* CUPON  */
    public $cupon_codigo;
    public $cupon_mensaje;
    public $cupon_descuento = 0;
    public $cuponTotalDescuento = 0;
    public $cupon_tipo = "";

    /* DELIVERY  */
    public $direccionEnvio;
    public $deliveryTotalCosto = 50;

    /* FORMULARIO DIRECCION */
    public $modalSeleccionarDireccion = false;
    public $direcciones;
    public $modalEditarDireccion = false;
    public $modalCrearDireccion = false;

    public $direccion_seleccionada;
    public $departamentos;
    public $provincias = [];
    public $distritos = [];
    public $departamento_id = null;
    public $provincia_id = null;
    public $distrito_id = null;
    public $recibe_nombres = null;
    public $recibe_celular = null;
    public $direccion = null;
    public $direccion_numero = null;
    public $codigo_postal = null;

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
        $this->modalSeleccionarDireccion = true;

        $this->traerDireccionesCliente();
    }

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

        $this->modalSeleccionarDireccion = false;
    }

    public function editarDireccion($direccionId)
    {
        $this->departamentos = Departamento::all();

        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direccion_seleccionada = $comprador->direcciones()->find($direccionId);

            $this->recibe_nombres = $this->direccion_seleccionada->recibe_nombres;
            $this->recibe_celular = $this->direccion_seleccionada->recibe_celular;
            $this->direccion = $this->direccion_seleccionada->direccion;
            $this->direccion_numero = $this->direccion_seleccionada->direccion_numero;
            $this->codigo_postal = $this->direccion_seleccionada->codigo_postal;

            $this->modalEditarDireccion = true;

            $this->departamento_id = $this->direccion_seleccionada->departamento_id;
            $this->loadProvincias();
            $this->provincia_id = $this->direccion_seleccionada->provincia_id;
            $this->loadDistritos();
            $this->distrito_id = $this->direccion_seleccionada->distrito_id;
        }

    }

    public function updateDireccion()
    {
        $this->direccion_seleccionada->recibe_nombres = $this->recibe_nombres;
        $this->direccion_seleccionada->recibe_celular = $this->recibe_celular;
        $this->direccion_seleccionada->direccion = $this->direccion;
        $this->direccion_seleccionada->direccion_numero = $this->direccion_numero;
        $this->direccion_seleccionada->codigo_postal = $this->codigo_postal;

        $this->direccion_seleccionada->departamento_id = $this->departamento_id;
        $this->direccion_seleccionada->provincia_id = $this->provincia_id;
        $this->direccion_seleccionada->distrito_id = $this->distrito_id;

        $this->direccion_seleccionada->save();

        if ($this->direccionEnvio && $this->direccionEnvio->id == $this->direccion_seleccionada->id) {
            $this->direccionEnvio = $this->direccion_seleccionada;
        }

        $this->traerDireccionesCliente();
        $this->modalEditarDireccion = false;
        $this->resetValuesForm();
    }

    public function abrirModalCrearDireccion()
    {
        $this->departamentos = Departamento::all();

        $this->modalCrearDireccion = true;
    }

    public function createDireccion()
    {
        $direccion = new CompradorDireccion();
        $direccion->comprador_id = Auth::user()->comprador->id;
        $direccion->recibe_nombres = $this->recibe_nombres;
        $direccion->recibe_celular = $this->recibe_celular;
        $direccion->direccion = $this->direccion;
        $direccion->direccion_numero = $this->direccion_numero;
        $direccion->codigo_postal = $this->codigo_postal;
        $direccion->departamento_id = $this->departamento_id;
        $direccion->provincia_id = $this->provincia_id;
        $direccion->distrito_id = $this->distrito_id;
        $direccion->save();

        $this->traerDireccionesCliente();
        $this->modalCrearDireccion = false;
        $this->resetValuesForm();
    }

    public function resetValuesForm()
    {
        $this->reset([
            'recibe_nombres',
            'recibe_celular',
            'direccion',
            'direccion_numero',
            'codigo_postal',
            'departamento_id',
            'provincia_id',
            'distrito_id',
        ]);
    }

    public function updatedDepartamentoId($value)
    {
        $this->provincia_id = null;
        $this->provincias = [];
        $this->distritos = [];
        $this->distrito_id = null;

        if ($value) {
            $this->loadProvincias();
        }
    }

    public function updatedProvinciaId($value)
    {
        $this->distritos = [];
        $this->distrito_id = null;

        if ($value) {
            $this->loadDistritos();
        }
    }

    public function loadProvincias()
    {
        if (!is_null($this->departamento_id)) {
            $this->provincias = Provincia::where('departamento_id', $this->departamento_id)->get();
        }
    }

    public function loadDistritos()
    {
        if (!is_null($this->provincia_id)) {
            $this->distritos = Distrito::where('provincia_id', $this->provincia_id)->get();
        }
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

            // Crear la venta
            $venta = Venta::create([
                'user_id' => $user->id,
                'total' => $this->total_a_pagar,
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
        });
    }

    public function render()
    {
        return view('livewire.comprador.pagar.pagar-ver-livewire');
    }
}
