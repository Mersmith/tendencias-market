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

    public function render()
    {
        $transferencias = TransferenciaAlmacen::where('id', 'like', '%' . $this->buscarGuia . '%')
        ->paginate(1);

        return view('livewire.erp.transferencia-almacen.transferencia-almacen-todas-livewire', [
            'transferencias' => $transferencias,
        ]);
    }
}
