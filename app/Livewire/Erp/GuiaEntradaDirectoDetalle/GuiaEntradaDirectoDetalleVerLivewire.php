<?php

namespace App\Livewire\Erp\GuiaEntradaDirectoDetalle;

use App\Models\GuiaEntradaDirecto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class GuiaEntradaDirectoDetalleVerLivewire extends Component
{
    public $guia;

    public $detalle;

    public function mount($id)
    {
        $this->guia = GuiaEntradaDirecto::find($id);

        if (!$this->guia) {
            abort(404, 'Guia no encontrado');
        }

        $this->detalle = $this->guia->detalles;
    }

    public function render()
    {
        return view('livewire.erp.guia-entrada-directo-detalle.guia-entrada-directo-detalle-ver-livewire');
    }
}
