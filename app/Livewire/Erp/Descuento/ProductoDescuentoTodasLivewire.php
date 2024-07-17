<?php

namespace App\Livewire\Erp\Descuento;

use App\Models\ListaPrecio;
use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class ProductoDescuentoTodasLivewire extends Component
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
        $productosQuery = Producto::with('descuentos');

        if ($this->buscarProducto) {
            $productosQuery->where('nombre', 'like', '%' . $this->buscarProducto . '%');
        }

        $productos = $productosQuery->orderBy('id')->paginate($this->paginate);

        return view('livewire.erp.descuento.producto-descuento-todas-livewire', [
            'productos' => $productos,
        ]);
    }
}
