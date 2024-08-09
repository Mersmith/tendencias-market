<?php

namespace App\Livewire\Ecommerce\Producto;

use Livewire\Component;

class AgregarCarritoLivewire extends Component
{
    public $tipo_variacion;
    public $variacion_agrupada;
    public $color_seleccionado;
    public $talla_seleccionado;
    public $carrito = [];
    public $variacion_seleccionada;
    public $cantidad = 1;

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
        if ($this->variacion_seleccionada) {
            $exists = false;
            foreach ($this->carrito as &$cartItem) {
                if ($cartItem->variacion_id == $this->variacion_seleccionada->variacion_id) {
                    $cartItem->cantidad += $this->cantidad;
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $this->variacion_seleccionada->cantidad = $this->cantidad;
                $this->carrito[] = $this->variacion_seleccionada;
            }

            session()->flash('message', 'Producto agregado al carrito');
            $this->reset(['cantidad']);
        } else {
            session()->flash('message', 'ERROR');
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

    public function enviar()
    {
        dd($this->carrito);
    }

    public function render()
    {
        return view('livewire.ecommerce.producto.agregar-carrito-livewire');
    }
}
