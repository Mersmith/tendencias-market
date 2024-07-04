<?php

namespace App\Livewire\Erp\GuiaSalidaDirecto;

use App\Http\Requests\GuiaSalidaDirectoRequest;
use App\Models\Almacen;
use App\Models\GuiaSalidaDirecto;
use App\Models\GuiaSalidaDirectoDetalle;
use App\Models\Inventario;
use App\Models\Sede;
use App\Models\Serie;
use App\Models\Variacion;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use DB;

#[Layout('layouts.erp.layout-erp')]
class GuiaSalidaDirectoCrearLivewire extends Component
{
    use WithPagination;

    public $buscarProducto;

    public $variacion_id = null, $inventarios = [], $detalles = [];

    public $observacion = null, $descripcion = null, $fecha_salida = null, $estado = null;

    public $sedes = [], $almacenes = [], $series = [];
    public $sede_id = null, $almacen_id = null, $serie_id = null;

    public function mount()
    {
        $this->sedes = Sede::where('activo', true)->get();
    }

    public function guardar()
    {
        $data = $this->validate((new GuiaSalidaDirectoRequest())->rules(), (new GuiaSalidaDirectoRequest())->messages(), (new GuiaSalidaDirectoRequest())->attributes());


        // Validar si cuenta con stock
        $errores = [];
        foreach ($this->detalles as $detalle) {
            $inventario = Inventario::where('almacen_id', $this->almacen_id)
                ->where('variacion_id', $detalle['variacion_id'])
                ->first();

            if (!$inventario || $inventario->stock < $detalle['cantidad']) {
                $errores[] = "Stock insuficiente para la variación ID: {$detalle['variacion_id']}";
            }
        }

        if (!empty($errores)) {
            foreach ($errores as $error) {
                session()->flash('error', $error);
            }
            return;
        }

        DB::transaction(function () {
            // Bloquear la fila de la serie seleccionada para evitar problemas de concurrencia
            $serie = Serie::where('id', $this->serie_id)->lockForUpdate()->first();

            // Aumentar el correlativo
            $correlativoActualizado = $serie->correlativo + 1;
            $serie->update(['correlativo' => $correlativoActualizado]);

            $guiaSalidaDirecto = GuiaSalidaDirecto::create([
                'sede_id' => $this->sede_id,
                'almacen_id' => $this->almacen_id,
                'estado' => $this->estado,
                'observacion' => $this->observacion,
                'descripcion' => $this->descripcion,
                'fecha_salida' => $this->fecha_salida,
                'serie' => $serie->nombre,
                'correlativo' => $correlativoActualizado,
            ]);

            foreach ($this->detalles as $detalle) {
                GuiaSalidaDirectoDetalle::create([
                    'guia_salida_directo_id' => $guiaSalidaDirecto->id,
                    'variacion_id' => $detalle['variacion_id'],
                    'cantidad' => $detalle['cantidad'],
                ]);

                // Decrementar stock en el almacén de origen
                Inventario::where('almacen_id', $this->almacen_id)
                    ->where('variacion_id', $detalle['variacion_id'])
                    ->decrement('stock', $detalle['cantidad']);
            }

            // Marcar la guía como completada
            $guiaSalidaDirecto->update(['completado' => true]);
        });

        $this->reset([
            'descripcion',
            'observacion',
            'fecha_salida',
            'estado',
            'sede_id',
            'almacen_id',
            'serie_id',
            'detalles',
            'inventarios'
        ]);

        session()->flash('message', 'Guía de salida directo guardada exitosamente.');
    }

    public function updatedSedeId($value)
    {
        $this->almacenes = Almacen::where('sede_id', $value)->get();
        $this->series = Serie::where('sede_id', $value)
            ->where('tipo_documento_id', 2)
            ->get();

        $this->reset(['almacen_id', 'serie_id']);
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
            'cantidad' => 0,
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

    public function quitar($index)
    {
        if (isset($this->detalles[$index])) {
            unset($this->detalles[$index]);
            $this->detalles = array_values($this->detalles);
        }
    }

    public function obtenerInventarios()
    {
        if ($this->variacion_id) {
            $this->inventarios = Inventario::where('variacion_id', $this->variacion_id)->get();
        } else {
            $this->inventarios = [];
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

        return view('livewire.erp.guia-salida-directo.guia-salida-directo-crear-livewire', [
            'variaciones' => $variaciones,
        ]);
    }
}
