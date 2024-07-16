<?php

namespace App\Livewire\Erp\GuiaSalidaDirecto;

use App\Models\Almacen;
use App\Models\GuiaSalidaDirecto;
use App\Models\Sede;
use App\Models\Serie;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class GuiaSalidaDirectoTodasLivewire extends Component
{
    use WithPagination;
    public $buscarGuia;

    public $sedes = [], $almacenes = [], $series = [];
    public $sede_id = null, $almacen_id = null, $serie_nombre = null;

    public function mount()
    {
        $this->sedes = Sede::all();
    }

    public function updatedSedeId($value)
    {
        if ($value == "null") {
            $this->reset(['sede_id']);
        } else {
            $this->almacenes = Almacen::where('sede_id', $value)->get();

            $this->series = Serie::where('sede_id', $value)
                //->where('tipo_documento_id', 3)
                ->get();
        }
        $this->reset(['almacen_id', 'serie_nombre']);
        $this->resetPage();
    }

    public function updatedAlmacenId($value)
    {
        if ($value == "null") {
            $this->reset(['almacen_id']);
        } else {
            $this->almacen_id = $value;
        }

        $this->resetPage();
    }

    public function updatedSerieNombre($value)
    {
        if ($value == "null") {
            $this->reset(['serie_nombre']);
        } else {
            $this->serie_nombre = $value;
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
        $guiasQuery = GuiaSalidaDirecto::query();

        if ($this->buscarGuia) {
            $guiasQuery->where('correlativo', 'like', '%' . $this->buscarGuia . '%');
        }

        if ($this->sede_id) {
            $guiasQuery->where('sede_id', $this->sede_id);
        }

        if ($this->almacen_id) {
            $guiasQuery->where('almacen_id', $this->almacen_id);
        }

        if ($this->serie_nombre) {
            $guiasQuery->where('serie', 'like', '%' . $this->serie_nombre . '%');
        }

        $guias = $guiasQuery->orderBy('fecha_salida', 'desc')->paginate(20);

        return view('livewire.erp.guia-salida-directo.guia-salida-directo-todas-livewire', [
            'guias' => $guias,
        ]);
    }
}
