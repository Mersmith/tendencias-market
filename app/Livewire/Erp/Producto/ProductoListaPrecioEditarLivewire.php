<?php

namespace App\Livewire\Erp\Producto;

use App\Models\ListaPrecio;
use App\Models\Producto;
use App\Models\VariacionListaPrecios;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoListaPrecioEditarLivewire extends Component
{
    public $producto;
    public $tipo_variacion;
    public $variaciones = [];
    public $listasPrecios = [];
    public $precios = [];

    public function mount($id)
    {
        $this->producto = Producto::with('variaciones.talla', 'variaciones.color', 'variaciones.precios')->find($id);

        if (!$this->producto) {
            abort(404, 'Producto no encontrado');
        }

        $this->listasPrecios = ListaPrecio::all();

        $this->variaciones = $this->producto->variaciones->toArray();

        if ($this->producto->variacion_talla && $this->producto->variacion_color) {
            $this->tipo_variacion = "talla-color";
        } elseif ($this->producto->variacion_talla && !$this->producto->variacion_color) {
            $this->tipo_variacion = "talla";
        } elseif (!$this->producto->variacion_talla && $this->producto->variacion_color) {
            $this->tipo_variacion = "color";
        } else {
            $this->tipo_variacion = "sin-variacion";
        }

        foreach ($this->variaciones as $variacion) {
            $precios = collect($variacion['precios']);
            foreach ($this->listasPrecios as $listaPrecio) {
                $precio = $precios->firstWhere('pivot.lista_precio_id', $listaPrecio->id);
                $this->precios[$variacion['id']][$listaPrecio->id] = $precio ? $precio['pivot']['precio'] : 0;
            }
        }
    }

    public function guardarPrecio($variacionId, $listaPrecioId)
    {
        $precio = $this->precios[$variacionId][$listaPrecioId];
        VariacionListaPrecios::updateOrCreate(
            ['variacion_id' => $variacionId, 'lista_precio_id' => $listaPrecioId],
            ['precio' => $precio]
        );

        $this->dispatch('alertaLivewire', "Actualizado");
    }

    public function guardarPrecioMasivamente()
    {
        foreach ($this->precios as $variacionId => $preciosPorVariacion) {
            foreach ($preciosPorVariacion as $listaPrecioId => $precio) {
                VariacionListaPrecios::updateOrCreate(
                    ['variacion_id' => $variacionId, 'lista_precio_id' => $listaPrecioId],
                    ['precio' => $precio]
                );
            }
        }

        $this->dispatch('alertaLivewire', "Actualizado");
    }
    public function render()
    {
        return view('livewire.erp.producto.producto-lista-precio-editar-livewire');
    }
}
