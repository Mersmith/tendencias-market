<?php

namespace App\Livewire\Erp\Producto;

use App\Models\Color;
use App\Models\Producto;
use App\Models\Talla;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoVariacionEditarLivewire extends Component
{
    public $producto;
    public bool $variacion_talla;
    public bool $variacion_color;

    public $talla_id = "";
    public $color_id = "";

    public $tallas = [];
    public $colores = [];
    //public $variaciones = [];

    public $variaciones = [
        [
            "talla_id" => "8",
            "color_id" => "3"
        ],
        [
            "talla_id" => "2",
            "color_id" => "3"
        ],
        [
            "talla_id" => "6",
            "color_id" => "4"
        ]
    ];


    public function mount(Producto $item)
    {
        $this->producto = $item;
        //$this->variacion_talla = $item->variacion_talla == 1;
        //$this->variacion_color = $item->variacion_color == 1;

        $this->variacion_talla = true;
        $this->variacion_color = true;

        $this->tallas = Talla::all();
        $this->colores = Color::all();

    }

    public function guardar()
    {
        dd($this->variaciones);
        /*$this->validate([
            'variacion_talla' => 'boolean',
            'variacion_color' => 'boolean',
        ]);

        $this->producto->update([
            'variacion_talla' => $this->variacion_talla ? 1 : 0,
            'variacion_color' => $this->variacion_color ? 1 : 0,
        ]);

        $this->dispatch('alertaLivewire', "Creado");*/

        //return redirect()->route('erp.producto.vista.todas');
    }

    public function agregarVariacion()
    {
        if ($this->talla_id || $this->color_id) {
            $variacion = [];

            if ($this->variacion_talla) {
                $variacion['talla_id'] = $this->talla_id;
            }

            if ($this->variacion_color) {
                $variacion['color_id'] = $this->color_id;
            }

            if (!$this->existeVariacion($variacion)) {

                $this->variaciones[] = $variacion;

                $this->resetVariacionInputs();
                //$this->dispatch('alertaLivewire', "Creado");
            }
        } else {
            $this->dispatch('alertaLivewire', "Error");
        }
    }

    public function eliminarVariacion($index)
    {
        unset($this->variaciones[$index]);
        $this->variaciones = array_values($this->variaciones);
    }

    protected function existeVariacion($variacion)
    {
        if ($this->variacion_talla && !$this->variacion_color) {
            foreach ($this->variaciones as $v) {
                if ($v['talla_id'] == $variacion['talla_id']) {
                    return true;
                }
            }
        } elseif (!$this->variacion_talla && $this->variacion_color) {
            foreach ($this->variaciones as $v) {
                if ($v['color_id'] == $variacion['color_id']) {
                    return true;
                }
            }
        } elseif ($this->variacion_talla && $this->variacion_color) {
            foreach ($this->variaciones as $v) {
                if ($v['talla_id'] == $variacion['talla_id'] && $v['color_id'] == $variacion['color_id']) {
                    return true;
                }
            }
        }
        return false;
    }

    public function resetVariacionInputs()
    {
        $this->talla_id = '';
        $this->color_id = '';
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-variacion-editar-livewire');
    }
}
