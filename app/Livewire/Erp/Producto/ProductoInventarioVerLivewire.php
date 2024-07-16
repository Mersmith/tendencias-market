<?php

namespace App\Livewire\Erp\Producto;

use App\Models\Almacen;
use App\Models\Producto;
use App\Models\Sede;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoInventarioVerLivewire extends Component
{
    public $producto;
    public $tipo_variacion;
    public $variaciones = [];

    public $sedes = [], $almacenes = [];
    public $sede_id = null;
    public $almacen_id = null;

    public function mount($id)
    {
        $this->sedes = Sede::all();

        $this->loadProductVariations($id);
    }

    public function loadProductVariations($id)
    {
        $id_almacen = $this->almacen_id;       

        $this->producto = Producto::with([
            'variaciones' => function ($query) use ($id_almacen) {
                $query->with(['inventarios' => function ($query) use ($id_almacen) {
                    $query->where('almacen_id', $id_almacen);
                }]);
            },
            'variaciones.talla',
            'variaciones.color'
        ])->find($id);
        
        if ($this->producto) {
            $this->producto->variaciones = $this->producto->variaciones->sortByDesc(function($variacion) use ($id_almacen) {
                return $variacion->inventarios->firstWhere('almacen_id', $id_almacen)->stock ?? 0;
            })->values();
        }

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

    public function updatedSedeId($value)
    {
        $this->almacenes = Almacen::where('sede_id', $value)->get();

        $this->reset(['almacen_id']);
    }

    public function updatedAlmacenId($value)
    {
        $this->loadProductVariations($this->producto->id);
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-inventario-ver-livewire');
    }
}
