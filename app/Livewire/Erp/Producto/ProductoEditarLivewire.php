<?php

namespace App\Livewire\Erp\Producto;

use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoEditarLivewire extends Component
{
    public $producto;
    public $subcategorias = [], $marcas = [];
    public $imagenes_inicial = [];

    public function mount($id)
    {
        $this->producto = Producto::with('imagens')->find($id);
        $this->imagenes_inicial = $this->producto->imagens;
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-editar-livewire');
    }
}
