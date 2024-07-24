<?php

namespace App\Livewire\Ecommerce\Producto;

use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.ecommerce.layout-ecommerce')]
class ProductoVerLivewire extends Component
{
    public $variacionesData;
    public $producto;
    public $variaciones;
    public $selectedColor;
    public $selectedSize;
    public $almacenId = 1;
    public $listaPrecioId = 3;

    public $tipo_variacion;

    public function mount($id, $slug = null)
    {
        $variacionesData = DB::table('productos')
            ->join('variacions', 'productos.id', '=', 'variacions.producto_id')
            ->join('inventarios', 'variacions.id', '=', 'inventarios.variacion_id')
            ->join('producto_lista_precios', function ($join) {
                $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                    ->where('producto_lista_precios.lista_precio_id', 3)
                    ->where('producto_lista_precios.precio', '>', 0);
            })
            ->leftJoin('producto_descuentos', function ($join) {
                $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                    ->where('producto_descuentos.lista_precio_id', 3)
                    ->where('producto_descuentos.fecha_fin', '>', now());
            })
            ->select(
                'productos.*',
                'variacions.id as variacion_id',
                'variacions.color_id',
                'variacions.talla_id',
                'variacions.activo as variacion_activo',
                'inventarios.id as inventario_id',
                'inventarios.stock',
                'inventarios.stock_minimo',
                'producto_lista_precios.precio',
                'producto_lista_precios.precio_antiguo',
                'producto_lista_precios.simbolo',
                'producto_descuentos.porcentaje_descuento',
                'producto_descuentos.fecha_fin as descuento_fecha_fin'
            )
            ->where('productos.id', $id)
            ->where('inventarios.almacen_id', 1)
            ->where('inventarios.stock', '>', 0)
            ->get();

        if ($variacionesData->isNotEmpty()) {
            $this->producto = $variacionesData->first();
            $this->variaciones = $variacionesData;

            $variacionColor = $this->producto->variacion_color;
            $variacionTalla = $this->producto->variacion_talla;

            if ($variacionColor && $variacionTalla) {
                $this->tipo_variacion = "VARIA-COLOR-TALLA";
                $this->variacionesData = $variacionesData->groupBy('color_id');
            } elseif ($variacionColor) {
                $this->tipo_variacion = "VARIA-COLOR";
                $this->variacionesData = $variacionesData->groupBy('color_id');
            } elseif ($variacionTalla) {
                $this->tipo_variacion = "VARIA-TALLA";
                $this->variacionesData = $variacionesData->groupBy('talla_id');
            } else {
                $this->tipo_variacion = "SIN VARIACION";
                $this->variacionesData = $variacionesData;
            }
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
