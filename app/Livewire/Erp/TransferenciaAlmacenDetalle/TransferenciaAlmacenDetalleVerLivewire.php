<?php

namespace App\Livewire\Erp\TransferenciaAlmacenDetalle;

use App\Models\TransferenciaAlmacen;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class TransferenciaAlmacenDetalleVerLivewire extends Component
{
    public $transferencia;

    public $detalle;

    public function mount($id)
    {
        $this->transferencia = TransferenciaAlmacen::find($id);

        if (!$this->transferencia) {
            abort(404, 'Transferencia no encontrado');
        }

        $this->detalle = $this->transferencia->detalles;
    }

    public function render()
    {
        return view('livewire.erp.transferencia-almacen-detalle.transferencia-almacen-detalle-ver-livewire');
    }
}
