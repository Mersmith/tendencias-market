<?php

namespace App\Livewire\Erp\TransferenciaAlmacen;

use App\Models\Almacen;
use App\Models\Inventario;
use App\Models\Sede;
use App\Models\Serie;
use App\Models\TransferenciaAlmacen;
use App\Models\TransferenciaAlmacenDetalle;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use DB;

#[Layout('layouts.erp.layout-erp')]
class TransferenciaAlmacenCrearLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;

    public $sedes_origen = [], $almacenes_origen = [], $series_origen = [];
    public $sede_origen_id = null, $almacen_origen_id = null, $serie_origen_id = null;

    public $sedes_destino = [], $almacenes_destino = [], $series_destino = [];
    public $sede_destino_id = null, $almacen_destino_id = null, $serie_destino_id = null;

    public $variacion_id = null;
    
    public $descripcion = null, $observacion = null, $fecha_transferencia = null, $estado = "Aprobado";
    public $detalles = [];

    protected $rules = [
        'sede_origen_id' => 'required',
        'almacen_origen_id' => 'required',
        'sede_destino_id' => 'required',
        'almacen_destino_id' => 'required',
        'estado' => 'required|in:Pendiente,Aprobado,Rechazado,Observado,Eliminado',
        'observacion' => 'nullable|string',
        'descripcion' => 'required|string',
        'fecha_transferencia' => 'required|date',
        'serie_origen_id' => 'required',
        'serie_destino_id' => 'required',
        'detalles' => 'required|array|min:1',
        'detalles.*.cantidad' => 'required|integer|min:1',
    ];

    protected $validationAttributes = [
        'sede_origen_id' => 'sede origen',
        'almacen_origen_id' => 'almacén origen',
        'sede_destino_id' => 'sede destino',
        'almacen_destino_id' => 'almacén destino',
        'estado' => 'estado',
        'observacion' => 'observación',
        'descripcion' => 'descripción',
        'fecha_transferencia' => 'fecha',
        'serie_origen_id' => 'serie origen',
        'serie_destino_id' => 'serie destino',
        'detalles' => 'detalle',
        'detalles.*.cantidad' => 'cantidad',
    ];

    protected $messages = [
        'sede_origen_id.required' => 'La :attribute es requerida.',
        'almacen_origen_id.required' => 'El :attribute es requerido.',
        'sede_destino_id.required' => 'La :attribute es requerida.',
        'almacen_destino_id.required' => 'El :attribute es requerido.',
        'estado.required' => 'El :attribute es requerido.',
        'descripcion.required' => 'La :attribute es requerida.',
        'fecha_transferencia.required' => 'La :attribute es requerida.',
        'serie_origen_id.required' => 'La :attribute es requerida.',
        'serie_destino_id.required' => 'La :attribute es requerida.',
        'detalles.required' => 'El :attribute es requerido.',
        'detalles.*.cantidad.required' => 'El :attribute es requerido.',
    ];

    public function mount()
    {
        $sedes = Sede::where('activo', true)->get();
        $this->sedes_origen = $sedes;
        $this->sedes_destino = $sedes;
    }

    public function guardar()
    {
        $this->validate();

        DB::transaction(function () {
            // Bloquear la fila de la serie seleccionada para evitar problemas de concurrencia
            $serie_origen = Serie::where('id', $this->serie_origen_id)->lockForUpdate()->first();
            $serie_destino = Serie::where('id', $this->serie_destino_id)->lockForUpdate()->first();

            // Aumentar el correlativo
            $correlativoActualizadoOrigen = $serie_origen->correlativo + 1;
            $correlativoActualizadoDestino = $serie_destino->correlativo + 1;

            $serie_origen->update(['correlativo' => $correlativoActualizadoOrigen]);
            $serie_destino->update(['correlativo' => $correlativoActualizadoDestino]);

            // Crear la guia de entrada directo con el nuevo correlativo
            $transferenciaAlmacen = TransferenciaAlmacen::create([
                'sede_origen_id' => $this->sede_origen_id,
                'almacen_origen_id' => $this->almacen_origen_id,
                'sede_destino_id' => $this->sede_destino_id,
                'almacen_destino_id' => $this->almacen_destino_id,
                'estado' => $this->estado,
                'observacion' => $this->observacion,
                'descripcion' => $this->descripcion,
                'fecha_transferencia' => $this->fecha_transferencia,
                'serie_origen' => $serie_origen->nombre,
                'correlativo_origen' => $correlativoActualizadoOrigen,
                'serie_destino' => $serie_destino->nombre,
                'correlativo_destino' => $correlativoActualizadoDestino,
            ]);

            foreach ($this->detalles as $detalle) {
                TransferenciaAlmacenDetalle::create([
                    'transferencia_almacen_id' => $transferenciaAlmacen->id,
                    'variacion_id' => $detalle['variacion_id'],
                    'cantidad' => $detalle['cantidad'],
                ]);

                // Decrementar stock en el almacén de origen
                Inventario::where('almacen_id', $this->almacen_origen_id)
                    ->where('variacion_id', $detalle['variacion_id'])
                    ->decrement('stock', $detalle['cantidad']);

                // Incrementar stock en el almacén de destino
                Inventario::updateOrCreate(
                    [
                        'almacen_id' => $this->almacen_destino_id,
                        'variacion_id' => $detalle['variacion_id'],
                    ],
                    [
                        'stock' => DB::raw('stock + ' . $detalle['cantidad']),
                    ]
                );
            }

            // Marcar la guía como completada
            $transferenciaAlmacen->update(['completado' => true]);
        });

        $this->reset([
            'sede_origen_id',
            'almacen_origen_id',
            'sede_destino_id',
            'almacen_destino_id',
            'estado',
            'observacion',
            'descripcion',
            'fecha_transferencia',
            'serie_origen_id',
            'serie_destino_id',
            'detalles',
        ]);

        $this->dispatch('alertaLivewire', "Creado");

        //session()->flash('message', 'Transferencia de almacén guardada exitosamente.');
    }

    public function agregarVariacionDetalle($id)
    {
        $existingIndex = $this->findVariacionIndex($id);
        if ($existingIndex !== null) {
            return;
        }

        $this->variacion_id = $id;

        $inventario = Inventario::with('variacion.producto', 'variacion.color', 'variacion.talla')
            ->where('almacen_id', $this->almacen_origen_id)
            ->where('variacion_id', $id)
            ->first();

        $this->detalles[] = [
            'variacion_id' => $this->variacion_id,
            'producto_nombre' => $inventario->variacion->producto->nombre ?? '-',
            'color_nombre' => $inventario->variacion->color->nombre ?? '-',
            'talla_nombre' => $inventario->variacion->talla->nombre ?? '-',
            'stock_actual' => $inventario->stock,
            'cantidad' => 1,
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

    public function updatedSedeOrigenId($value)
    {
        $this->almacenes_origen = Almacen::where('sede_id', $value)->get();
        $this->series_origen = Serie::where('sede_id', $value)
            //->where('tipo_documento_id', 2)
            ->get();

        $this->reset(['almacen_origen_id', 'serie_origen_id']);

        $this->resetPage();
    }  

    public function updatedAlmacenOrigenId($value)
    {
        $this->resetPage();
    }

    public function updatedSedeDestinoId($value)
    {
        $this->almacenes_destino = Almacen::where('sede_id', $value)->get();
        $this->series_destino = Serie::where('sede_id', $value)
            //->where('tipo_documento_id', 2)
            ->get();

        $this->reset(['almacen_destino_id', 'serie_destino_id']);
    }

    public function updatingBuscarProducto()
    {
        $this->resetPage();
    }

    public function updatingPaginacion()
    {
        $this->resetPage();
    }

    public function render()
    {
        $inventarioQuery = Inventario::with(['variacion', 'variacion.producto', 'variacion.color', 'variacion.talla'])
            ->where('almacen_id', $this->almacen_origen_id);

        if ($this->buscarProducto) {
            $inventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $inventario = $inventarioQuery->orderBy('id', 'desc')->paginate(10);

        return view('livewire.erp.transferencia-almacen.transferencia-almacen-crear-livewire', [
            'inventario' => $inventario,
        ]);
    }
}
