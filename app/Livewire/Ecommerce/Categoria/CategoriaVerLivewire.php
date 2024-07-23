<?php

namespace App\Livewire\Ecommerce\Categoria;

use App\Http\Controllers\Erp\CategoriaController;
use App\Http\Controllers\Erp\ProductoController;
use App\Models\Categoria;
use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class CategoriaVerLivewire extends Component
{
    use WithPagination;

    public $categoria;
    public $categoriaFamilia;

    public $productosConStock;

    public $marcas;
    public $precios = [
        ['id' => 1, 'precio_inicio' => 50, 'precio_fin' => 100],
        ['id' => 2, 'precio_inicio' => 100, 'precio_fin' => 150],
        ['id' => 3, 'precio_inicio' => 150, 'precio_fin' => 200],
        ['id' => 4, 'precio_inicio' => 200, 'precio_fin' => 300],
        ['id' => 5, 'precio_inicio' => 300, 'precio_fin' => 2000],
        ['id' => 6, 'precio_inicio' => 2000, 'precio_fin' => 5000],
        ['id' => 7, 'precio_inicio' => 5000, 'precio_fin' => null],
    ];
    public $selectedMarcas = [];
    public $selectedPrecios = [];

    public $preciosAgregados = [];


    public function mount($id, $slug = null)
    {
        $this->categoria = Categoria::where('id', $id)->firstOrFail();

        if (!$slug || $slug !== $this->categoria->slug) {
            return redirect()->route('ecommerce.categoria.vista.ver', [
                'id' => $this->categoria->id,
                'slug' => $this->categoria->slug
            ]);
        }

        $this->marcas = $this->categoria->marcas;

        $this->categoriaFamilia = app(CategoriaController::class)->getCategoriaFamiliaVertical($this->categoria);

        $this->productosConStock = $this->getFilteredProductosConStock();
    }

    public function updatedSelectedMarcas()
    {
        $this->productosConStock = $this->getFilteredProductosConStock();
        $this->resetPage();
    }

    public function updatedSelectedPrecios($value)
    {
        $this->preciosAgregados = [];

        foreach ($this->selectedPrecios as $precioId) {
            $precioEncontrado = collect($this->precios)->firstWhere('id', $precioId);
            if ($precioEncontrado && !in_array($precioEncontrado, $this->preciosAgregados)) {
                $this->preciosAgregados[] = $precioEncontrado;
            }
        }
        $this->productosConStock = $this->getFilteredProductosConStock();
        $this->resetPage();
    }

    public function getFilteredProductosConStock()
    {
        return app(ProductoController::class)
            ->getEcommerceProductosConStockCategoriaAlmacenListaPrecio(
                1,
                3,
                $this->categoria->id,
                $this->selectedMarcas,
                $this->preciosAgregados,
            );
    }

    public function render()
    {
        return view('livewire.ecommerce.categoria.categoria-ver-livewire', [
            'productosConStock' => $this->productosConStock
        ]);
    }
}
