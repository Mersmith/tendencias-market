<?php

namespace App\Livewire\Ecommerce\Categoria;

use App\Http\Controllers\Erp\CategoriaController;
use App\Http\Controllers\Erp\ProductoController;
use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class CategoriaVerLivewire extends Component
{
    public $categoria;
    public $categoriaFamilia;

    public $productosConStock;

    public function mount($id, $slug = null)
    {
        $this->categoria = Categoria::where('id', $id)->firstOrFail();

        if (!$slug || $slug !== $this->categoria->slug) {
            return redirect()->route('ecommerce.categoria.vista.ver', [
                'id' => $this->categoria->id,
                'slug' => $this->categoria->slug
            ]);
        }

        $this->categoriaFamilia = app(CategoriaController::class)->getCategoriaFamiliaVertical($this->categoria);
        $this->productosConStock = app(ProductoController::class)->getEcommerceProductosConStockCategoriaAlmacenListaPrecio($this->categoria->id);
    }

    public function render()
    {
        return view('livewire.ecommerce.categoria.categoria-ver-livewire');
    }
}
