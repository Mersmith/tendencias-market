<?php

namespace App\Livewire\Erp\GuiaEntradaDirecto;

use App\Models\GuiaEntradaDirecto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class GuiaEntradaDirectoTodasLivewire extends Component
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
        $guias = GuiaEntradaDirecto::where('id', 'like', '%' . $this->buscarGuia . '%')
            ->paginate(20);

        return view('livewire.erp.guia-entrada-directo.guia-entrada-directo-todas-livewire', [
            'guias' => $guias,
        ]);
    }
}
