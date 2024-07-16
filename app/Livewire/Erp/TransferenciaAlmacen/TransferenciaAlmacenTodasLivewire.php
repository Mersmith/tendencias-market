<?php

namespace App\Livewire\Erp\TransferenciaAlmacen;

use App\Models\Almacen;
use App\Models\Sede;
use App\Models\Serie;
use App\Models\TransferenciaAlmacen;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class TransferenciaAlmacenTodasLivewire extends Component
{
    use WithPagination;
    public $buscarGuia;

    public $sedes_origen = [], $almacenes_origen = [], $series_origen = [];
    public $sede_origen_id = null, $almacen_origen_id = null, $serie_origen_nombre = null;

    public function mount()
    {
        $sedes = Sede::all();
        $this->sedes_origen = Sede::all();
    }

    public function updatedSedeOrigenId($value)
    {
        if ($value == "null") {
            $this->reset(['sede_origen_id']);
        } else {
            $this->almacenes_origen = Almacen::where('sede_id', $value)->get();

            $this->series_origen = Serie::where('sede_id', $value)
                //->where('tipo_documento_id', 3)
                ->get();
        }
        $this->reset(['almacen_origen_id', 'serie_origen_nombre']);
        $this->resetPage();
    }

    public function updatedAlmacenOrigenId($value)
    {
        if ($value == "null") {
            $this->reset(['almacen_origen_id']);
        } else {
            $this->almacen_origen_id = $value;
        }

        $this->resetPage();
    }

    public function updatedSerieOrigenNombre($value)
    {
        if ($value == "null") {
            $this->reset(['serie_origen_nombre']);
        } else {
            $this->serie_origen_nombre = $value;
        }

        $this->resetPage();
    }

    public function updatingBuscarGuia()
    {
        $this->resetPage();
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $transferenciasQuery = TransferenciaAlmacen::query();

        if ($this->buscarGuia) {
            $transferenciasQuery->where('correlativo_origen', 'like', '%' . $this->buscarGuia . '%');
        }

        if ($this->sede_origen_id) {
            $transferenciasQuery->where('sede_origen_id', $this->sede_origen_id);
        }

        if ($this->almacen_origen_id) {
            $transferenciasQuery->where('almacen_origen_id', $this->almacen_origen_id);
        }

        if ($this->serie_origen_nombre) {
            $transferenciasQuery->where('serie_origen', 'like', '%' . $this->serie_origen_nombre . '%');
        }

        $transferencias = $transferenciasQuery->orderBy('fecha_transferencia', 'desc')->paginate(20);

        return view('livewire.erp.transferencia-almacen.transferencia-almacen-todas-livewire', [
            'transferencias' => $transferencias,
        ]);
    }
}
