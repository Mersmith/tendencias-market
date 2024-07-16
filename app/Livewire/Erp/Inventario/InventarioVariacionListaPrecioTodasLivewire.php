<?php

namespace App\Livewire\Erp\Inventario;

use App\Models\Almacen;
use App\Models\Inventario;
use App\Models\ListaPrecio;
use App\Models\Sede;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class InventarioVariacionListaPrecioTodasLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;
    public $sedes = [];
    public $almacenes = [];
    public $sede_id = null;
    public $almacen_id = null;

    public $listasPrecios;

    public function mount()
    {
        $this->sedes = Sede::all();
        $this->listasPrecios = ListaPrecio::all();
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function updatedSedeId($value)
    {
        $this->almacenes = Almacen::where('sede_id', $value)->get();
        $this->reset(['almacen_id']);

        $this->resetPage();

    }

    public function updatedAlmacenId($value)
    {
        $this->almacen_id = $value;

        $this->resetPage();
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $inventarioQuery = Inventario::with(['variacion', 'variacion.producto', 'variacion.color', 'variacion.talla', 'variacion.listaPrecios'])
            ->where('almacen_id', $this->almacen_id);

        if ($this->buscarProducto) {
            $inventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $inventario = $inventarioQuery->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->orderBy('variacions.producto_id')
            ->select('inventarios.*')
            ->paginate(20);

        return view('livewire.erp.inventario.inventario-variacion-lista-precio-todas-livewire', [
            'inventario' => $inventario,
        ]);
    }
}