<?php

namespace App\Livewire\Erp\GuiaEntradaDirecto;

use App\Models\Almacen;
use App\Models\GuiaEntradaDirecto;
use App\Models\GuiaEntradaDirectoDetalle;
use App\Models\Inventario;
use App\Models\Sede;
use App\Models\Serie;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use DB;

#[Layout('layouts.erp.layout-erp')]
class GuiaEntradaDirectoCrearLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;
    protected $paginate = 20;

    public $variacion_id = null;
    public $inventarios = [];
    public $sedes = [], $almacenes = [], $series = [];

    public $detalles = [];

    public $estado = null;
    public $observacion = null;
    public $descripcion = null;
    public $fecha_entrada = null;

    public $sede_id = null;
    public $almacen_id = null;
    public $serie_id = null;

    public function mount()
    {
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
            'serie_id' => 'required',
            'detalles' => 'required|array|min:1',
            'detalles.*.stock' => 'required|integer|min:1',
            'detalles.*.stock_minimo' => 'required|integer|min:1',
        ]);

        DB::transaction(function () {
            // Bloquear la fila de la serie seleccionada para evitar problemas de concurrencia
            $serie = Serie::where('id', $this->serie_id)->lockForUpdate()->first();

            // Aumentar el correlativo
            $correlativoActualizado = $serie->correlativo + 1;
            $serie->update(['correlativo' => $correlativoActualizado]);

            // Crear la guia de entrada directo con el nuevo correlativo
            $guiaEntradaDirecto = GuiaEntradaDirecto::create([
                'almacen_id' => $this->almacen_id,
                'sede_id' => $this->sede_id,
                'estado' => $this->estado,
                'observacion' => $this->observacion,
                'descripcion' => $this->descripcion,
                'fecha_entrada' => $this->fecha_entrada,
                'serie' => $serie->nombre,
                'correlativo' => $correlativoActualizado,
            ]);

            foreach ($this->detalles as $detalle) {
                GuiaEntradaDirectoDetalle::create([
                    'guia_entrada_directo_id' => $guiaEntradaDirecto->id,
                    'variacion_id' => $detalle['variacion_id'],
                    'stock' => $detalle['stock'],
                    'stock_minimo' => $detalle['stock_minimo'],
                ]);
            }

            if ($this->estado == 'Aprobado') {
                foreach ($this->detalles as $detalle) {
                    $inventario = Inventario::updateOrCreate(
                        [
                            'almacen_id' => $this->almacen_id,
                            'variacion_id' => $detalle['variacion_id'],
                        ],
                        [
                            'stock' => DB::raw('stock + ' . $detalle['stock']),
                            'stock_minimo' => DB::raw('stock_minimo + ' . $detalle['stock_minimo']),
                        ]
                    );
                }

                // Marcar la guía como completada
                $guiaEntradaDirecto->update(['completado' => true]);
            }
        });

        $this->reset([
            'descripcion',
            'observacion',
            'fecha_entrada',
            'estado',
            'sede_id',
            'almacen_id',
            'serie_id',
            'detalles',
            'inventarios'
        ]);

        session()->flash('message', 'Guía de entrada directo guardada exitosamente.');
    }

    public function updatedSedeId($value)
    {
        $this->almacenes = Almacen::where('sede_id', $value)->get();
        $this->series = Serie::where('sede_id', $value)
            ->where('tipo_documento_id', 3)
            ->get();

        $this->reset(['almacen_id', 'serie_id']);
    }

    /*public function updatedAlmacenId($value)
    {
        $this->almacen_id = $value;
    }*/

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
            'stock' => 0,
            'stock_minimo' => 0,
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
