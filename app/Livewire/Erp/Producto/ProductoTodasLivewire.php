<?php

namespace App\Livewire\Erp\Producto;

use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class ProductoTodasLivewire extends Component
{
    use WithPagination;
    public $buscarProducto;

    protected $paginate = 20;

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
        $productos = Producto::where('nombre', 'like', '%' . $this->buscarProducto . '%')
            ->orderBy('created_at', 'desc') // Ordenar por fecha de creación
            ->paginate(20);

        return view('livewire.erp.producto.producto-todas-livewire', [
            'productos' => $productos,
        ]);
    }
}
