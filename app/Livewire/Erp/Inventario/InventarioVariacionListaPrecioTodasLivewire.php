<?php

namespace App\Livewire\Erp\Inventario;

use App\Models\Almacen;
use App\Models\Categoria;
use App\Models\Inventario;
use App\Models\ListaPrecio;
use App\Models\Marca;
use App\Models\Sede;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class InventarioVariacionListaPrecioTodasLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;
    public $sedes = [];
    public $almacenes = [];
    public $categorias = [];
    public $marcas = [];
    public $sede_id = null;
    public $almacen_id = null;
    public $categoria_id = null;
    public $marca_id = null;
    public $lista_precio_id = null;
    public $listasPrecios;

    public $precioInicio = null;
    public $precioFin = null;

    public function mount()
    {
        $this->sedes = Sede::all();
        $this->listasPrecios = ListaPrecio::all();
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function updatedSedeId($value)
    {
        if ($value == "null") {
            $this->reset(['sede_id']);
        } else {
            $this->almacenes = Almacen::where('sede_id', $value)->get();
            $this->reset(['almacen_id', 'categoria_id', 'marca_id']);
        }

        $this->resetPage();
    }

    public function updatedAlmacenId($value)
    {
        if ($value == "null") {
            $this->reset(['almacen_id']);
        } else {
            $this->almacen_id = $value;
        }

        $this->resetPage();
    }

    public function updatedCategoriaId($value)
    {
        if ($value == "null") {
            $this->reset(['categoria_id']);
        } else {
            $this->categoria_id = $value;
        }

        $this->resetPage();
    }

    public function updatedMarcaId($value)
    {
        if ($value == "null") {
            $this->reset(['marca_id']);
        } else {
            $this->marca_id = $value;
        }

        $this->resetPage();
    }

    public function updatedListaPrecioId($value)
    {
        if ($value == "null") {
            $this->reset(['lista_precio_id']);
        } else {
            $this->lista_precio_id = $value;
        }

        $this->resetPage();
    }

    public function updatedPrecioInicio($value)
    {
        if ($value) {
            $this->precioInicio = $value;
        } else {
            $this->reset(['precioInicio']);
        }
        $this->resetPage();
    }

    public function updatedPrecioFin($value)
    {
        if ($value) {
            $this->precioFin = $value;
        } else {
            $this->reset(['precioFin']);
        }
        $this->resetPage();
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $inventarioQuery = Inventario::with(['variacion', 'variacion.producto', 'variacion.color', 'variacion.talla', 'variacion.producto.listaPrecios', 'variacion.producto.descuentos']);

        if ($this->almacen_id) {
            $inventarioQuery->where('almacen_id', $this->almacen_id);
        } elseif ($this->sede_id) {
            $almacenesIds = Almacen::where('sede_id', $this->sede_id)->pluck('id')->toArray();
            $inventarioQuery->whereIn('almacen_id', $almacenesIds);
        }

        if ($this->buscarProducto) {
            $inventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        if ($this->categoria_id) {
            $inventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('categoria_id', $this->categoria_id);
            });
        }

        if ($this->marca_id) {
            $inventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('marca_id', $this->marca_id);
            });
        }

        if ($this->lista_precio_id) {
            $inventarioQuery->whereHas('variacion.producto.listaPrecios', function ($query) {
                $query->where('lista_precio_id', $this->lista_precio_id)
                    ->where('precio', '>', 0);

                if ($this->precioInicio !== null && $this->precioFin !== null) {
                    $query->where('precio', '>=', $this->precioInicio)
                        ->where('precio', '<=', $this->precioFin);
                } elseif ($this->precioInicio !== null) {
                    $query->where('precio', '>=', $this->precioInicio);
                }
            });
        }

        $inventario = $inventarioQuery->join('variacions', 'inventarios.variacion_id', '=', 'variacions.id')
            ->orderBy('variacions.producto_id')
            ->select('inventarios.*')
            ->paginate(20);

        return view('livewire.erp.inventario.inventario-variacion-lista-precio-todas-livewire', [
            'inventario' => $inventario,
        ]);
    }
}
