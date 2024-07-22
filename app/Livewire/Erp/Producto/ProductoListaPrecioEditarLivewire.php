<?php

namespace App\Livewire\Erp\Producto;

use App\Models\ListaPrecio;
use App\Models\Producto;
use App\Models\ProductoListaPrecios;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoListaPrecioEditarLivewire extends Component
{
    public $producto;
    public $listasPrecios;
    public $precios = [];

    public function mount($id)
    {
        $this->producto = Producto::with('listaPrecios')->find($id);

        $this->listasPrecios = ListaPrecio::all();

        if (!$this->producto) {
            abort(404, 'Producto no encontrado');
        }

        foreach ($this->listasPrecios as $listaPrecio) {
            $productoListaPrecio = $this->producto->listaPrecios->where('lista_precio_id', $listaPrecio->id)->first();

            $this->precios[$listaPrecio->id] = [
                'precio' => $productoListaPrecio->precio ?? 0,
                'precio_antiguo' => $productoListaPrecio->precio_antiguo ?? 0,
            ];
        }
    }

    public function guardarPrecioMasivamente()
    {
        foreach ($this->precios as $lista_precio_id => $precioData) {
            $precio = $precioData['precio'];
            $precio_antiguo = $precioData['precio_antiguo'];

            if ($precio > 0 && $precio_antiguo === 0) {
                ProductoListaPrecios::updateOrCreate(
                    [
                        'producto_id' => $this->producto->id,
                        'lista_precio_id' => $lista_precio_id,
                    ],
                    [
                        'precio' => $precio,
                        'precio_antiguo' => null,
                        'simbolo' => 'S/',
                    ]
                );
            } elseif ($precio > 0 && $precio_antiguo > 0) {
                ProductoListaPrecios::updateOrCreate(
                    [
                        'producto_id' => $this->producto->id,
                        'lista_precio_id' => $lista_precio_id,
                    ],
                    [
                        'precio' => $precio,
                        'precio_antiguo' => $precio_antiguo,
                        'simbolo' => 'S/',
                    ]
                );
            } elseif ($precio == 0) {
                ProductoListaPrecios::updateOrCreate(
                    [
                        'producto_id' => $this->producto->id,
                        'lista_precio_id' => $lista_precio_id,
                    ],
                    [
                        'precio' => null,
                        'precio_antiguo' => null,
                        'simbolo' => 'S/',
                    ]
                );
            } /*elseif ($precio > 0 && $precio_antiguo === null) {
                continue;
            }*/
        }

        $this->dispatch('alertaLivewire', "Actualizado");
    }
    public function render()
    {
        return view('livewire.erp.producto.producto-lista-precio-editar-livewire');
    }
}
