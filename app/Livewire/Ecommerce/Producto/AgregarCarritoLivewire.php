<?php

namespace App\Livewire\Ecommerce\Producto;

use App\Models\Carrito;
use App\Models\CarritoDetalle;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AgregarCarritoLivewire extends Component
{
    public $tipo_variacion;
    public $variacion_agrupada;
    public $color_seleccionado;
    public $talla_seleccionado;
    public $carrito = [];
    public $variacion_seleccionada;
    public $cantidad = 1;

    public function mount()
    {
        if ($this->tipo_variacion == "VARIA-COLOR-TALLA") {
            $this->seleccionarVariacionColorTalla($this->color_seleccionado, $this->talla_seleccionado);
        } elseif ($this->tipo_variacion == "VARIA-COLOR") {
            $this->seleccionarVariacionColor();
        } elseif ($this->tipo_variacion == "VARIA-TALLA") {
            $this->seleccionarVariacionTalla();
        } else {
            $this->variacion_seleccionada = $this->variacion_agrupada->first();
        }

    }

    public function updatedColorSeleccionado()
    {
        $this->talla_seleccionado = null;
        $this->variacion_seleccionada = null;

        if ($this->tipo_variacion == "VARIA-COLOR") {
            $this->seleccionarVariacionColor();
        } elseif ($this->tipo_variacion == "VARIA-COLOR-TALLA") {
            $this->talla_seleccionado = $this->variacion_agrupada[$this->color_seleccionado]->first()->talla_id;
            $this->seleccionarVariacionColorTalla($this->color_seleccionado, $this->talla_seleccionado);
        }
    }

    public function updatedTallaSeleccionado()
    {
        //VARIA COLOR Y TALLA
        if ($this->color_seleccionado && $this->talla_seleccionado) {
            $this->seleccionarVariacionColorTalla($this->color_seleccionado, $this->talla_seleccionado);
        } else {
            $this->color_seleccionado = null;
            $this->variacion_seleccionada = null;

            if ($this->tipo_variacion == "VARIA-TALLA") {
                $this->seleccionarVariacionTalla();
            }
        }
    }

    public function seleccionarVariacionColor()
    {
        $variacionIdentica = $this->variacion_agrupada[$this->color_seleccionado]->first();
        if ($variacionIdentica) {
            $this->variacion_seleccionada = $variacionIdentica;
        }
    }

    public function seleccionarVariacionTalla()
    {
        $variacionIdentica = $this->variacion_agrupada[$this->talla_seleccionado]->first();
        if ($variacionIdentica) {
            $this->variacion_seleccionada = $variacionIdentica;
        }
    }

    public function seleccionarVariacionColorTalla($colorId, $tallaId)
    {
        //VARIA COLOR Y TALLA
        $variacionIdentica = $this->variacion_agrupada[$colorId]->firstWhere('talla_id', $tallaId);
        if ($variacionIdentica) {
            $this->variacion_seleccionada = $variacionIdentica;
        }
    }

    public function agregarCarrito()
    {
        $user = Auth::user();

        if (!$user || !$user->hasRole('comprador')) {
            return;
        }

        if ($this->variacion_seleccionada) {
            // Buscar o crear el carrito para el usuario autenticado
            $cart = Carrito::firstOrCreate(['user_id' => $user->id]);

            // Verificar si el detalle del carrito con la variación ya existe
            $cartItem = CarritoDetalle::where('carrito_id', $cart->id)
                ->where('variacion_id', $this->variacion_seleccionada->variacion_id)
                ->first();

            if ($cartItem) {
                // Si ya existe, sumamos la cantidad actual
                $cartItem->cantidad += $this->cantidad;
                $cartItem->save();
            } else {
                // Si no existe, creamos un nuevo registro
                CarritoDetalle::create([
                    'carrito_id' => $cart->id,
                    'variacion_id' => $this->variacion_seleccionada->variacion_id,
                    'cantidad' => $this->cantidad,
                    'precio' => $this->variacion_seleccionada->precio_normal,
                ]);

                $this->dispatch('handleCantidadDetalleCarritoOn', $user->id);
            }

            $this->reset(['cantidad']);
        }
    }

    public function incrementarCantidad()
    {
        if ($this->variacion_seleccionada) {
            if ($this->cantidad < $this->variacion_seleccionada->stock) {
                $this->cantidad++;
            }
        }
    }

    public function decrementarCantidad()
    {
        if ($this->cantidad > 1) {
            $this->cantidad--;
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.producto.agregar-carrito-livewire');
    }
}
