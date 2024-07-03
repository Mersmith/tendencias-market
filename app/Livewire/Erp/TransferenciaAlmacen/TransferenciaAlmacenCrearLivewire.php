<?php

namespace App\Livewire\Erp\TransferenciaAlmacen;

use App\Models\Almacen;
use App\Models\Inventario;
use App\Models\Sede;
use App\Models\Serie;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class TransferenciaAlmacenCrearLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;

    public $sedes_origen = [], $almacenes_origen = [], $series_origen = [];
    public $sede_origen_id = null, $almacen_origen_id = null, $serie_origen_id = null;

    public $sedes_destino = [], $almacenes_destino = [], $series_destino = [];
    public $sede_destino_id = null, $almacen_destino_id = null, $serie_destino_id = null;

    public function mount()
    {
        $sedes = Sede::where('activo', true)->get();
        $this->sedes_origen = $sedes;
        $this->sedes_destino = $sedes;
    }

    public function updatedSedeOrigenId($value)
    {
        $this->almacenes_origen = Almacen::where('sede_id', $value)->get();
        $this->series_origen = Serie::where('sede_id', $value)
            ->where('tipo_documento_id', 2)
            ->get();

        $this->reset(['almacen_origen_id', 'serie_origen_id']);
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function updatedAlmacenOrigenId($value)
    {
        $this->resetPage();
    }

    public function updatedSedeDestinoId($value)
    {
        $this->almacenes_destino = Almacen::where('sede_id', $value)->get();
        $this->series_destino = Serie::where('sede_id', $value)
            ->where('tipo_documento_id', 2)
            ->get();

        $this->reset(['almacen_destino_id', 'serie_destino_id']);
    }

    public function render()
    {
        $inventarioQuery = Inventario::with(['variacion', 'variacion.producto', 'variacion.color', 'variacion.talla'])
            ->where('almacen_id', $this->almacen_origen_id);

        if ($this->buscarProducto) {
            $inventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $inventario = $inventarioQuery->orderBy('id', 'desc')->paginate(5);

        return view('livewire.erp.transferencia-almacen.transferencia-almacen-crear-livewire', [
            'inventario' => $inventario,
        ]);
    }
}
