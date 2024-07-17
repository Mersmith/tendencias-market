<?php

namespace App\Livewire\Erp\Producto;

use App\Models\ListaPrecio;
use App\Models\Producto;
use App\Models\ProductoDescuento;
use App\Models\ProductoListaPrecios;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.erp.layout-erp')]
class ProductoDescuentoEditarLivewire extends Component
{
    public $producto;
    public $listasPrecios;
    public $datos = [];

    public function mount($id)
    {
        $this->producto = Producto::with('descuentos')->find($id);

        $this->listasPrecios = ListaPrecio::all();

        if (!$this->producto) {
            abort(404, 'Producto no encontrado');
        }

        foreach ($this->listasPrecios as $listaPrecio) {
            $productoListaPrecio = $this->producto->descuentos->where('lista_precio_id', $listaPrecio->id)->first();

            $this->datos[$listaPrecio->id] = [
                'porcentaje_descuento' => $productoListaPrecio->porcentaje_descuento ?? 0,
                'fecha_fin' => $productoListaPrecio->fecha_fin ?? null,
            ];
        }
    }

    public function guardarPrecioMasivamente()
    {
        foreach ($this->datos as $lista_precio_id => $precioData) {
            $porcentaje_descuento = $precioData['porcentaje_descuento'];
            $fecha_fin = $precioData['fecha_fin'];

            if ($porcentaje_descuento > 0 && !empty($fecha_fin)) {
                ProductoDescuento::updateOrCreate(
                    [
                        'producto_id' => $this->producto->id,
                        'lista_precio_id' => $lista_precio_id,
                    ],
                    [
                        'porcentaje_descuento' => $porcentaje_descuento,
                        'fecha_fin' => $fecha_fin,
                    ]
                );
            } elseif ($porcentaje_descuento == 0) {
                ProductoDescuento::updateOrCreate(
                    [
                        'producto_id' => $this->producto->id,
                        'lista_precio_id' => $lista_precio_id,
                    ],
                    [
                        'porcentaje_descuento' => 0,
                        'fecha_fin' => $fecha_fin,
                    ]
                );
            }
        }

        $this->dispatch('alertaLivewire', "Actualizado");
    }

    public function render()
    {
        return view('livewire.erp.producto.producto-descuento-editar-livewire');
    }
}
