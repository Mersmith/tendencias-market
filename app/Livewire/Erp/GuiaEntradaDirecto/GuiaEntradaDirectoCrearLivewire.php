<?php

namespace App\Livewire\Erp\GuiaEntradaDirecto;

use App\Models\Almacen;
use App\Models\GuiaEntradaDirecto;
use App\Models\GuiaEntradaDirectoDetalle;
use App\Models\Inventario;
use App\Models\ListaPrecio;
use App\Models\Sede;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.erp.layout-erp')]
class GuiaEntradaDirectoCrearLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;
    protected $paginate = 20;

    public $listasPrecios;

    public $variacion_id = null;
    public $inventarios = [];
    public $sedes = [], $almacenes = [];

    public $detalles = [];

    public $estado = null;
    public $observacion = null;
    public $descripcion = null;
    public $fecha_entrada = null;

    public $sede_id = null;
    public $almacen_id = null;

    public function mount()
    {
        $this->listasPrecios = ListaPrecio::all();
        $this->sedes = Sede::where('activo', true)->get();
    }

    public function guardar()
    {
        $this->validate([
            'descripcion' => 'required|string',
            'observacion' => 'nullable|string',
            'fecha_entrada' => 'required|date',
            'estado' => 'required|in:Aprobado,Rechazado,Observado,Eliminado',
            'sede_id' => 'required',
            'almacen_id' => 'required',
            'detalles' => 'required|array|min:1',
        ]);

        $guiaEntradaDirecto = GuiaEntradaDirecto::create([
            'descripcion' => $this->descripcion,
            'observacion' => $this->observacion,
            'fecha_entrada' => $this->fecha_entrada,
            'estado' => $this->estado,
            'sede_id' => $this->sede_id,
            'almacen_id' => $this->almacen_id,
        ]);

        foreach ($this->detalles as $detalle) {
            GuiaEntradaDirectoDetalle::create([
                'guia_entrada_directo_id' => $guiaEntradaDirecto->id,
                'variacion_id' => $detalle['variacion_id'],
                'stock' => 0,
                'stock_minimo' => 0,
            ]);
        }

        $this->reset([
            'descripcion',
            'observacion',
            'fecha_entrada',
            'estado',
            'sede_id',
            'almacen_id',
            'detalles',
            'inventarios'
        ]);

        session()->flash('message', 'Guía de entrada directo guardada exitosamente.');
    }

    public function updatedSedeId($value)
    {
        $this->almacenes = Almacen::where('sede_id', $value)->get();

        $this->reset(['almacen_id']);
    }

    public function updatedAlmacenId($value)
    {
        $this->almacen_id = $value;
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function seleccionarIdVariacion($id)
    {
        $existingIndex = $this->findVariacionIndex($id);
        if ($existingIndex !== null) {
            return;
        }

        $this->variacion_id = $id;
        $this->obtenerInventarios();

        $variacion = Variacion::with(['producto', 'color', 'talla'])->findOrFail($id);
        $this->detalles[] = [
            'variacion_id' => $variacion->id,
            'producto_nombre' => $variacion->producto->nombre ?? '-',
            'color_nombre' => $variacion->color->nombre ?? '-',
            'talla_nombre' => $variacion->talla->nombre ?? '-',
        ];
    }

    private function findVariacionIndex($id)
    {
        foreach ($this->detalles as $index => $detalle) {
            if ($detalle['variacion_id'] === $id) {
                return $index;
            }
        }
        return null;
    }

    public function obtenerInventarios()
    {
        if ($this->variacion_id) {
            $this->inventarios = Inventario::where('variacion_id', $this->variacion_id)->get();
        } else {
            $this->inventarios = [];
        }
    }

    public function quitar($index)
    {
        if (isset($this->detalles[$index])) {
            unset($this->detalles[$index]);
            $this->detalles = array_values($this->detalles);
        }
    }

    public function render()
    {
        $variacionesQuery = Variacion::with(['producto', 'color', 'talla']);

        if ($this->buscarProducto) {
            $variacionesQuery->whereHas('producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $variaciones = $variacionesQuery->paginate(20);

        return view('livewire.erp.guia-entrada-directo.guia-entrada-directo-crear-livewire', [
            'variaciones' => $variaciones,
        ]);
    }
}
