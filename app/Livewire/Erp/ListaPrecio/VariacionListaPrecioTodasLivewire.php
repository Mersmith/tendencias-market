<?php

namespace App\Livewire\Erp\ListaPrecio;

use App\Models\ListaPrecio;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class VariacionListaPrecioTodasLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;
    protected $paginate = 20;

    public $listasPrecios;

    public function mount()
    {
        $this->listasPrecios = ListaPrecio::all();
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $variacionesQuery = Variacion::with(['producto', 'color', 'talla', 'listaPrecios']);

        if ($this->buscarProducto) {
            $variacionesQuery->whereHas('producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $variaciones = $variacionesQuery->orderBy('producto_id')->paginate(20);

        return view('livewire.erp.lista-precio.variacion-lista-precio-todas-livewire', [
            'variaciones' => $variaciones,
        ]);
    }
}
