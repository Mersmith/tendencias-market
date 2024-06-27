<?php

namespace App\Livewire\Erp\Producto;

use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoInventarioVerLivewire extends Component
{
    public $producto;
    public $tipo_variacion;
    public $variaciones = [];

    public function mount($id)
    {
        $this->producto = Producto::with('variaciones.inventario', 'variaciones.talla', 'variaciones.color')->find($id);

        if (!$this->producto) {
            abort(404, 'Producto no encontrado');
        }
        $this->variaciones = $this->producto->variaciones->toArray();

        if ($this->producto->variacion_talla && $this->producto->variacion_color) {
            $this->tipo_variacion = "talla-color";
        } elseif ($this->producto->variacion_talla && !$this->producto->variacion_color) {
            $this->tipo_variacion = "talla";
        } elseif (!$this->producto->variacion_talla && $this->producto->variacion_color) {
            $this->tipo_variacion = "color";
        } else {
            $this->tipo_variacion = "sin-variacion";
        }
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-inventario-ver-livewire');
    }
}
