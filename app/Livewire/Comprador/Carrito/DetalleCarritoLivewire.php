<?php

namespace App\Livewire\Comprador\Carrito;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Carrito;
use App\Models\CarritoDetalle;
use Illuminate\Support\Facades\DB;
class DetalleCarritoLivewire extends Component
{
    public $carrito;
    public $cantidadItems;
    public $totalGeneral;

    public function mount()
    {
        $this->actualizarCarrito();
    }

    public function actualizarCarrito()
    {
        $almacenEcommerceId = 1;
        $listaPrecioEtiquetaId = 3;

        $user = Auth::user();
        if ($user) {
            $this->carrito = DB::table('carritos')
                ->where('user_id', $user->id)
                ->first();

            if ($this->carrito) {
                // Subconsulta para obtener el ID de la primera imagen para cada producto
                $subquery = DB::table('imagenables')
                    ->join('imagens', 'imagenables.imagen_id', '=', 'imagens.id')
                    ->select('imagenables.imagenable_id', DB::raw('MIN(imagens.id) as primera_imagen_id'))
                    ->where('imagenables.imagenable_type', 'App\Models\Producto') // Tipo de imagenable
                    ->groupBy('imagenables.imagenable_id');

                // Subconsulta para obtener la URL de la primera imagen
                $imagenSubquery = DB::table('imagens')
                    ->joinSub($subquery, 'primera_imagen', function ($join) {
                        $join->on('imagens.id', '=', 'primera_imagen.primera_imagen_id');
                    })
                    ->select('primera_imagen.imagenable_id', 'imagens.url as imagen_url');

                // Consulta principal
                $detalles = DB::table('carrito_detalles')
                    ->join('variacions', 'carrito_detalles.variacion_id', '=', 'variacions.id')
                    ->join('productos', 'variacions.producto_id', '=', 'productos.id')
                    ->join('producto_lista_precios', function ($join) use ($listaPrecioEtiquetaId) {
                        $join->on('productos.id', '=', 'producto_lista_precios.producto_id')
                            ->where('producto_lista_precios.lista_precio_id', $listaPrecioEtiquetaId)
                            ->where('producto_lista_precios.precio', '>', 0);
                    })
                    ->leftJoin('producto_descuentos', function ($join) use ($listaPrecioEtiquetaId) {
                        $join->on('productos.id', '=', 'producto_descuentos.producto_id')
                            ->where('producto_descuentos.lista_precio_id', $listaPrecioEtiquetaId)
                            ->where('producto_descuentos.fecha_fin', '>', now());
                    })
                    ->leftJoin('tallas', 'variacions.talla_id', '=', 'tallas.id') // Unir con la tabla de tallas
                    ->leftJoin('colors', 'variacions.color_id', '=', 'colors.id') // Unir con la tabla de colores
                    ->leftJoin('marcas', 'productos.marca_id', '=', 'marcas.id') // Unir con la tabla de marcas
                    ->leftJoinSub($imagenSubquery, 'primer_imagen', function ($join) {
                        $join->on('productos.id', '=', 'primer_imagen.imagenable_id');
                    })
                    ->leftJoin('inventarios', function ($join) use ($almacenEcommerceId) {
                        $join->on('variacions.id', '=', 'inventarios.variacion_id')
                            ->where('inventarios.almacen_id', $almacenEcommerceId)
                            ->where('inventarios.stock', '>', 0);
                    })
                    ->where('carrito_detalles.carrito_id', $this->carrito->id)
                    ->select(
                        'carrito_detalles.carrito_id',
                        'carrito_detalles.id as carrito_detalle_id',
                        'carrito_detalles.variacion_id',
                        'primer_imagen.imagen_url', // Seleccionar la URL de la primera imagen
                        'productos.nombre as producto_nombre',
                        'marcas.nombre as marca_nombre', // Seleccionar el nombre de la marca
                        'colors.nombre as color_nombre', // Seleccionar el nombre del color
                        'tallas.nombre as talla_nombre', // Seleccionar el nombre de la talla
                        'carrito_detalles.cantidad',
                        'inventarios.stock', // Seleccionar el stock
                        'inventarios.stock_minimo', // Seleccionar el stock mínimo
                        'producto_lista_precios.precio_antiguo',
                        'producto_lista_precios.precio as precio_normal', // Seleccionar el precio de la lista
                        DB::raw('IF(producto_descuentos.porcentaje_descuento > 0 AND producto_descuentos.fecha_fin > NOW(), ROUND(producto_lista_precios.precio - (producto_lista_precios.precio * producto_descuentos.porcentaje_descuento / 100), 2), NULL) as precio_oferta'),
                        'producto_descuentos.porcentaje_descuento',
                        'producto_descuentos.fecha_fin as descuento_fecha_fin',
                    )
                    ->get();

                //dd($detalles);

                $this->cantidadItems = $detalles->count();
                $this->totalGeneral = $detalles->reduce(function ($carry, $detalle) {
                    return $carry + ($detalle->cantidad * $detalle->precio_normal);
                }, 0);

                $this->carrito->detalle = $detalles;
            } else {
                $this->cantidadItems = 0;
                $this->totalGeneral = 0;
                $this->carrito->detalle = collect();
            }
        }
    }

    public function incrementarCantidad($detalleId)
    {
        $detalle = CarritoDetalle::find($detalleId);
        if ($detalle) {
            $detalle->cantidad++;
            $detalle->save();
            $this->actualizarCarrito();
        }
    }

    public function disminuirCantidad($detalleId)
    {
        $detalle = CarritoDetalle::find($detalleId);
        if ($detalle && $detalle->cantidad > 1) {
            $detalle->cantidad--;
            $detalle->save();
            $this->actualizarCarrito();
        }
    }

    public function eliminarDetalle($detalleId)
    {
        $detalle = CarritoDetalle::find($detalleId);
        if ($detalle) {
            $detalle->delete();
            $this->actualizarCarrito();
        }
    }


    public function render()
    {
        return view('livewire.comprador.carrito.detalle-carrito-livewire');
    }
}
