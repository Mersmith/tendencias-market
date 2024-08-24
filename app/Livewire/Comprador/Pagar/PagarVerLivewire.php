<?php

namespace App\Livewire\Comprador\Pagar;

use App\Models\Cupon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;

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
    public $cupon_total_descuento = 0;
    public $cupon_tipo = "";

    /* DELIVERY  */
    public $modalSeleccionarDireccion = false;
    public $direccionEnvio;

    public $direcciones;

    public $modalEditarDireccion = false;

    public $direccion_seleccionada;

    /* FORMULARIO DIRECCION */
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

    public function mount()
    {
        $comprador = Auth::user()->comprador;

        if ($comprador) {
            $this->direccionEnvio = $comprador->direcciones()->where('es_principal', true)->first();
        } else {
            $this->direccionEnvio = null;
        }
    }

    public function abrirModalSeleccionarDireccion()
    {
        $this->modalSeleccionarDireccion = true;

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

        // Cerrar el modal
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

        // Guardar los cambios en la base de datos
        $this->direccion_seleccionada->save();

        // Verificar si la dirección editada es la dirección seleccionada para el envío
        if ($this->direccionEnvio && $this->direccionEnvio->id == $this->direccion_seleccionada->id) {
            // Actualizar la dirección seleccionada para el envío
            $this->direccionEnvio = $this->direccion_seleccionada;
        }

        // Refrescar la lista de direcciones después de guardar los cambios
        $this->abrirModalSeleccionarDireccion();

        // Cerrar el modal de edición
        $this->modalEditarDireccion = false;

        // Resetear los valores del formulario
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
