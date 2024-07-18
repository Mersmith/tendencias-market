<?php

namespace App\Livewire\Ecommerce\Categoria;

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

        $this->categoriaFamilia = $this->getCategoriaFamilia($this->categoria);

        $this->productosConStock = $this->getProductosConStock();
    }

    private function getProductosConStock()
    {
        return Producto::where('categoria_id', $this->categoria->id)
            ->whereHas('variaciones.inventarios', function ($query) {
                $query->where('almacen_id', 1)
                    ->where('stock', '>', 0);
            })
            ->with([
                'variaciones' => function ($query) {
                    $query->whereHas('inventarios', function ($subQuery) {
                        $subQuery->where('almacen_id', 1)
                            ->where('stock', '>', 0);
                    })
                        ->with([
                            'inventarios' => function ($subQuery) {
                                $subQuery->where('almacen_id', 1)
                                    ->where('stock', '>', 0);
                            }
                        ])
                        ->take(1);
                },
                'imagens',
                'descuentos' => function ($query) {
                    $query->where('lista_precio_id', 3);
                },
                'listaPrecios' => function ($query) {
                    $query->where('lista_precio_id', 3);
                }
            ])
            ->get();
    }

    private function getCategoriaFamilia($categoria)
    {
        $familia = collect();

        // Agregar la categoría actual
        $familia->push($categoria);

        // Agregar la categoría padre si existe
        if ($categoria->categoriaPadre) {
            $familia->prepend($categoria->categoriaPadre);
        }

        // Agregar las subcategorias
        foreach ($categoria->subcategorias as $subcategoria) {
            $familia->push($subcategoria);
        }

        return $familia;
    }

    public function render()
    {
        return view('livewire.ecommerce.categoria.categoria-ver-livewire');
    }
}
