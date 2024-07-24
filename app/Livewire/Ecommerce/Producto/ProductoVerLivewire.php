<?php

namespace App\Livewire\Ecommerce\Producto;

use App\Models\Producto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class ProductoVerLivewire extends Component
{
    public $producto;
    public $selectedColor;
    public $selectedSize;
    public $almacenId = 1;
    public $listaPrecioId = 3;
    public function mount($id, $slug = null)
    {
        $almacenId = 1;
        $listaPrecioId = 3;

        $this->producto = Producto::where('id', $id)
            ->whereHas('variaciones', function ($query) use ($almacenId) {
                $query->whereHas('inventarios', function ($query) use ($almacenId) {
                    $query->where('almacen_id', $almacenId)
                        ->where('stock', '>', 0);
                });
            })
            ->whereHas('listaPrecios', function ($query) use ($listaPrecioId) {
                $query->where('lista_precio_id', $listaPrecioId)
                    ->where('precio', '>', 0);
            })
            ->with([
                'variaciones' => function ($query) use ($almacenId) {
                    $query->whereHas('inventarios', function ($query) use ($almacenId) {
                        $query->where('almacen_id', $almacenId)
                            ->where('stock', '>', 0);
                    })->with([
                                'inventarios' => function ($query) use ($almacenId) {
                                    $query->where('almacen_id', $almacenId)
                                        ->where('stock', '>', 0);
                                }
                            ]);
                },
                'variaciones.color',
                'variaciones.talla',
                'listaPrecios' => function ($query) use ($listaPrecioId) {
                    $query->where('lista_precio_id', $listaPrecioId)
                        ->where('precio', '>', 0);
                },
                'descuentos' => function ($query) use ($listaPrecioId) {
                    $query->where('lista_precio_id', $listaPrecioId)
                        ->where('fecha_fin', '>', now());
                },
                'marca',
                'imagens'
            ])
            ->firstOrFail();

        if (!$slug || $slug !== $this->producto->slug) {
            return redirect()->route('ecommerce.producto.vista.ver', [
                'id' => $this->producto->id,
                'slug' => $this->producto->slug
            ]);
        }

    }

    public function updatedSelectedColor()
    {
        $this->selectedSize = null;
    }

    public function render()
    {
        return view('livewire.ecommerce.producto.producto-ver-livewire');
    }
}
