<?php

namespace App\Livewire\Erp\GuiaSalidaDirectoDetalle;

use App\Models\GuiaSalidaDirecto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class GuiaSalidaDirectoDetalleVerLivewire extends Component
{
    public $guia;

    public $detalle;

    public function mount($id)
    {
        $this->guia = GuiaSalidaDirecto::find($id);

        if (!$this->guia) {
            abort(404, 'Guia no encontrado');
        }

        $this->detalle = $this->guia->detalles;
    }

    public function render()
    {
        return view('livewire.erp.guia-salida-directo-detalle.guia-salida-directo-detalle-ver-livewire');
    }
}
