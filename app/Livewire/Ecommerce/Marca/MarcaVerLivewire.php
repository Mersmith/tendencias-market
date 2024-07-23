<?php

namespace App\Livewire\Ecommerce\Marca;

use App\Http\Controllers\Erp\MarcaController;
use App\Models\Categoria;
use App\Models\Marca;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class MarcaVerLivewire extends Component
{
    use WithPagination;

    public $marca;

    public $categorias;

    public $precios = [
        ['id' => 1, 'precio_inicio' => 50, 'precio_fin' => 100],
        ['id' => 2, 'precio_inicio' => 100, 'precio_fin' => 150],
        ['id' => 3, 'precio_inicio' => 150, 'precio_fin' => 200],
        ['id' => 4, 'precio_inicio' => 200, 'precio_fin' => 300],
        ['id' => 5, 'precio_inicio' => 300, 'precio_fin' => 2000],
        ['id' => 6, 'precio_inicio' => 2000, 'precio_fin' => 5000],
        ['id' => 7, 'precio_inicio' => 5000, 'precio_fin' => null],
    ];

    public $selectedCategorias = [];

    public $selectedPrecios = [];

    public $preciosAgregados = [];

    public function mount($slug)
    {
        $this->marca = Marca::where('slug', $slug)->firstOrFail();

        $this->categorias = Categoria::all();
    }

    public function updatedSelectedCategorias()
    {
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
        $this->resetPage();
    }

    public function getFilteredProductosConStock()
    {
        return app(MarcaController::class)
            ->getEcommerceProductosConStockMarcaAlmacenListaPrecio(
                1,//Almacen // sede 1
                3,//Lista precio
                $this->marca->id,//marca 1
                $this->selectedCategorias,
                $this->preciosAgregados,
            );
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.ecommerce.marca.marca-ver-livewire', [
            'productosConStock' => $this->getFilteredProductosConStock()
        ]);
    }
}
