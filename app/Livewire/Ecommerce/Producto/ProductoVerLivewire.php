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
    public $colorSeleccionado;
    public $tallaSeleccionado;
    public $almacenId = 1;
    public $listaPrecioId = 3;

    public $tipo_variacion;

    public $carrito = [];
    public $variacionSeleccionada;
    public $cantidad = 1;
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
            ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id')
            ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id')
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
                'producto_descuentos.fecha_fin as descuento_fecha_fin',
                'colors.nombre as color_nombre',
                'tallas.nombre as talla_nombre'
            )
            ->where('productos.id', $id)
            ->where('inventarios.almacen_id', 1)
            ->where('inventarios.stock', '>', 0)
            ->get();

        //dd($variacionesData);

        if ($variacionesData->isNotEmpty()) {
            $this->producto = $variacionesData->first();

            $variacionColor = $this->producto->variacion_color;
            $variacionTalla = $this->producto->variacion_talla;

            if ($variacionColor && $variacionTalla) {
                $this->tipo_variacion = "VARIA-COLOR-TALLA";
                $this->variacionesData = $variacionesData->groupBy('color_id');
                $this->colorSeleccionado = $this->variacionesData->keys()->first();
                $this->tallaSeleccionado = $this->variacionesData[$this->colorSeleccionado]->first()->talla_id;
                $this->seleccionarVariacionColorTalla($this->colorSeleccionado, $this->tallaSeleccionado);
            } elseif ($variacionColor) {
                $this->tipo_variacion = "VARIA-COLOR";
                $this->variacionesData = $variacionesData->groupBy('color_id');
                $this->colorSeleccionado = $this->variacionesData->keys()->first();
                $this->seleccionarVariacionColor();
            } elseif ($variacionTalla) {
                $this->tipo_variacion = "VARIA-TALLA";
                $this->variacionesData = $variacionesData->groupBy('talla_id');
                $this->tallaSeleccionado = $this->variacionesData->keys()->first();
                $this->seleccionarVariacionTalla();
            } else {
                $this->tipo_variacion = "SIN-VARIACION";
                $this->variacionesData = $variacionesData;
                $this->variacionSeleccionada = $variacionesData->first();
            }

            if (!$slug || $slug !== $this->producto->slug) {
                return redirect()->route('ecommerce.producto.vista.ver', [
                    'id' => $this->producto->id,
                    'slug' => $this->producto->slug
                ]);
            }
        } else {
            abort(404, 'Producto no encontrado');
        }
    }

    public function updatedColorSeleccionado()
    {
        $this->tallaSeleccionado = null;
        $this->variacionSeleccionada = null;

        if ($this->tipo_variacion == "VARIA-COLOR") {
            $this->seleccionarVariacionColor();
        }
    }

    public function updatedTallaSeleccionado()
    {
        //VARIA COLOR Y TALLA
        if ($this->colorSeleccionado && $this->tallaSeleccionado) {
            $this->seleccionarVariacionColorTalla($this->colorSeleccionado, $this->tallaSeleccionado);
        } else {
            $this->colorSeleccionado = null;
            $this->variacionSeleccionada = null;

            if ($this->tipo_variacion == "VARIA-TALLA") {
                $this->seleccionarVariacionTalla();
            }
        }
    }

    public function seleccionarVariacionColor()
    {
        $variacionIdentica = $this->variacionesData[$this->colorSeleccionado]->first();
        if ($variacionIdentica) {
            $this->variacionSeleccionada = $variacionIdentica;
        }
    }

    public function seleccionarVariacionTalla()
    {
        $variacionIdentica = $this->variacionesData[$this->tallaSeleccionado]->first();
        if ($variacionIdentica) {
            $this->variacionSeleccionada = $variacionIdentica;
        }
    }

    public function seleccionarVariacionColorTalla($colorId, $tallaId)
    {
        //VARIA COLOR Y TALLA
        $variacionIdentica = $this->variacionesData[$colorId]->firstWhere('talla_id', $tallaId);
        if ($variacionIdentica) {
            $this->variacionSeleccionada = $variacionIdentica;
        }
    }

    public function agregarCarrito()
    {
        if ($this->variacionSeleccionada) {
            $exists = false;
            foreach ($this->carrito as &$cartItem) {
                if ($cartItem->variacion_id == $this->variacionSeleccionada->variacion_id) {
                    $cartItem->cantidad += $this->cantidad;
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $this->variacionSeleccionada->cantidad = $this->cantidad;
                $this->carrito[] = $this->variacionSeleccionada;
            }

            session()->flash('message', 'Producto agregado al carrito');
            $this->reset(['cantidad']);
        } else {
            session()->flash('message', 'ERROR');
        }
    }


    public function enviar()
    {
        dd($this->carrito);
    }

    public function render()
    {
        return view('livewire.ecommerce.producto.producto-ver-livewire');
    }
}
