<?php

namespace App\Livewire\Erp\TransferenciaAlmacen;

use App\Models\TransferenciaAlmacen;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class TransferenciaAlmacenTodasLivewire extends Component
{
    use WithPagination;
    public $buscarGuia;

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

        $transferencias = $transferenciasQuery->orderBy('fecha_transferencia', 'desc')->paginate(20);

        return view('livewire.erp.transferencia-almacen.transferencia-almacen-todas-livewire', [
            'transferencias' => $transferencias,
        ]);
    }
}
