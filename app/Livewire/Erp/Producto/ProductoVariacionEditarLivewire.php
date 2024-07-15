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
    public $tallas, $colores;

    public $variaciones = [];
    public $talla_id = null, $color_id = null;

    public function mount(Producto $item)
    {
        $this->producto = $item;

        $this->variaciones = $item->variaciones()->with(['talla', 'color'])->get()->toArray();

        $this->tallas = Talla::where('activo', true)->get();
        $this->colores = Color::where('activo', true)->get();
    }

    public function guardar()
    {
        if ($this->producto->variacion_talla || $this->producto->variacion_color) {
            if (!empty($this->variaciones)) {
                $this->producto->variaciones()->whereNotIn('id', array_column($this->variaciones, 'id'))
                    ->update(['activo' => false]);

                foreach ($this->variaciones as $variacion) {
                    Variacion::updateOrCreate(
                        ['producto_id' => $this->producto->id, 'talla_id' => $variacion['talla_id'], 'color_id' => $variacion['color_id']],
                        ['activo' => $variacion['activo']]
                    );
                }
            } else {
                $this->producto->variaciones()->update(['activo' => false]);
            }
            $this->variaciones = $this->producto->variaciones()->with(['talla', 'color'])->get()->toArray();
        } else if (!$this->producto->variacion_talla && !$this->producto->variacion_color) {
            Variacion::updateOrCreate(
                ['producto_id' => $this->producto->id, 'talla_id' => null, 'color_id' => null],
                ['activo' => true]
            );
        }

        $this->dispatch('alertaLivewire', "Actualizado");

        //return redirect()->route('erp.producto.vista.todas');
    }


    public function agregarVariacion()
    {
        $variacion = [];

        $variacion['color_id'] = $this->color_id;
        $variacion['talla_id'] = $this->talla_id;
        $variacion['activo'] = false;

        if (!$this->existeVariacion($variacion)) {
            if ($this->producto->variacion_talla && $this->producto->variacion_color) {
                if ($this->talla_id && $this->color_id) {
                    $this->variaciones[] = $variacion;
                    $this->resetVariacionInputs();
                }
            } else if ($this->talla_id || $this->color_id) {
                $this->variaciones[] = $variacion;
                $this->resetVariacionInputs();
            }
        }
    }

    public function cambiarEstadoVariacion($index)
    {
        $this->variaciones[$index]['activo'] = !$this->variaciones[$index]['activo'];
    }

    public function eliminarVariacion($index)
    {
        unset($this->variaciones[$index]);
        $this->variaciones = array_values($this->variaciones);
    }

    protected function existeVariacion($variacion)
    {
        if ($this->producto->variacion_talla && !$this->producto->variacion_color) {
            foreach ($this->variaciones as $v) {
                if ($v['talla_id'] == $variacion['talla_id']) {
                    return true;
                }
            }
        } elseif (!$this->producto->variacion_talla && $this->producto->variacion_color) {
            foreach ($this->variaciones as $v) {
                if ($v['color_id'] == $variacion['color_id']) {
                    return true;
                }
            }
        } elseif ($this->producto->variacion_talla && $this->producto->variacion_color) {
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
