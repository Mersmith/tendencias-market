<?php

namespace App\Livewire\Ecommerce\Producto;

use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class ProductoVerLivewire extends Component
{

    public $producto;

    public function mount($id, $slug = null)
    {
         // Buscar el producto por ID
         $this->producto = Producto::with([
            'variaciones',
            'imagens',
            'marca',
            'descuentos',
            'categoria'
        ])->where('id', $id)->firstOrFail();

        // Si el slug no se proporciona o no coincide, redirigir
        if (!$slug || $slug !== $this->producto->slug) {
            return redirect()->route('ecommerce.producto.vista.ver', [
                'id' => $this->producto->id,
                'slug' => $this->producto->slug
            ]);
        }
    }


    public function render()
    {
        return view('livewire.ecommerce.producto.producto-ver-livewire');
    }
}
