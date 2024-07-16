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

    public $inventarios = [];

    public $variacion_id = null;

    public $sedes = [], $almacenes = [], $series = [];

    public $observacion = null, $descripcion = null, $fecha_salida = null, $estado = "Aprobado", $sede_id = null, $almacen_id = null, $serie_id = null;

    public $detalles = [];

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

            if (!$inventario || $detalle['cantidad'] > $inventario->stock) {
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

        $this->dispatch('alertaLivewire', "Creado");

        //session()->flash('message', 'Guía de salida directo guardada exitosamente.');
    }

    public function updatedSedeId($value)
    {
        $this->almacenes = Almacen::where('sede_id', $value)->get();
        $this->series = Serie::where('sede_id', $value)
            //->where('tipo_documento_id', 4)
            ->get();

        $this->reset(['almacen_id', 'serie_id']);
    }

    public function updatedAlmacenId($value)
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

        $inventario = Inventario::with('variacion.producto', 'variacion.color', 'variacion.talla')
            ->where('almacen_id', $this->almacen_id)
            ->where('variacion_id', $id)
            ->first();

        if ($inventario->stock >= 1) {
            $this->detalles[] = [
                'variacion_id' => $this->variacion_id,
                'producto_nombre' => $inventario->variacion->producto->nombre ?? '-',
                'color_nombre' => $inventario->variacion->color->nombre ?? '-',
                'talla_nombre' => $inventario->variacion->talla->nombre ?? '-',
                'stock_actual' => $inventario->stock,
                'cantidad' => 1,
            ];
        }

        $this->obtenerInventarios();
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
        $variacionesInventarioQuery = Inventario::with(['variacion', 'variacion.producto', 'variacion.color', 'variacion.talla'])->where('almacen_id', $this->almacen_id);

        if ($this->buscarProducto) {
            $variacionesInventarioQuery->whereHas('variacion.producto', function ($query) {
                $query->where('nombre', 'like', '%' . $this->buscarProducto . '%');
            });
        }

        $variacionesIventario = $variacionesInventarioQuery->orderBy('id', 'desc')->paginate(10);

        return view('livewire.erp.guia-salida-directo.guia-salida-directo-crear-livewire', [
            'variacionesIventario' => $variacionesIventario,
        ]);
    }
}
