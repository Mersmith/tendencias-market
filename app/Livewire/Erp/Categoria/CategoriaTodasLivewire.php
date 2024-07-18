<?php

namespace App\Livewire\Erp\Categoria;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class CategoriaTodasLivewire extends Component
{
    use WithPagination;
    public $buscarCategoria;

    protected $paginate = 20;

    public function updatingBuscarCategoria()
    {
        $this->resetPage();
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categorias = Categoria::where('nombre', 'like', '%' . $this->buscarCategoria . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(100);

        $categoriasAgrupadas = $categorias->groupBy('categoria_padre_id');

        return view('livewire.erp.categoria.categoria-todas-livewire', [
            'categoriasAgrupadas' => $categoriasAgrupadas,
        ]);
    }
}
