<?php

namespace App\Livewire\Erp\Inventario;

use App\Models\Almacen;
use App\Models\Inventario;
use App\Models\Sede;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class InventarioTodasLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;
    public $sedes = [];
    public $almacenes = [];
    public $sede_id = null;
    public $almacen_id = null;

    public function mount()
    {
        $this->sedes = Sede::all();
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function updatedSedeId($value)
    {
        $this->almacenes = Almacen::where('sede_id', $value)->get();
        $this->reset(['almacen_id']);
    }

    public function updatedAlmacenId($value)
    {
        $this->almacen_id = $value;
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $inventarioQuery = Inventario::with(['variacion', 'variacion.producto', 'variacion.color', 'variacion.talla'])
            ->where('almacen_id', $this->almacen_id);

        if ($this->buscarProducto) {
            $inventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $inventario = $inventarioQuery->orderBy('id', 'desc')->paginate(20); // Ajusta el número de elementos por página según sea necesario

        return view('livewire.erp.inventario.inventario-todas-livewire', [
            'inventario' => $inventario,
        ]);
    }
}
