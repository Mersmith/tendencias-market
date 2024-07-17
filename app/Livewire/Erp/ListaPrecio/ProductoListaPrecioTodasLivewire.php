<?php

namespace App\Livewire\Erp\ListaPrecio;

use App\Models\ListaPrecio;
use App\Models\Producto;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class ProductoListaPrecioTodasLivewire extends Component
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
        $productosQuery = Producto::with('listaPrecios')
            ->orderByRaw('(SELECT COUNT(*) FROM producto_lista_precios WHERE producto_lista_precios.producto_id = productos.id AND producto_lista_precios.precio > 0) DESC');

        if ($this->buscarProducto) {
            $productosQuery->where('nombre', 'like', '%' . $this->buscarProducto . '%');
        }

        $productos = $productosQuery->orderBy('id')->paginate($this->paginate);

        return view('livewire.erp.lista-precio.producto-lista-precio-todas-livewire', [
            'productos' => $productos,
        ]);
    }
}
