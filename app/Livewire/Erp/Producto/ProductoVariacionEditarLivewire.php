<?php

namespace App\Livewire\Erp\Producto;

use App\Models\Color;
use App\Models\Producto;
use App\Models\Talla;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoVariacionEditarLivewire extends Component
{
    public $producto;
    public bool $variacion_talla;
    public bool $variacion_color;

    public $talla_id = null;
    public $color_id = null;

    public $tallas = [];
    public $colores = [];
    public $variaciones = [];

    public function mount(Producto $item)
    {
        $this->producto = $item;
        $this->variacion_talla = $item->variacion_talla == 1;
        $this->variacion_color = $item->variacion_color == 1;

        $this->variaciones = $item->variaciones()->with(['talla', 'color'])->get()->toArray();

        $this->tallas = Talla::all();
        $this->colores = Color::all();
    }

    public function guardar()
    {
        $this->validate([
            'variacion_talla' => 'boolean',
            'variacion_color' => 'boolean',
        ]);

        $this->producto->update([
            'variacion_talla' => $this->variacion_talla ? 1 : 0,
            'variacion_color' => $this->variacion_color ? 1 : 0,
        ]);

        if ($this->variacion_talla || $this->variacion_color) {
            if (!empty($this->variaciones)) {

                $this->producto->variaciones()->whereNotIn('id', array_column($this->variaciones, 'id'))->delete();

                foreach ($this->variaciones as $variacion) {
                    Variacion::updateOrCreate(
                        ['producto_id' => $this->producto->id, 'talla_id' => $variacion['talla_id'], 'color_id' => $variacion['color_id']],
                        ['producto_id' => $this->producto->id, 'talla_id' => $variacion['talla_id'], 'color_id' => $variacion['color_id']]
                    );
                }
            }
        } else {
            $this->producto->variaciones()->delete();

            $this->producto->variaciones()->create([
                'talla_id' => null,
                'color_id' => null,
            ]);
        }

        $this->dispatch('alertaLivewire', "Creado");

        //return redirect()->route('erp.producto.vista.todas');
    }

    public function updatedVariacionTalla($value)
    {
        $this->variaciones = [];
        $this->resetVariacionInputs();
    }

    public function updatedVariacionColor($value)
    {
        $this->variaciones = [];
        $this->resetVariacionInputs();
    }

    public function agregarVariacion()
    {
        if ($this->talla_id || $this->color_id) {
            $variacion = [];

            if ($this->variacion_talla) {
                $variacion['talla_id'] = $this->talla_id;
                $variacion['color_id'] = $this->color_id;
            }

            if ($this->variacion_color) {
                $variacion['color_id'] = $this->color_id;
                $variacion['talla_id'] = $this->talla_id;
            }

            if (!$this->existeVariacion($variacion)) {

                $this->variaciones[] = $variacion;

                $this->resetVariacionInputs();
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
        $this->talla_id = null;
        $this->color_id = null;
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-variacion-editar-livewire');
    }
}
