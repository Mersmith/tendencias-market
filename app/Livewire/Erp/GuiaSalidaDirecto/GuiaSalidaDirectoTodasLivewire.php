<?php

namespace App\Livewire\Erp\GuiaSalidaDirecto;

use App\Models\GuiaSalidaDirecto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class GuiaSalidaDirectoTodasLivewire extends Component
{
    use WithPagination;
    public $buscarGuia;

    protected $paginate = 20;

    public function updatingBuscarGuia()
    {
        $this->resetPage();
    }

    public function render()
    {
        $guias = GuiaSalidaDirecto::where('id', 'like', '%' . $this->buscarGuia . '%')
            ->paginate(20);

        return view('livewire.erp.guia-salida-directo.guia-salida-directo-todas-livewire', [
            'guias' => $guias,
        ]);
    }
}
